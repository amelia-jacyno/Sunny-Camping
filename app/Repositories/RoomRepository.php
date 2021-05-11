<?php


namespace App\Repositories;

use App\Models\Room;
use Illuminate\Support\Facades\DB;

class RoomRepository extends BaseRepository
{

    public function allByServiceWithReservations(int $serviceId)
    {
        return DB::table('rooms')
            ->leftJoin('reservations', 'rooms.id', '=', 'reservations.room_id')
            ->get();
    }
}
