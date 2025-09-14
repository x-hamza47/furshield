<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use Illuminate\Http\Request;
use App\Models\AdoptionRequest;
use Illuminate\Support\Facades\Auth;

class OwnerAdoptionController extends Controller
{
    public function index(Request $request)
    {
        $adoptions = Adoption::where('status', 'available')
            ->when($request->filled('search'), fn($q) => $q->where('name', 'like', "%{$request->search}%")
                ->orWhere('species', 'like', "%{$request->search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('dashboard.owner.adoptions.list', compact('adoptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'adoption_id' => 'required|exists:adoptions,id',
        ]);

        $existing = AdoptionRequest::where('adoption_id', $request->adoption_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'You have already requested this pet.');
        }

        AdoptionRequest::create([
            'adoption_id' => $request->adoption_id,
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Adoption request submitted.');
    }

    public function myRequests(Request $request)
    {
        $requests = AdoptionRequest::with('adoption.shelter')
            ->where('user_id', Auth::id())
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            // ->get();

        return view('dashboard.owner.adoptions.my_requests', compact('requests'));
    }
}
