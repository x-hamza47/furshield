<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use App\Models\HealthRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource dynamically for admin, vet, or owner.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Appointment::with(['pet', 'owner', 'vet']);

        if ($user->role === 'vet') {
            $query->where('vet_id', $user->id);
        } elseif ($user->role === 'owner') {
            $query->where('owner_id', $user->id)
                ->whereHas('pet', fn($q) => $q->where('owner_id', $user->id));
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('pet', fn($q2) => $q2->where('name', 'like', "%$search%")
                    ->orWhere('species', 'like', "%$search%"))
                    ->orWhereHas('vet', fn($q2) => $q2->where('name', 'like', "%$search%"));
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }


        $appts = $query->orderBy('appt_date', $user->role === 'vet' ? 'asc' : 'desc')
            ->paginate(10)
            ->withQueryString();

        $view = match ($user->role) {
            'vet'   => 'dashboard.vet.appointments.list',
            'owner' => 'dashboard.owner.appointments.list', 
            default => 'dashboard.admin.appointments.list',
        };

        return view($view, compact('appts'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $query = Appointment::with(['pet.owner', 'owner', 'vet.vet']);

        // Role-based restrictions
        if ($user->role === 'vet') {
            $query->where('vet_id', $user->id);
        } elseif ($user->role === 'owner') {
            $query->where('owner_id', $user->id);
        }

        $appt = $query->findOrFail($id);


        $pets = $owners = $vets = [];
        if ($user->role === 'admin') {
            $pets = Pet::with('owner')->orderBy('name')->get();
            $owners = User::where('role', 'owner')->orderBy('name')->get();
            $vets = User::where('role', 'vet')->orderBy('name')->get();
        }

        $view = match ($user->role) {
            'vet' => 'dashboard.vet.appointments.edit',
            'owner' => 'dashboard.owner.appointments.edit',
            default => 'dashboard.admin.appointments.edit',
        };

        return view($view, compact('appt', 'pets', 'owners', 'vets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $appt = Appointment::findOrFail($id);

        $rules = [];
        if ($user->role === 'admin') {
            $rules = [
                'pet_id' => 'required|exists:pets,id',
                'owner_id' => 'required|exists:users,id',
                'vet_id' => 'required|exists:users,id',
                'appt_date' => 'required|date|after:today',
                'appt_time' => 'required',
                'status' => 'required|in:pending,rejected,rescheduled,completed',
            ];
        } elseif ($user->role === 'vet') {
            $rules['status'] = 'required|in:pending,rejected,rescheduled,completed';

            if ($request->status === 'completed') {
                $rules['diagnosis'] = 'required|string|min:5';
                $rules['treatment'] = 'required|string|min:5';
                $rules['symptoms'] = 'nullable|string';
                $rules['notes'] = 'nullable|string';
                $rules['lab_reports'] = 'nullable|array';

                if ($request->filled('lab_reports') && is_string($request->lab_reports)) {
                    $request->merge(['lab_reports' => json_decode($request->lab_reports, true)]);
                }
            }
        }

        $validated = $request->validate($rules);

        if ($user->role === 'admin') {
            $appt->update($validated);
        }

        if ($user->role === 'vet') {
            $appt->status = $validated['status'];
            $appt->save();

            if ($appt->status === 'completed') {
                HealthRecord::create([
                    'pet_id' => $appt->pet_id,
                    'vet_id' => $appt->vet_id,
                    'symptoms' => $validated['symptoms'] ?? null,
                    'diagnosis' => $validated['diagnosis'],
                    'treatment' => $validated['treatment'],
                    'notes' => $validated['notes'] ?? null,
                    'lab_reports' => $validated['lab_reports'] ?? [],
                    'visit_date' => now()->toDateString(),
                ]);
            }
        }

        return redirect()->route('appts.index')->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appt = Appointment::findOrFail($id);
        $appt->delete();

        return redirect()->route('appts.index')->with('success', 'Appointment deleted successfully.');
    }


    public function create()
    {
        $user = Auth::user();

        $pets = $user->role === 'owner'
            ? Pet::where('owner_id', $user->id)->get()
            : Pet::all();

        $vets = User::where('role', 'vet')->get();

        return view('dashboard.owner.appointments.create', compact('pets', 'vets'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'pet_id'    => ['required', 'exists:pets,id'],
            'vet_id'    => ['required', 'exists:users,id'],
            'appt_date' => ['required', 'date', 'after_or_equal:today'],
            'appt_time' => ['required', 'string'],
        ]);

        if ($user->role === 'owner') {
            $ownsPet = Pet::where('id', $validated['pet_id'])
                ->where('owner_id', $user->id)
                ->exists();

            if (! $ownsPet) {
                return redirect()->back()->withErrors(['pet_id' => 'You can only book for your own pets.']);
            }
        }


        Appointment::create([
            'pet_id'    => $validated['pet_id'],
            'owner_id'  => $user->role === 'owner' ? $user->id : null,
            'vet_id'    => $validated['vet_id'],
            'appt_date' => $validated['appt_date'],
            'appt_time' => $validated['appt_time'],
            'status'    => 'pending',
        ]);

        return redirect()->route('appts.index')
            ->with('success', 'Appointment created successfully and is now pending.');
    }
    /**
     * Return vet available slots.
     */
    public function vetSlots(User $vet)
    {
        $slots = json_decode($vet->vet->available_slots ?? '[]', true);
        return response()->json($slots);
    }
}
