<div>
    <a href="{{url('/login')}}">Login</a>

    <!-- @if (!empty($errorMessage))
        <p>Error: {{ $errorMessage }}</p>
    @endif -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ url('/user') }}" method="post">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required maxlength="255">
    
        <label for="email">email</label>
        <input type="email" name="email" id="email" required maxlength="255">
    
        <label for="password">password</label>
        <input type="password" name="password" id="password" required maxlength="255">

        <button type="submit">Submit</button>
    </form>
</div>