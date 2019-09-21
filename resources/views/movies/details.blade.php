@extends('layouts.app')

@section('content')

<div class="container" >
	<div class="row my-5">
		<div class="col-lg-4 justify-content-center">
						

			<div class="d-flex justify-content-center" >

				<img style="width: 18rem;height: 27rem" src="/storage/{{$movie_details[0]->movie->image}}">
			</div>
		</div>
		

		<div class="col-lg-8 pt-3">
			<h2 class="text-center">{{$movie_details[0]->movie->movie_name}}</h2>
			
			<h5 class="text-center">available parties</h5>
			<table class="table text-center">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Day</th>
			      <th scope="col">Time</th>
			      
			    </tr>
			  </thead>
			  <tbody>
			  	<?php $i=0; ?>
			  	@foreach($movie_details as $movie_detail) 
			    <tr>
			      <th scope="row">{{++$i}}</th>
			      <td>{{$movie_detail->day}}</td>
			      <td>{{$movie_detail->event->event_time}}</td>
			      
			    </tr>
			    @endforeach
			   
			  </tbody>
			</table>
			<div class="text-center">
				<a href="/tickets/{{$movie_details[0]->movie->id}}" class="btn btn-success">get tickets</a>
			</div>
	</div>
	
</div>

@endsection