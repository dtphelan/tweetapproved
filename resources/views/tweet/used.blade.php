@extends('layouts.master')

 @section('title')
     Used tweets
 @stop

 @section('content')
     <h1>Used tweets will show here</h1>

     @if(sizeof($tweets) == 0)
        No used tweets!
     @else
        @foreach($tweets as $tweet)
            <div>
                <p>{{ $tweet->tweet }}</p>
            </div>
        @endforeach
     @endif

@stop
