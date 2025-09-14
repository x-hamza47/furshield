<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Adoption::with(['shelter', 'adopter'])->where('shelter_id', Auth::id());

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('species', 'like', '%' . $request->search . '%')
                    ->orWhere('breed', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $listings = $query->paginate(10)->appends($request->all());
        // dd($query->paginate(10)->toArray());

        return view('dashboard.shelter.adoptions.list', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.shelter.adoptions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['shelter', 'admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name'        => 'required|string|max:255',
            'species'     => 'required|string|max:255',
            'breed'       => 'nullable|string|max:255',
            'age'         => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'status'      => 'required|in:available,adopted,pending',
            'adop_img'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $adoption = new Adoption();
        $adoption->name        = $request->name;
        $adoption->species     = $request->species;
        $adoption->breed       = $request->breed;
        $adoption->age         = $request->age;
        $adoption->description = $request->description;
        $adoption->status      = $request->status;

        if (Auth::user()->role === 'shelter') {
            $adoption->shelter_id = Auth::user()->shelter->id;
        }
        
        if ($request->hasFile('adop_img')) {
            $file = $request->file('adop_img');
            $extension = $file->extension();
            $filename = 'adoption_' . time() . '_' . uniqid() . '.' . $extension;
            $path = $file->storeAs('adoption-pets', $filename, 'public'); 
            $adoption->adop_img = $path;
        }

        $adoption->save();

        return redirect()->route('adoption.index')->with('success', 'Adoption listing created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $adoption = Adoption::with(['adopter', 'shelter'])->findOrFail($id);

        return view('dashboard.shelter.adoptions.edit', compact('adoption'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $adoption = Adoption::where('shelter_id', Auth::id())->findOrFail($id);


        $request->validate([
            'name'        => 'required|string|max:255',
            'species'     => 'required|string|max:255',
            'breed'       => 'nullable|string|max:255',
            'age'         => 'nullable|integer|min:0',
            'gender'      => 'required|in:male,female',
            'status'      => 'required|in:available,adopted',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // if ($request->hasFile('image')) {
        //     // Delete old image if exists
        //     if ($adoption->image && \Storage::exists('public/' . $adoption->image)) {
        //         \Storage::delete('public/' . $adoption->image);
        //     }

        //     $imagePath = $request->file('image')->store('adoptions', 'public');
        //     $adoption->image = $imagePath;
        // }

        $adoption->update([
            'name'        => $request->name,
            'species'     => $request->species,
            'breed'       => $request->breed,
            'age'         => $request->age,
            'gender'      => $request->gender,
            'status'      => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('adoption.index')
            ->with('success', 'Adoption listing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $adoption = Adoption::where('shelter_id', Auth::id())->findOrFail($id);

        $adoption->delete();

        return redirect()->route('adoption.index')->with('success', 'Adoption listing deleted successfully.');
    }
}
