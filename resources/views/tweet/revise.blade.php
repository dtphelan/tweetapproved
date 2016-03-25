@extends('layouts.master')

 @section('title')
     Revise tweets
 @stop

 @section('head')
     <meta name="csrf-token" content="{{ csrf_token() }}">

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
                    id='tweet{{ $tweet->id}}'
                    name='tweet'
                    value='{{ $tweet->tweet }}'
                    onKeyDown='textCounter(this.form.tweet{{ $tweet->id }},this.form.countDisplay);'
                    onKeyUp='textCounter(this.form.tweet{{ $tweet->id }},this.form.countDisplay);'
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
            <div class='input-group'>
                <span class='input-group-addon' id='basic-addon3'>Characters Remaining:</span>
                <input class='form-control' readonly type='text' name='countDisplay' value='{{ $tweet->countDisplay }}' aria-describedby='basic-addon3'>
            </div>
            <br>
            @if(!$tweet->author == 0)
            <div class='input-group'>
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
            <br>
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
