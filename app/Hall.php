<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    //
    public function daySchedule()
    {
    	return $this->hasMany(DaySchedule::class);
    }
}
