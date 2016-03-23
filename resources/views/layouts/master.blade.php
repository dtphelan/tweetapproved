<!doctype html>
<html>
<head>
    <title>
        @yield('title','Tweet Approver')
    </title>

    <meta charset='utf-8'>

    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' rel='stylesheet'>

    <!-- Latest compiled and minified CSS -->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>
    <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/lumen/bootstrap.min.css' rel='stylesheet'>

    <link href='/css/style.css' rel='stylesheet'>

    {{-- Yield any page specific CSS files or anything else you might want in the <head> --}}
    @yield('head')

</head>
<body>

    <header>
        <nav class='navbar navbar-default navbar-fixed-top'>
          <div class='container'>
              <div class='navbar-header'>
                <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
                  <span class='sr-only'>Toggle navigation</span>
                  <span class='icon-bar'></span>
                  <span class='icon-bar'></span>
                  <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand' href='#'>Tweet Approver</a>
              </div>
          <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
            <ul class='nav navbar-nav'>
                <li><a href='/'>Approve<span class='sr-only'>(current)</span></a></li>
                <li><a href='/tweet/create'>Create</a></li>
                <li><a href='/tweet/revise'>Revise</a></li>
                <li><a href='/tweet'>Tweet</a></li>
                <li><a href='/tweet/used'>Archive</a></li>
                @if(Auth::check())
                <p class='navbar-text navbar-right'><?php echo Auth::user()->name; ?></p>
                    @if(!Auth::user()->organization == 0)
                        <p class='navbar-text navbar-right text-uppercase'><?php echo Auth::user()->organization; ?></p>
                    @endif
                <button type='button' class='btn btn-default navbar-btn navbar-right'><a href='/logout/'>Log out</a></button>
                @else
                <button type='button' class='btn btn-default navbar-btn navbar-right'><a href='/login/'>Log in</a></button>
                @endif
            </ul>
        </div>
        </nav>
    </header>


    <section>
        <div class='container'>
            {{-- Main page content will be yielded here --}}
            @yield('content')
        </div>
    </section>

    <footer>
        &copy; {{ date('Y') }} &nbsp;&nbsp;

    </footer>

    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' crossorigin='anonymous'></script>

    {{-- Yield any page specific JS files or anything else you might want at the end of the body --}}
    @yield('body')

</body>
</html>
