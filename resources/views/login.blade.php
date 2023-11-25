<div>
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
    <a href="{{url('/register')}}">Sign Up</a>

    <!-- @if (!empty($infoMessage))
        <p>Info: {{ $infoMessage }}</p>
    @endif -->

    @if (!empty($wrongPasswordMessage))
        <p>Info: {{ $wrongPasswordMessage }}</p>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ url('/authenticate') }}" method="post">
        @csrf
        <label for="email">email</label>
        <input type="email" name="email" id="email" required maxlength="255">
    
        <label for="password">password</label>
        <input type="password" name="password" id="password" required maxlength="255">

        <button type="submit">Submit</button>
    </form>
</div>
