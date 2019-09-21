<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Movie;
use App\DaySchedule;
use App\Hall;
use App\Seat;
use App\Event;

class putMoviesListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // $test =Seat::get();
        // dd($test);
    //     // sleep(10);
        $movies = Movie::take(10)->get();
        // dd($movies[0]->movie_name);
        for($i=0;$i<$movies->count();$i++)
        {
            for($j=0;$j<4;$j++)
            {
                for($c=0;$c<2;$c++)
                {
                    $daySchedule = new DaySchedule;
                    $daySchedule->movie_id=$movies[$i]->id;
                    $daySchedule->hall_id=rand( 1 , 4 );
                    $daySchedule->event_id=rand( 1 , 4 );
                    $daySchedule->day=date('Y-m-d',time()+$j*24*60*60);
                    $daySchedule->save();
                }               
            }           
        }
        $chars=['A','B','C','D','E','F','G','H','I','J'];
        $Schedules = DaySchedule::where([['day','>=',date('Y-m-d',time())]])->get();
        for($a=0;$a<$Schedules->count();$a++){
            for($b=0;$b<6;$b++){
                $takenSeat=new Seat;
                $takenSeat->seat_num =$chars[rand(0,count($chars)-1)].rand(1,12);
                $takenSeat->user_id = 1;
                $takenSeat->day_schedule_id=$Schedules[$a]->id; 
                $takenSeat->save();
            }
            
        }

    }
}
