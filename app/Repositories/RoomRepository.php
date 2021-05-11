<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RoomRepository extends BaseRepository
{
    public function allByServiceWithReservations(int $serviceId)
    {
        return DB::table('rooms')
            ->leftJoin('reservations', 'rooms.id', '=', 'reservations.room_id')
            ->select('rooms.*', 'reservations.start_date', 'reservations.end_date')
            ->get();
    }
}
