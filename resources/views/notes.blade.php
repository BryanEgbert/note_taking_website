<h3>Notes List</h3>

<form action='{{ url("/logout") }}' method="get">
    <button type="submit">Logout</button>
</form>

<button id='addNewButton'>Add New</button>

<form id="createNoteForm" action="{{ url('notes') }} " method="POST", style="display: none;">
    @csrf
    <label for="title">title: </label>
    <input type="text" name="title" id="titleInput">

    <label for="content">content: </label>
    <textarea name="content" id="contentInput" cols="30" rows="10"></textarea>

    <button type="submit">Create</button>
</form>

<div class="main" style="display: flex; gap: 5em; overflow-y: hidden">
    <nav id="noteTitle">
        @foreach ($notes as $note)
            <section>
                <a href="#" onclick="showContent('{{ $note->id }}', '{{ $note->title }}', '{{ $note->content }}')" class="{{ $note->id }}" style="font-weight: bold;">{{ $note->title }}</a>
                <form action='{{ url("notes/$note->id") }}' method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </section>
        @endforeach

        <a href="{{ $notes->nextPageUrl() }}">next</a>
        <a href="{{ $notes->previousPageUrl() }}">previous</a>
    </nav>
    
    <section id="content" style="display: none;">
        <!-- Actionnya bakal ditambahin di lewat code JS -->
        <form id='contentForm' action='' method="post">
            @csrf
            @method('PUT')
            <input type="text" 
                style="display: block; font-size: 1.5em; margin-top: 0.83em; margin-bottom: 0.83em; margin-left: 0; margin-right: 0; font-weight: bold;" 
                name="editTitle" 
                id="editTitle">
            <textarea style="word-break: break-word; -ms-word-break: break-word;" name="editContent" id="editContent" cols="100" rows="10"></textarea>
            <button type="submit">Submit</button>
        </form>
    </section>    
</div>

<script>
    function showContent(id, title, content) {
        let contentElem = document.getElementById("content");
        contentElem.style.display = "inherit";

        let contentFormElem = document.getElementById("contentForm");
        contentFormElem.onsubmit = function(e) {
            e.preventDefault();
            this.display = "none";
        };

        contentFormElem.action = `notes/${id}`;
        // content
        let editTitleInputElem = document.getElementById("editTitle");
        editTitleInputElem.value = title;

        let editContentElem = document.getElementById("editContent");
        editContentElem.innerText = content;
        
        contentElem.firstElementChild.value = title;
    }

    document.getElementById("addNewButton").onclick = function (e) {
        document.getElementById("createNoteForm").style.display = "block";
    };
</script>
