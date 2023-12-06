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
                <button type="submit" id="logout" class="logout-btn">Logout</button>
            </form> 
        </div>
    </nav>
</head>
<body>
    <div class="wrapper">
        <div class="list-container">
            <h3>Notes List</h3>
        
            <nav>
                @forelse ($notes as $note)
                    <section class="note-container">
                        <a href="#" class="note-title-link" onclick='showContent(`{{ url("notes/$note->id ") }}`, `{{ $note->title }}`, `{{ $note->content }}`)' id="note-title-{{ $note->id }}" style="font-weight: bold;">{{ $note->title }}</a>
                        <!-- <div class="note-title">
                        </div> -->
                        <form action='{{ url("notes/$note->id") }}' method="POST" class="delete-button">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">
                                <img src="images/deletebutton.png" style="height: 20px; width: 20px;">
                            </button>
                        </form>
                    </section>
                    <hr style="color: lightgray; padding: 0; margin: 0">
                @empty
                    <div style="height: 60vh;">
                        <p style="text-align: center">No Data</p>
                    </div>
                @endforelse
            </nav>

            <div style="margin: 0.8em 0;">
                <a href="{{ $notes->previousPageUrl() }}">Previous</a>
                <a href="{{ $notes->nextPageUrl() }}">Next</a>
            </div>
        </div>
        
        <div class="createlist">
            <!-- <div class="addnewbutton-container"> -->
            <button id='addNewButton'>Add New</button>
            <!-- </div> -->
            <form id="updateNoteForm" action="" method="POST" style="display: none;">
                @csrf
                @method('PUT')
                <label for="editTitle" style="color: black">title: </label>
                <input type="text" name="editTitle" id="editTitle">

                <label for="editContent" style="color: black">content: </label>
                <textarea name="editContent" id="editContent" cols="30" rows="20"></textarea>

                <div style="margin: 0.5em 0;">
                    <button type="submit">Update</button>
                    <button type="button" id="updateNoteFormCloseBtn" onclick="closeUpdateNoteForm()">Close</button>       
                </div>
            </form>
            
            <form id="createNoteForm" action="{{ url('notes') }}" method="POST" style="display: none;">
                @csrf
                <label for="title" style="color: black">title: </label>
                <input type="text" name="title" id="titleInput">

                <label for="content" style="color: black">content: </label>
                <textarea name="content" id="contentInput" cols="30" rows="20"></textarea>
                <div style="margin: 0.5em 0;">
                    <button type="submit">Create</button> 
                    <button type="button" id="createNoteFormCloseBtn" onclick="closeCreateNoteForm()">Close</button>       
                </div>
            </form>

            <script>
                window.onload = function (e) {
                    const urlParams = new URLSearchParams(window.location.search);
                    const idParam = urlParams.get('id');

                    if (idParam === null) return;
 
                    document.getElementById(`note-title-${idParam}`);

                    let contentFormElem = document.getElementById("updateNoteForm");
                    contentFormElem.style.display = "flex";

                    let editTitleInputElem = document.getElementById("editTitle");
                    editTitleInputElem.value = "{{ Session::get('title', '') }}";
    
                    let editContentElem = document.getElementById("editContent");
                    editContentElem.value = "{{ Session::get('content', '') }}";
                }

                function showContent(url, title, content) {
                    document.getElementById("createNoteForm").style.display = "none";

                    let contentFormElem = document.getElementById("updateNoteForm");
                    contentFormElem.style.display = "flex";
                    contentFormElem.onsubmit = function(e) {
                        this.display = "none";
                    };

                    contentFormElem.action = url;

                    let editTitleInputElem = document.getElementById("editTitle");
                    editTitleInputElem.value = title;
    
                    let editContentElem = document.getElementById("editContent");
                    editContentElem.value = content;
                }

                document.getElementById("createNoteFormCloseBtn").onclick = function (e) {
                    document.getElementById("createNoteForm").style.display = "none";
                }

                document.getElementById("updateNoteFormCloseBtn").onclick = function (e) {
                    document.getElementById("updateNoteForm").style.display = "none";
                }

                document.getElementById("addNewButton").onclick = function (e) {
                    document.getElementById("updateNoteForm").style.display = "none";
                    let contentFormElem = document.getElementById("createNoteForm");
                    contentFormElem.action = '{{ url("notes") }}';
                    contentFormElem.style.display = "flex";

                    let editTitleInputElem = document.getElementById("titleInput");
                    editTitleInputElem.value = "";
    
                    let editContentElem = document.getElementById("contentInput");
                    editContentElem.innerText = "";
                };
            </script>
        </div>
    </body>
</div>    
</html>