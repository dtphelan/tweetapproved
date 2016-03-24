@extends('layouts.master')

@section('title')
    Approve tweets
@stop

@section('content')

    <h1>Approve Tweets!</h1>

    @if(sizeof($tweet) == 0)
        No new tweets!
    @else

        @if(count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class= 'alert alert-danger alert-dismissible' role='alert'>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p>{{ $error }}</p>
                </div>
            @endforeach
        @endif

        @foreach($tweet as $tweet)
        <form method='POST' action='/tweet/approve'>
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
                <div class='form-group'>
                    <input
                        type='textarea'
                        class='form-control'
                        id='comment'
                        name='comment'
                        placeholder='Comments? Leave them here.'
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
            <button type='submit' name='status' value='1' class='btn btn-primary'>Good tweet</button>
            <button type='submit' name='status' value='4' class='btn btn-danger'>Bad tweet</button>
            <button type='submit' name='status' value='5' class='btn btn-warning'>Tweet needs revision</button>
        </form>
        @endforeach
     @endif

 @stop
