<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <nav class="navbar">
        <img src="images/logo.png" style="height: 60px">
        <h1>QuickNotes</h1>
        <div class="nav-container">
          <a href="{{url ('/login')}}">Log In</a>
          <a href="{{url('/register')}}">Sign Up</a>
        </div>
    </nav>
</head>
<body>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>