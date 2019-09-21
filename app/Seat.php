<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
	//protected $guarded=[];
	protected $fillable = ['seat_num', 'user_id', 'day_schedule_id'];
    //
    public function daySchedule()
    {
    	return $this->belongsTo(DaySchedule::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
