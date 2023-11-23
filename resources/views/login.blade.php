<div>
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
    <a href="{{url('/register')}}">Sign Up</a>

    @if (!empty($infoMessage))
        <p>Info: {{ $infoMessage }}</p>
    @endif

    @if (!empty($errorMessage))
        <p>Info: {{ $errorMessage }}</p>
    @endif


    <form action="{{ url('/authenticate') }}" method="post">
        @csrf
        <label for="email">email</label>
        <input type="email" name="email" id="email">
    
        <label for="password">password</label>
        <input type="password" name="password" id="password">

        <button type="submit">Submit</button>
    </form>
</div>
