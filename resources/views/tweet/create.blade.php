@extends('layouts.master')

 @section('title')
     Add a new tweet
 @stop

 @section('content')

     <h1>Add a new tweet</h1>

     <form method='POST' action='/tweet/create'>

        <input type='hidden' value='{{ csrf_token() }}' name='_token'>
        <input type='hidden' value='0' name='status' id='status'>

         <div class='form-group'>
            <label>* Tweet:</label>
            <input
                type='text'
                id='tweet'
                name='tweet'
            >
         </div>

         <button type="submit" class="btn btn-primary">Add tweet</button>
     </form>

 @stop