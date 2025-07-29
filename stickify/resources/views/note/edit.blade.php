<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Stickify - Create Note</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/mynotes.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div class="container">

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
      <div class="logo">
        <p>STICKIFY</p>
      </div>
      <nav>
        <a href="{{ route('dashboard') }}"><i class="fa-solid fa-bars"></i> Dashboard</a>
        <a href="{{ route('mynotes') }}" class="active"><i class="fa-solid fa-note-sticky"></i> My Notes</a>
        <a href="#"><i class="fa-solid fa-bookmark"></i> Bookmarks</a>
        <a href="#"><i class="fa-solid fa-folder-plus"></i> Categories</a>
        <a href="#"><i class="fa-solid fa-trash"></i> Trash</a>
      </nav>
      <div class="projects">
        <a href="#" id="settingsLink"><i class="fa-solid fa-gear"></i> Settings</a>
        <a href="#"><i class="fa-solid fa-circle-question"></i> Help & Feedback</a>
        <a href="#"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
      </div>
    </aside>

    <!-- Settings Modal -->
    <div id="modalSettings" class="modal">
      <div class="modal-content">
        <span class="closeSettingsBtn">&times;</span>
        <div class="settingsContent">
          <div class="settings">
            <h1>Settings</h1>
            <div class="settings-option">
              <label for="theme">Theme:</label>
              <select id="theme">
                <option value="light">Light</option>
                <option value="dark">Dark</option>
              </select>
            </div>
            <div class="settings-option">
              <button id="passwordBtn">Reset Password</button>
              <button id="deleteAccountBtn">Delete Account</button>
              <button id="installExtensionBtn">Install Browser Extension</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
      <div class="notes-container">
        <div class="note-header">
          <a href="{{ route('mynotes') }}" class="create-note-btn">
            <i class="fa-solid fa-arrow-left"></i> Back to Notes
          </a>
        </div>

        <form action="{{ route('mynotes.update', $note->id) }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="noteTitle">Title</label>
            <input type="text" value="{{$note->title}}" id="noteTitle" name="title" placeholder="Enter note title" required>
          </div>
          <div class="form-group">
            <label for="noteText">Note</label>
            <textarea id="noteText" name="note_text" placeholder="Enter your note" rows="6" required>{{$note->note_text}}</textarea>
          </div>
          <button type="submit" id="saveNoteBtn">Save Note</button>
        </form>
      </div>
    </main>
  </div>

  <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
