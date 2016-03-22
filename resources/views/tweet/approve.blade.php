@extends('layouts.master')

 @section('title')
     Approve tweets
 @stop

 @section('content')

     <h1>Tweets without approval</h1>

     @if(sizeof($tweet) == 0)
        No new tweets!
     @else
     <form method='POST' action='/tweet/approve'>
        <input type='hidden' value='{{ csrf_token() }}' name='_token'>
        <input type='hidden' value='{{ $tweet->id }}' name='id'>
            <div class='form-group'>
                <label>* Tweet:</label>
                <input
                    type='text'
                    id='tweet'
                    name='tweet'
                    value='{{ $tweet->tweet }}'
                >
            </div>
            <div class='form-group'>
                <label>Don't approve:
                <input
                    type='radio'
                    id='status'
                    name='status'
                    value='2'
                >
                </label>
            </div>
            <div class='form-group'>
                <label>Approve:
                <input
                    type='radio'
                    id='status'
                    name='status'
                    value='1'
                >
                </label>
            </div>
        <button type="submit" class="btn btn-primary">Approve tweets</button>
     @endif

 @stop
