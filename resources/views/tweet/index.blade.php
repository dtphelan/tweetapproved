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
        <form method='POST' action='/tweet'>
           <input type='hidden' value='{{ csrf_token() }}' name='_token'>
           <input type='hidden' value='{{ $tweet->id }}' name='id'>
           <input type='hidden' value=3 name='status'>
                <div>
                    <p>{{ $tweet->tweet }}</p>
                </div>
            </div>
        <button type="submit" class="btn btn-primary">Use tweet</button>
    </form>
        @endforeach
    @endif

 @stop
