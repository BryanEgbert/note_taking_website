<div>
    <a href="{{url('/login')}}">Login</a>

    @if (!empty($errorMessage))
        <p>Error: {{ $errorMessage }}</p>
    @endif
    
    <form action="{{ url('/user/create') }}" method="post">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
    
        <label for="email">email</label>
        <input type="email" name="email" id="email" required>
    
        <label for="password">password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Submit</button>
    </form>
</div>