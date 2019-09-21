@component('mail::message')
# Introduction
Dear {{$name}} <br>
your ticket was reserved successfully <br> 
movie: <span class="text-success">{{$seat->daySchedule->movie->movie_name}}</span> <br>
day: <span class="text-success">{{$seat->daySchedule->day}}</span> <br>
hall:<span class="text-success">{{$seat->daySchedule->hall->hall_name}}</span><br>
event:<span class="text-success">{{$seat->daySchedule->event->event_time}}</span><br>
seat-number:<span class="text-success">{{$seat->seat_num}}</span><br>
Thanks,<br>
Cinemapp
@endcomponent
