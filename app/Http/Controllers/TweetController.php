<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
class TweetController extends Controller {
    /**
    * Responds to requests to GET /tweet
    */
    public function getIndex() {
        return view('tweet.index');
    }
    /**
     * Responds to requests to GET /tweet/show/{id}
     */
    public function getShow($tweet = null) {
        return view('tweet.show',[
            'tweet' => $tweet,
        ]);
    }
    /**
     * Responds to requests to GET /tweet/create
     */
    public function getCreate() {
        return view('tweet.create');
    }
    /**
     * Responds to requests to POST /tweet/create
     */
    public function postCreate() {
        #return 'Add the tweet: '.$_POST['title'];
        return redirect('/tweet');
    }
} # eoc
