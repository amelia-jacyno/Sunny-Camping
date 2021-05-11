<?php

namespace App\Models;

/**
 * App\Models\Reservation.
 *
 * @property int $id
 * @property int $client_id
 * @property int $room_id
 * @property int $status_id
 * @property int $service_id
 * @property string $start_date
 * @property string $end_date
 * @property int $prepayment
 * @property int $adults
 * @property int $children
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereAdults($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereChildren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation wherePrepayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReservationItem[] $reservationItems
 * @property-read int|null $reservation_items_count
 */
class Reservation extends BaseModel
{
    public function reservationItems()
    {
        return $this->hasMany(ReservationItem::class);
    }
}
