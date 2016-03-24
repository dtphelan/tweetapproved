@extends('layouts.master')

 @section('title')
     Revise tweets
 @stop

 @section('content')
     <h1>Revise Tweets!</h1>

     @if(sizeof($tweets) == 0)
        No tweets to revise!
     @else
        @foreach($tweets as $tweet)
        <form method='POST' action='/tweet/revise'>
            <input type='hidden' value='{{ csrf_token() }}' name='_token'>
            <input type='hidden' value='{{ $tweet->id }}' name='id'>
            <div class='form-group'>
                <input
                    type='textarea'
                    class='form-control'
                    id='tweet'
                    name='tweet'
                    value='{{ $tweet->tweet }}'
                >
            </div>
            @if(!$tweet->comment == 0)
            <div class='form-group'>
                <input
                    type='textarea'
                    class='form-control'
                    id='comment'
                    name='comment'
                    value='{{ $tweet->comment }}'
                    disabled
                >
            </div>
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
           <button type="submit" name='status' value='0' class="btn btn-primary">Resubmit tweet</button>
        </form>
        @endforeach
     @endif

    @if(count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class= 'alert alert-danger alert-dismissible' role='alert'>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p>{{ $error }}</p>
            </div>
        @endforeach
    @endif

    @if(isset($confirm))
        <div class= 'alert alert-success alert-dismissible' role='alert'>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p>Well done! Tweet submitted.</p>
        </div>
    @endif

@stop
