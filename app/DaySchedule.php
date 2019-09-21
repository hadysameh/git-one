<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Movie;
use App\Hall;
use App\Event;
class DaySchedule extends Model
{
    //
    public function movie()
    {
    	return $this->belongsTo(Movie::class);
    }

    public function hall()
    {
    	return $this->belongsTo(Hall::class);
    }

    public function event()
    {
    	return $this->belongsTo(Event::class);
    }

}
