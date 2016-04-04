@extends('layouts.master')

 @section('title')
     Used tweets
 @stop

 @section('content')
     <h1>Reminisce Tweets!</h1>

     @if(sizeof($tweets) == 0)
        No used tweets!
     @else
        @foreach($tweets as $tweet)
        <form method='POST' class='input-group' action='/tweet/delete'>
            <input type='hidden' value='{{ csrf_token() }}' name='_token'>
            <input type='hidden' value='{{ $tweet->id }}' name='id'>
            <input type='text' class='form-control' disabled value='{{ $tweet->tweet }}'>
            @if($tweet->status == 4)
                <span class='input-group-addon' id='basic-addon2'>Rejected tweet</span>
            @endif
               <span class='input-group-btn'>
                   <button type='submit' class='btn btn-danger'>Delete tweet</button>
               </span>
            </input>
        </form>
        @endforeach
     @endif

@stop
