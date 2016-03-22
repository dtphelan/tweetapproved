@extends('layouts.master')

 @section('tweet')
     Add a new tweet
 @stop

 @section('content')

     <h1>Add a new tweet</h1>

     <form method='POST' action='/tweet/create'>

         {{ csrf_field() }}

         <div class='form-group'>
            <label>* Tweet:</label>
            <input
                type='text'
                id='title'
                name='title'
            >
         </div>

         <button type="submit" class="btn btn-primary">Add tweet</button>
     </form>

 @stop
