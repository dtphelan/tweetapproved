@extends('layouts.master')

 @section('title')
     Unused tweets
 @stop

 @section('content')
     <h1>Tweet Tweets!</h1>
     @if(sizeof($tweets) == 0)
        <p>No tweets!</p>
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
           @if(!$tweet->comment == 0)
           <div class='input-group'>
               <span class='input-group-addon' id='basic-addon1'>Comment:</span>
               <input
                   type='textarea'
                   class='form-control'
                   id='comment'
                   name='comment'
                   value='{{ $tweet->comment }}'
                   disabled
                   aria-describedby='basic-addon3'
               >
           </div>
           <br>
           @endif
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
                <button type="submit" name='archive' value='no' class="btn btn-primary">Tweet with Twitter</button>
            </span>
            <span class='input-group-btn'>
                <button type="submit" name='archive' value='yes' class="btn btn-primary">Archive</button>
            </span>
        </input>
        </form>
        @endforeach
    @endif

 @stop
