@extends('layouts.master')

@section('title')
    Approve tweets
@stop

@section('head')
    <!-- Character count function, from https://www.developphp.com/video/JavaScript/textarea-Form-Field-Character-Counting-and-Limiting -->
    <script>
        var maxAmount = 140;
        function textCounter(textField, showCountField) {
            if (textField.value.length > maxAmount) {
                textField.value = textField.value.substring(0, maxAmount);
        	} else {
                showCountField.value = maxAmount - textField.value.length;
        	}
        }
    </script>
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
                        id='tweet{{ $tweet->id }}'
                        name='tweet'
                        value='{{ $tweet->tweet }}'
                        onKeyDown="textCounter(this.form.tweet{{ $tweet->id }},this.form.countDisplay);"
                        onKeyUp="textCounter(this.form.tweet{{ $tweet->id }},this.form.countDisplay);"
                    >
                </div>
                <div class='input-group'>
                    <span class='input-group-addon' id='basic-addon1'>Comment:</span>
                    <input
                        type='textarea'
                        class='form-control'
                        id='comment'
                        name='comment'
                        placeholder='Comments? Leave them here.'
                    >
                </div>
                <br>
                <div class='input-group'>
                    <span class='input-group-addon' id='basic-addon3'>Characters Remaining:</span>
                    <input class='form-control' readonly type='text' name='countDisplay' value='{{ $tweet->countDisplay }}' aria-describedby='basic-addon3'>
                </div>
                <br>
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
