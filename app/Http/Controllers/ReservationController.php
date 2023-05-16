<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;

use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;


class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('table')
            ->where('user_id', Auth::id())
            ->where('reservation_time', '>=', now())
            ->get();
    
        return Inertia::render('Reservations/Index', ['reservations' => $reservations]);
    }

    public function create()
    {
        $tables = Table::orderBy('number')->get();
        return Inertia::render('Reservations/Create', ['tables' => $tables]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'table_id' => 'required|integer',
            'reservation_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $startHour = Carbon::createFromFormat('H:i', $value)->hour;
                    if ($startHour < 18) {
                        $fail('As reservas só podem começar a partir das 18:00.');
                    }
                },
            ],
            'date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $dayOfWeek = Carbon::createFromFormat('Y-m-d', $value)->dayOfWeek;
                    if ($dayOfWeek == Carbon::SUNDAY) {
                        $fail('Reservas não são permitidas aos domingos.');
                    }
                },
            ],
        ]);
    
        $reservationDateTime = Carbon::createFromFormat('Y-m-d H:i', $validated['date'].' '.$validated['reservation_time']);
    
        if (Reservation::overlaps($validated['table_id'], $reservationDateTime)) {
            return redirect()->route('reservations.create')
                             ->withErrors(['overlap' => 'Esta reserva se sobrepõe a uma reserva existente.'])
                             ->withInput();
        }
    
        $validated['reservation_time'] = $reservationDateTime;
    
        $reservation = Reservation::create($validated);
    
        return redirect()->route('reservations.index');
    }

    public function show(Reservation $reservation)
    {
        return Inertia::render('Reservations/Show', ['reservation' => $reservation]);
    }

    public function edit(Reservation $reservation)
    {
        return Inertia::render('Reservations/Edit', ['reservation' => $reservation]);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'table_id' => 'required|integer',
            'start_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $startHour = Carbon::createFromFormat('H:i', $value)->hour;
                    if ($startHour < 18) {
                        $fail('As reservas só podem começar a partir das 18:00.');
                    }
                },
            ],
            'date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $dayOfWeek = Carbon::createFromFormat('Y-m-d', $value)->dayOfWeek;
                    if ($dayOfWeek === Carbon::SUNDAY) {
                        $fail('Reservas não são permitidas aos domingos.');
                    }
                },
            ],
        ]);
    
        $reservationDateTime = Carbon::createFromFormat('Y-m-d H:i', $validated['date'] . ' ' . $validated['start_time']);
    
        if (Reservation::overlaps($validated['table_id'], $reservationDateTime)) {
            $errors = new MessageBag(['overlap' => 'Esta reserva se sobrepõe a uma reserva existente.']);
            return redirect()->route('reservations.index')->withErrors($errors);
        }
    
        $validated['reservation_time'] = $reservationDateTime;
    
        $reservation->update($validated);
    
        return redirect()->route('reservations.index');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index');
    }

    public function admin()
    {
        $this->authorize('viewAny', Reservation::class);

        $reservations = Reservation::with('user')->get();

        return Inertia::render('Reservations/Admin', [
            'reservations' => $reservations
        ]);
    }
}


                