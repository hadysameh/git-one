@extends('layouts.app')

@section('content')




<section class="jumbotron text-center my-2" >
    <div class="container my-3">
      <h1 class="jumbotron-heading">Cinema App</h1>
      <p class="lead text-muted "><h3 class="text-secondary">Welocme , to our cinema booking app , you can view available movies , view available seats , and buy tickets for any movie you want</h3></p>
      <p>
        <a id='vi' href="#movies" class="btn btn-primary my-2">View Movies</a>
      </p>
    </div>
  </section>

{{-- {{$daySchedules->movies}} --}}
{{-- {{$movie->daySchedule[0]->id}} --}}
  <div id='movies' class="album py-5 bg-light">
    <div class="container ">
    <home today='{{$today}}' tom='{{$tomorrow}}' after='{{$aftertom}}' date='{{$day_link}}' class='my-3'></home>

      <div class="row justify-content-center">
          
          @foreach($daySchedules as $daySchedule)   
                         
              <div class="px-3">
                <div class="card mb-4 shadow-sm" style="width: 18rem">
                  <a href="/details/{{$daySchedule->movie->id}}">    
                  <img src="/storage/{{$daySchedule->movie->image}}" class="card-img-top" alt="..." style="height: 27rem"></a>
                  <div class="card-body">
                    
                    <h4>{{$daySchedule->movie->movie_name}}</h4>
                    <p class="card-text">
                      <div class="d-flex align-items-baseline">
                        <h5>length</h5>:{{$daySchedule->movie->length}}
                      </div>
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="/tickets/{{$daySchedule->movie->id}}" class="btn btn-sm btn-outline-secondary">View Seats</a>
                        <a href="/details/{{$daySchedule->movie->id}}"  class="btn btn-sm btn-outline-secondary">View Details</a>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
          @endforeach                  
      </div>

          <div class="d-flex justify-content-center">
            {{ $daySchedules->links() }}
          </div>

@endsection









{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}}