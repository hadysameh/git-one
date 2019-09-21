<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Seats;
use App\Http\Resources\Halls;
use App\Http\Resources\Events;
use App\Http\Resources\Days;
use App\Events\SendMailEvent;
use App\Movie;
use App\DaySchedule;
use App\Hall;
use App\Seat;
use App\Event;
class SeatController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($movie_id)
    {
        //
        //dd($day);
        //$schedules_ids= DaySchedule::where([['day',$day],['movie_id',$movie_id]])->select()->pluck('daySchedule.id');//plunk() works as get()
        //$test2= DaySchedule::where([['day',$day],['movie_id',$movie_id]])->select('id')->get();
        
        $today = date('Y-m-d',time());

        //$movie_days = DaySchedule::where([['movie_id',$movie_id],['day','>=',$today]])->select('day')->distinct()->get()->toArray();
        
        $movie_name= Movie::findOrFail($movie_id)->movie_name;
        //dd($movie_days);
        return view('seats.seats',compact('movie_id','movie_name'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request();
        //return $data['day'];
        $daySchedule_id=DaySchedule::where([['day',$data['day']],['movie_id',$data['movie_id']],['hall_id',$data['hall_id']],['event_id',$data['event_id']]])->select('id')->pluck('id');
        $seat = new Seat;
        $seat->seat_num=$data['seat_num'];
        $seat->day_schedule_id=$daySchedule_id[0];
        $seat->user_id=auth()->user()->id;        
        if($seat->save())
        {
            $emailData=[auth()->user(),$seat];
            event(new SendMailEvent($emailData));            
        }
        else
        {
            return 'faild';
        }
        // $seat = new Seat;
        // $seat->seat_num=$data['seat_num'];
        // $seat->day_schedule_id=$data['day_schedule_id'];
        // $seat->user_id=$data['user_id'];
        // $seat->save();
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$day=null,$event_id=null,$hall_id= null)
    {
        date_default_timezone_set('Africa/Cairo');
        if($day == null && $event_id == null  && $hall_id ==null ){
            $movie_days = DaySchedule::where([['movie_id',$id],['day','>=',date('Y-m-d',time())]])->select('day')->distinct()->get();

            return  Days::collection($movie_days);
        }
        if($day != null && $event_id == null  && $hall_id ==null ){

            $events_ids = DaySchedule::where([['movie_id',$id],['day','=',$day]])->select('event_id')->distinct()->pluck('event_id');
            //dd($movie_days);
            //$events = Event::whereIn('id',$events_ids)->pluck('event_time');
            $events = Event::whereIn('id',$events_ids)->get();
            //dd($events);

            return  Events::collection($events);
            // return new Events($events);
        }

        if($day != null && $event_id != null  && $hall_id ==null )
        {
            //$hall=Hall::where('hall_name', '=', 'about')->firstOrFail();

            $halls_ids = DaySchedule::where([['movie_id',$id],['day','=',$day],['event_id',$event_id]])->pluck('hall_id');

            $halls = Hall::whereIn('id',$halls_ids)->get();
            //dd($halls);
            return  Halls::collection($halls);
        }

        if($day != null && $event_id != null  && $hall_id != null )
        {
            //$hall=Hall::where('hall_name', '=', 'about')->firstOrFail();

            $daySchedules_ids= DaySchedule::where([['movie_id',$id],['day','=',$day],['event_id',$event_id],['hall_id',$hall_id]])->pluck('id');
            //dd($daySchedules_ids);
            $taken_seats = Seat::whereIn('day_Schedule_id',$daySchedules_ids)->select('seat_num','user_id')->get();

            return  Seats::collection($taken_seats);
        }
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
