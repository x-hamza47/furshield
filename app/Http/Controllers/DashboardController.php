<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Models\Adoption;
use Illuminate\Http\Request;
use App\Models\AdoptionRequest;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        $stats = [];

        switch ($role) {
            case 'admin':
                $stats = [
                    'total_users'     => User::count(),
                    'total_shelters'  => User::where('role', 'shelter')->count(),
                    'total_vets'      => User::where('role', 'vet')->count(),
                    'total_pets'      => Adoption::count(),
                    'adopted_pets'    => Adoption::where('status', 'adopted')->count(),
                ];
                break;

            case 'shelter':
                $stats = [
                    'my_pets'         => Adoption::where('shelter_id', $user->id)->count(),
                    'available_pets'  => Adoption::where('shelter_id', $user->id)->where('status', 'available')->count(),
                    'adopted_pets'    => Adoption::where('shelter_id', $user->id)->where('status', 'adopted')->count(),
                    'pending_requests' => AdoptionRequest::whereHas('adoption', fn($q) => $q->where('shelter_id', $user->id))
                        ->where('status', 'pending')->count(),
                ];
                break;

            case 'vet':
                $stats = [
                    'total_pets'      => Pet::count(),
                    // 'my_appointments' => $user->appointments()->count() ?? 0, // assuming you have relation
                    // 'treated_pets'    => $user->appointments()->where('status', 'completed')->count() ?? 0,
                ];
                break;

            case 'owner':
                $stats = [
                    'available_pets'  => Adoption::where('status', 'available')->count(),
                    'my_requests'     => AdoptionRequest::where('user_id', $user->id)->count(),
                    'approved'        => AdoptionRequest::where('user_id', $user->id)->where('status', 'approved')->count(),
                    'rejected'        => AdoptionRequest::where('user_id', $user->id)->where('status', 'rejected')->count(),
                ];
                break;
        }

        return view('dashboard.index', compact('role', 'stats'));
    }
}
