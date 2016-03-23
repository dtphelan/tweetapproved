<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Abraham\TwitterOAuth\TwitterOAuth;

class TweetController extends Controller {
    /**
    * Responds to requests to GET /tweet
    */
    public function getIndex() {
        $tweets = \App\Tweet::where('status', 'LIKE', 1)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->get();

        define('CONSUMER_KEY', 'LY9r8xRNJqru5VdijPsDXiIDe');
        define('CONSUMER_SECRET', 'oid3a77Cy04CKXzTTtF3aocXAPNqGxuLNmTwPLUb1ruzLbbvxx');
        define('OAUTH_CALLBACK', getenv('OAUTH_CALLBACK'));

        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

        return view('tweet.index')
            ->with('tweets',$tweets)
            ->with('url',$url);
    }

    /**public function getAuth() {
        $tweets = \App\Tweet::where('status', 'LIKE', 1)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->get();


        define('CONSUMER_KEY', 'LY9r8xRNJqru5VdijPsDXiIDe');
        define('CONSUMER_SECRET', 'oid3a77Cy04CKXzTTtF3aocXAPNqGxuLNmTwPLUb1ruzLbbvxx');
        define('OAUTH_CALLBACK', getenv('OAUTH_CALLBACK'));

        $request_token = [];
        $request_token['oauth_token'] = $_SESSION['oauth_token'];
        $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

        if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
            // Abort! Something is wrong.
        }

        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
        $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);

        $_SESSION['access_token'] = $access_token;

        return view('tweets.index')
            ->with('tweets',$tweets);
}
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
        $tweet->status = $request->status;
        $tweet->author = $request->author;
        $tweet->organization = $request->organization;

        $tweet->save();

        return redirect('/tweet/create');
    }

    /**
    * Responds to GET /tweet/approve
    */

    public function getApprove() {
        $tweet = \App\Tweet::where('status', 'LIKE', 0)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->get();

        return view('tweet.approve')->with('tweet',$tweet);
    }

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

        $tweet->save();

        return redirect('/tweet/approve');
        }

    public function getUsed() {
        $tweets = \App\Tweet::where('status', 'LIKE', 3)
            ->orwhere('status', 'LIKE', 4)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->get();

        return view('tweet.used')->with('tweets',$tweets);
    }

    public function postUsed(Request $request) {
        $tweet = \App\Tweet::where('id', 'LIKE', $request->id)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->first();
        $tweet->status = $request->status;

        $tweet->save();

        return redirect('/tweet');
    }

    public function getRevise() {
        $tweets = \App\Tweet::where('status', 'LIKE', 5)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->get();

        return view('tweet.revise')->with('tweets',$tweets);
    }

    public function postRevise(Request $request) {
        $tweet = \App\Tweet::where('id', 'LIKE', $request->id)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->first();
        $tweet->status = $request->status;
        $tweet->tweet = $request->tweet;

        $tweet->save();

        return redirect('/tweet/revise');
    }

    public function postDelete(Request $request) {
        $tweet = \App\Tweet::where('id', 'LIKE', $request->id)
            ->where('organization', 'LIKE', Auth::user()->organization)
            ->first();

        $tweet->delete();

        return redirect('/tweet/used');
    }
} # eoc
