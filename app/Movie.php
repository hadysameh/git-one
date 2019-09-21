<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
	// public $additional_attributes = ['full_name'];

 //    public function getFullNameAttribute()
 //    {
 //    	return $this->movie_name." ".$this->id;
 //    }
    public function daySchedule()
    {
    	return $this->hasMany(DaySchedule::class);
    }
}
