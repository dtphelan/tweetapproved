@extends('layouts.master')

 @section('title')
     Add a new tweet
 @stop

 @section('content')

     <h1>Create Tweets!</h1>

     <form method='POST' action='/tweet/create'>

        <input type='hidden' value='{{ csrf_token() }}' name='_token'>
        <input type='hidden' value='0' name='status' id='status'>
        <input type='hidden' value='{{ Auth::user()->name }}' name='author' id='autor'>
        <input type='hidden' value='{{ Auth::user()->organization }}' name='organization' id='organization'>

         <div class='form-group'>
            <input
                type='textarea'
                class='form-control'
                id='tweet'
                name='tweet'
            >
         </div>

         <button type="submit" class="btn btn-primary">Add tweet</button>
     </form>

 @stop
