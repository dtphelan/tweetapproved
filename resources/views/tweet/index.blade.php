@extends('layouts.master')

 @section('title')
     Unused tweets
 @stop

 @section('content')
     <h1>Tweet Tweets!</h1>
     <a class='btn btn-primary' href='<?php echo $url ?>'></a>

     @if(sizeof($tweets) == 0)
        No tweets!
    @else
        @foreach($tweets as $tweet)
        <form method='POST' action='/tweet'>
           <input type='hidden' value='{{ csrf_token() }}' name='_token'>
           <input type='hidden' value='{{ $tweet->id }}' name='id'>
           <input type='hidden' value='3' name='status'>
           <div class='form-group'>
               <input
                   type='textarea'
                   class='form-control'
                   id='tweet'
                   name='tweet'
                   value='{{ $tweet->tweet }}'
                   disabled
               >
           </div>
           @if(!$tweet->author == 0)
           <div class='form-group'>
               <input
                   type='text'
                   class='form-control'
                   id='author'
                   name='author'
                   value='By {{ $tweet->author }}'
                   disabled
               >
           </div>
           @endif
            <span class='input-group-btn'>
                <button type="submit" class="btn btn-primary">Use tweet</button>
            </span>
        </input>
        </form>
        @endforeach
    @endif

 @stop
