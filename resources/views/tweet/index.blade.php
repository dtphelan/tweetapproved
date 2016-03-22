@extends('layouts.master')

 @section('title')
     Unused tweets
 @stop

 @section('content')
     <h1>Ready tweets will show here</h1>

     @if(sizeof($tweets) == 0)
        No tweets!
    @else
        @foreach($tweets as $tweet)
            <div>
                <p>{{ $tweet->tweet }}</p>
            </div>
        @endforeach
    @endif

 @stop