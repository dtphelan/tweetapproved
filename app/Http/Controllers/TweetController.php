<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TweetController extends Controller {
    /**
    * Responds to requests to GET /tweet
    */
    public function getIndex() {
        /**$tweets = \App\Tweet::all();

        if(!$tweets->isEmpty()) {

            foreach($tweets as $tweet) {
                echo $tweet->tweet.'<br>';
            }
        }
        else {
            echo 'No tweets yet';
        }**/

        $tweets = \App\Tweet::where('status', 'LIKE', 1)->get();

        return view('tweet.index')->with('tweets',$tweets);
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
    public function postCreate(Request $request) {
        #return 'Add the tweet: '.$_POST['title'];
        $this->validate(
            $request,
            [
                'tweet' => 'required|max:140',
            ]
        );

        $tweet = new \App\Tweet();
        $tweet->tweet = $request->tweet;
        $tweet->image = $request->image;
        $tweet->status = $request->status;

        $tweet->save();

        return redirect('/tweet/create');
    }

    /**
    * Responds to GET /tweet/approve
    */

    public function getApprove() {
        $tweet = \App\Tweet::where('status', 'LIKE', 0)->first();

        return view('tweet.approve')->with('tweet',$tweet);
    }

    public function postApprove(Request $request) {
        $this->validate(
            $request,
            [
                'tweet' => 'required|max:140',
            ]
        );

        $tweet = \App\Tweet::where('id', 'LIKE', $request->id)->first();
        $tweet->tweet = $request->tweet;
        $tweet->status = $request->status;

        $tweet->save();

        return redirect('/');
        }

    public function getUsed() {
        $tweets = \App\Tweet::where('status', 'LIKE', 3)->get();

        return view('tweet.used')->with('tweets',$tweets);
    }

} # eoc
