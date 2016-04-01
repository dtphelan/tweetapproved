<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use Thujohn\Twitter\Facades\Twitter;

class TweetController extends Controller {

    /* Index of approved tweets, responds to /tweet */
    public function getTweet() {
        $tweets = \App\Tweet::where('status', 'LIKE', 1)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->get();

        return view('tweet.tweet')
            ->with('tweets',$tweets);
    }

    /* Marks a tweet as used */
    public function postTweet(Request $request) {
            if($request->archive == 'yes') {
                $tweet = \App\Tweet::where('id', 'LIKE', $request->id)
                    ->where('organization', 'LIKE', Auth::user()->organization)
                    ->first();
                $tweet->status = $request->status;

                $tweet->save();

                return redirect('/tweet');
            }
            else {
                if($request->session()->has('access_token')) {

                    $tweet = \App\Tweet::where('id', 'LIKE', $request->id)
                        ->where('organization', 'LIKE', Auth::user()->organization)
                        ->first();
                    $tweet->status = $request->status;

                    $tweet->save();

                    $status = $tweet->tweet;

                    Twitter::postTweet(['status' => $status, 'format' => 'json']);

                    return redirect('/tweet');
                }
                else {
                    return redirect('twitter/login');
                }
            }
    }

    /* Form to create a new tweet */
    public function getCreate() {
        return view('tweet.create');
    }

    /* Responds to POST Create, adds tweet to database, returns create form with confirmation */
    public function postCreate(Request $request) {
        $this->validate(
            $request,
            [
                'tweet' => 'required|max:140',
            ]
        );

        $tweet = new \App\Tweet();
        $tweet->tweet = $request->tweet;
        $tweet->status = $request->status;
        $tweet->author = $request->author;
        $tweet->organization = $request->organization;
        $tweet->countDisplay = $request->countDisplay;

        $tweet->save();

        $confirm = 'yes';

        return view('tweet.create')
            ->with('confirm',$confirm);
    }


    /* Responds to /approve, gets tweets that need approval */
    public function getApprove() {
        $tweet = \App\Tweet::where('status', 'LIKE', 0)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->get();

        return view('tweet.approve')
            ->with('tweet',$tweet);
    }

    /* Responds to POST /approve, approves tweet */
    public function postApprove(Request $request) {
        $this->validate(
            $request,
            [
                'tweet' => 'required|max:140',
            ]
        );

        $tweet = \App\Tweet::where('id', 'LIKE', $request->id)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->first();
        $tweet->tweet = $request->tweet;
        $tweet->status = $request->status;
        $tweet->comment = $request->comment;
        $tweet->countDisplay = $request->countDisplay;

        $tweet->save();

        $tweet = \App\Tweet::where('status', 'LIKE', 0)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->get();

        return view('tweet.approve')
            ->with('tweet',$tweet);

        }

    /* Responds to /tweet/revise, makes a list of tweets that need revision */
    public function getRevise() {
        $tweets = \App\Tweet::where('status', 'LIKE', 5)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->get();

        return view('tweet.revise')
            ->with('tweets',$tweets);
    }

    /* Revises and resubmits tweet */
    public function postRevise(Request $request) {
        $tweet = \App\Tweet::where('id', 'LIKE', $request->id)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->first();
        $tweet->status = $request->status;
        $tweet->tweet = $request->tweet;
        $tweet->countDisplay = $request->countDisplay;

        $tweet->save();

        $confirm = 'yes';

        $tweets = \App\Tweet::where('status', 'LIKE', 5)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->get();

        return view('tweet.revise')
            ->with('confirm',$confirm)
            ->with('tweets',$tweets);
    }

    /* Responds to /tweet/archive, makes a list of used tweets */
    public function getArchive() {
        $tweets = \App\Tweet::where('status', 'LIKE', 3)
            ->orwhere('status', 'LIKE', 4)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->get();

        return view('tweet.archive')
            ->with('tweets',$tweets);
    }


    /* Deletes a tweet from the database */
    public function postDelete(Request $request) {
        $tweet = \App\Tweet::where('id', 'LIKE', $request->id)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->first();

        $tweet->delete();

        return redirect('/tweet/archive');
    }

} # eoc
