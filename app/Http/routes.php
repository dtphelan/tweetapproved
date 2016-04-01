<?php
Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        if(Auth::check()) {
            return redirect('/tweet/approve');
        }
        else {
            return view('welcome');
        }
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/tweet', 'TweetController@getTweet');
        Route::post('/tweet', 'TweetController@postTweet');
        Route::get('/tweet/create', 'TweetController@getCreate');
        Route::post('/tweet/create', 'TweetController@postCreate');
        Route::get('/tweet/approve', 'TweetController@getApprove');
        Route::post('/tweet/approve', 'TweetController@postApprove');
        Route::get('/tweet/archive', 'TweetController@getArchive');
        Route::post('/tweet/delete', 'TweetController@postDelete');
        Route::get('/tweet/revise', 'TweetController@getRevise');
        Route::post('/tweet/revise', 'TweetController@postRevise');

        Route::post('/bitly', 'BitlyController@postBitly');

        Route::get('twitter/login', ['as' => 'twitter.login', 'uses' =>'TwitterController@getLogin']);
        Route::get('twitter/callback', ['as' => 'twitter.callback', 'uses' => 'TwitterController@getCallback']);
        Route::get('twitter/error', 'TwitterController@getError');
        Route::get('twitter/logout', ['as' => 'twitter.logout', 'uses' => 'TwitterController@getLogout']);
    });

    Route::get('/practice', function() {
        $random = new Random();
        return $random->getRandomString(10);
    });

    # Show login form
    Route::get('/login', 'Auth\AuthController@getLogin');

    # Process login form
    Route::post('/login', 'Auth\AuthController@postLogin');

    # Process logout
    Route::get('/logout', function() {
        Auth::logout();
        return redirect('/');
    });

    # Show registration form
    # Route::get('/register', 'Auth\AuthController@getRegister');

    # Process registration form
    Route::post('/register', 'Auth\AuthController@postRegister');

    # Org logins
    Route::get('/register/{organization?}', function($organization)
        {
            return view('auth.register')->with('organization',$organization);
        });
    # Route::post('/register/{organization?}', 'Auth\AuthController@postRegister');

    # Restrict certain routes to only be viewable in the local environments
    if(App::environment('local')) {
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    }

    Route::get('/confirm-login-worked', function() {

    # You may access the authenticated user via the Auth facade
    $user = Auth::user();

    if($user) {
        echo 'You are logged in.';
        dump($user->toArray());
    } else {
        echo 'You are not logged in.';
    }

    return;

    });

    Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    /*
    The following line will output your MySQL credentials.
    Uncomment it only if you're having a hard time connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your live server, making your credentials public.
    */
    //print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});
});
