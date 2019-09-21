<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\putMoviesEvent;
use App\Movie;
use App\DaySchedule;
use App\Hall;
use App\Event;
use App\Seat;
use App\Events\SendMailEvent;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($day = null)
    {

        date_default_timezone_set('Africa/Cairo');
        $today = date('Y-m-d',time());
        $tomorrow = date('Y-m-d',time()+24*60*60);
        $aftertom = date('Y-m-d',time()+24*60*60*2);
        $day_link=$day;

        // dd(Seat::take(1)->get());
       $emailData=[auth()->user(),Seat::find(1909)];
       event(new SendMailEvent($emailData));

        if($day == null)
        {
            $day = date('Y-m-d',time());
            $day_link = date('Y-m-d',time());
        }
        $daySchedulesCount = DaySchedule::where('day',$day)->count();
        if($daySchedulesCount==0)
        {
            event(new putMoviesEvent());
            // you can pass a var to the event and to the listener
        }
        else
        {
            $daySchedules = DaySchedule::where('day',$day)->select('movie_id','day')->distinct()->paginate(9);
            // dd( $daySchedules);
            return view('movies.home',compact('daySchedules','today','tomorrow','aftertom','day_link'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($movie_id)
    {
        $day = date('Y-m-d',time());
        $movie_details=DaySchedule::where([['movie_id',$movie_id],['day','>=',$day]])->get();
        return view('movies.details',
            [
                'movie_details' =>$movie_details
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
