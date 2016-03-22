@extends('layouts.master')

 @section('title')
     Unused tweets
 @stop

 @section('content')
     <h1>Tweet Tweets!</h1>

     @if(sizeof($tweets) == 0)
        No tweets!
    @else
        @foreach($tweets as $tweet)
        <form method='POST' class='input-group' action='/tweet'>
           <input type='hidden' value='{{ csrf_token() }}' name='_token'>
           <input type='hidden' value='{{ $tweet->id }}' name='id'>
           <input type='hidden' value='3' name='status'>
           <input type='text' class='form-control' disabled value='{{ $tweet->tweet }}'>
            <span class='input-group-btn'>
                <button type="submit" class="btn btn-primary">Use tweet</button>
            </span>
        </input>
        </form>
        @endforeach
    @endif

 @stop
