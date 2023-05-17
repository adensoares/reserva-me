<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('table', 'user')
            ->where('user_id', Auth::id())
            ->where('reservation_time', '>=', now())
            ->get();
    
        return Inertia::render('Dashboard', ['reservations' => $reservations]);
    }
    
}
