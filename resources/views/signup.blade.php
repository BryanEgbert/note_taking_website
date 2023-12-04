@extends('layout/master')

@section('title', 'Login Page')

@section('content')

<div class="container">
    <header>
        <h2>Sign Up</h2>
    </header>

    <form action="{{ url('/user') }}" method="post">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required maxlength="255">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required maxlength="255">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required maxlength="255">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <button type="submit">Sign Up</button>
    </form>

    <div class="divider"></div>

    <a href="{{url('/')}}">Log In</a>
</div>
@endsection
