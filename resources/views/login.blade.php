@extends('layout/master')

@section('title', 'Login Page')

@section('content')

<div class="container">
    <header>
        <h2>Log In</h2>
    </header>

    <form action="{{ url('/authenticate') }}" method="post">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required maxlength="255">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required maxlength="255">

        @if (!empty($wrongPasswordMessage))
        <p>Info: {{ $wrongPasswordMessage }}</p>
        @endif

        <button type="submit">Log In</button>
    </form>

    <div class="divider"></div>

    <a href="{{url('/register')}}">Sign up</a>
</div>
@endsection
