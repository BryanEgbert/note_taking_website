<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>notelist</title>
    <link rel="stylesheet" href="{{ asset('css/notelist.css') }}">
    <nav class="navbar">
        <img src="images/logo.png" style="height: 60px">
        <h1>QuickNotes</h1>
        <div>
            <form action='{{ url("/logout") }}' method="post">
                @csrf
                <button type="submit" id="logout">Logout</button>
            </form> 
        </div>
    </nav>
</head>
<body>
    <div class="wrapper">
        <div class="list-container">
            <h3>Notes List</h3>
        
            <nav>
                @foreach ($notes as $note)
                    <section class="note-container">
                        <div class="note-title">
                            <a href="#" onclick="showContent('{{ $note->id }}', '{{ $note->title }}', '{{ $note->content }}')" class="{{ $note->id }}" style="font-weight: bold;">{{ $note->title }}</a>
                        </div>
                        <form action='{{ url("notes/$note->id") }}' method="POST" class="delete-button">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">
                                <img src="images/deletebutton.png" style="height: 20px; width: 20px;">
                            </button>
                        </form>
                    </section>
                @endforeach
            </nav>

            <div>
                <a href="{{ $notes->previousPageUrl() }}">Previous</a>
                <a href="{{ $notes->nextPageUrl() }}">Next</a>
            </div>
        </div>
        
        <div class="createlist">
            <!-- <div class="addnewbutton-container"> -->
            <button id='addNewButton'>Add New</button>
            <!-- </div> -->
            <section id="content" style="display: none;">
                <!-- Actionnya bakal ditambahin di lewat code JS  -->
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
            <form id="createNoteForm" action="{{ url('notes') }}" method="POST" style="display: none;">
                @csrf
                <label for="title" style="color: black">title: </label>
                <input type="text" name="title" id="titleInput">

                <label for="content" style="color: black">content: </label>
                <textarea name="content" id="contentInput" cols="30" rows="10"></textarea>

                <button type="submit">Create</button> 
                <button type="button" onclick="closeCreateNoteForm()">Close</button>       
            </form>

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

                function closeCreateNoteForm() {
                    document.getElementById("createNoteForm").style.display = "none";
                }

                document.getElementById("addNewButton").onclick = function (e) {
                    document.getElementById("createNoteForm").style.display = "block";
                };
            </script>
        </div>
    </body>
</div>    
</html>