@extends('layouts.master')

@section('title')
TweetApproved
@stop

@section('content')
@if(!Auth::user())
    <div class='col-xs-6 col-sm-12'>
        <p>Welcome to TweetApproved. If you use TweetApproved, go ahead and log in. It's great!</p>
    </div>
    <div class='col-xs-6 col-sm-12'>
        <p>If you don't have an account, we're in a "closed Alpha" right now. Maybe some other day!</p>
    </div>

    <div class='col-xs-12'>
        <h1>Login</h1>

        @if(count($errors) > 0)
            <ul class='errors'>
                @foreach ($errors->all() as $error)
                    <li><span class='fa fa-exclamation-circle'></span> {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method='POST' action='/login'>

            {!! csrf_field() !!}

            <div class='form-group'>
                <label for='email'>Email</label>
                <input type='text' name='email' id='email' value='{{ old('email') }}'>
            </div>

            <div class='form-group'>
                <label for='password'>Password</label>
                <input type='password' name='password' id='password' value='{{ old('password') }}'>
            </div>

            <div class='form-group'>
                <input type='checkbox' name='remember' id='remember'>
                <label for='remember' class='checkboxLabel'>Remember me</label>
            </div>

            <button type='submit' class='btn btn-primary'>Login</button>

        </form>
    </div>
@endif
@stop
