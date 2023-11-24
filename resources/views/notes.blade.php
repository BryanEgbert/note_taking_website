<h3>Notes List</h3>
<form action="{{ url('notes') }} " method="POST">
    @csrf
    <label for="title">title: </label>
    <input type="text" name="title" id="title">

    <label for="content">content: </label>
    <textarea name="content" id="content" cols="30" rows="10"></textarea>

    <button type="submit">Submit</button>
</form>
@foreach ($notes as $note)
    <li class="{{ $note->id }}">{{ $note->title }}</li>
    <form action='{{ url("notes/$note->id") }}' method="POST">
        @method('DELETE')
        @csrf
        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
@endforeach
