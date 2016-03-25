@extends('layouts.master')

@section('title')
     Add a new tweet
@stop

@section('head')
    <meta name="csrf_token" content="{{ csrf_token() }}">

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
                onKeyDown='textCounter(this.form.tweet,this.form.countDisplay);'
                onKeyUp='textCounter(this.form.tweet,this.form.countDisplay);'
            >
        </div>

        <div class='input-group'>
            <span class='input-group-addon' id='basic-addon3'>Characters Remaining:</span>
            <input class='form-control' readonly type='text' name='countDisplay' value='140' aria-describedby='basic-addon3'>
        </div>

        <br>

        <button type='submit' class='btn btn-primary'>Add tweet</button>
     </form>

    @if(count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class= 'alert alert-danger alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <p>{{ $error }}</p>
            </div>
        @endforeach
    @endif

    @if(isset($confirm))
        <div class= 'alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <p>Well done! Tweet submitted.</p>
        </div>
    @endif

    <form name='bitly' action='' method=''>
        <input type='hidden' value='{{ csrf_token() }}' name='_token'>
        <div class='form-group'>
            <input
                type='textarea'
                class='form-control'
                id='longUrl'
                name='longUrl'
                placeholder='Link too long? Get a short one here.'
            >
        </div>

        <div id='bitly_form' class='form-group'>
        </div>

        <button type='submit' name='submit' id='submit_btn' class='button btn btn-primary'>Shorten URL</button>
    </form>


@stop

@section('body')
    <script>

        /* Allow the user to get a short URL without reloading the page and losing their tweet.
        Based on http://code.tutsplus.com/tutorials/submit-a-form-without-page-refresh-using-jquery--net-59 */
        $(function() {
            $(".button").click(function() {
            // validate and process form here

                var longUrl = $("input#longUrl").val();

                var dataString = 'longUrl='+ longUrl;
                // alert (dataString);return false;
                $.ajax({
                    type: "POST",
                    url: "/bitly",
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');

                        if (token) {
                              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    data: dataString,
                    success: function(output) {
                        $('#bitly_form').html("<div><p id='message'></p></div>");
                        $('#message').html("Your short URL: ").append(output)
                    }
                });

                return false;

            });
        });
    </script>
@stop
