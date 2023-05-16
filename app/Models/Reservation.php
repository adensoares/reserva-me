<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Table;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'table_id',
        'reservation_time',
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public static function overlaps($tableId, $reservationTime)
    {
        $reservationTime = Carbon::parse($reservationTime);
        $endTime = $reservationTime->copy()->addHours(2);
    
        return static::where('table_id', $tableId)
            ->where(function ($query) use ($reservationTime, $endTime) {
                $query->whereBetween('reservation_time', [$reservationTime, $endTime])
                      ->orWhereBetween(DB::raw("reservation_time + INTERVAL '2 hours'"), [$reservationTime, $endTime]);
            })
            ->exists();
    }
}

