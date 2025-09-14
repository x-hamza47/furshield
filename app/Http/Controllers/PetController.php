<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $ownerId = Auth::id(); 

        $query = Pet::with('owner')
            ->where('owner_id', $ownerId); 

        // 🔍 Global search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('species', 'like', "%{$search}%")
                    ->orWhere('breed', 'like', "%{$search}%")
                    ->orWhere('gender', 'like', "%{$search}%")
                    ->orWhere('age', 'like', "%{$search}%")
                    ->orWhereHas('owner', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('contact', 'like', "%{$search}%");
                    });
            });
        }

        $pets = $query->latest()->paginate(10)->withQueryString();

        return view('dashboard.owner.pet.list', compact('pets'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.owner.pet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed'   => 'nullable|string|max:255',
            'age'     => 'nullable|integer|min:0',
            'gender'  => 'required|in:male,female',
        ]);

        // Automatically assign current logged-in user as the pet's owner
        $validated['owner_id'] = Auth::id();

        Pet::create($validated);

        return redirect()->route('pets.index')
            ->with('success', 'Pet added successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        return view('dashboard.owner.pet.edit', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        // return $request;

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'breed'   => 'nullable|string|max:100',
            'age'     => 'nullable|integer|min:0',
            'gender'  => 'nullable|in:male,female',
        ]);

        $pet->update($validated);

        return redirect()->route('pets.index')->with('success', 'Pet updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pet = Pet::findOrFail($id);

        // Ensure only the owner can delete their own pet
        if ($pet->owner_id !== Auth::id()) {
            return redirect()->route('pets.index')
                ->with('error', 'You are not authorized to delete this pet.');
        }

        $pet->delete();

        return redirect()->route('pets.index')
            ->with('success', 'Pet deleted successfully!');
    }
}
