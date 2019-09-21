<?php

namespace App\Http\Resources;
use App\Http\Resources\Halls;
use App\Http\Resources\Events;
use App\Http\Resources\Days;
use App\Movie;
use App\DaySchedule;
use App\Hall;
use App\Seat;
use App\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class Seats extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            $this->seat_num,
            $this->user_id
        ];
    }
}
