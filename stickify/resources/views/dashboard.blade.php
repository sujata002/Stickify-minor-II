<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Stickify</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- Font Awesome -->
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
        <a href="#"><i class="fa-solid fa-bars"></i> Dashboard</a>
        <a href="{{route('mynotes')}}"><i class="fa-solid fa-note-sticky"></i> My Notes</a>
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

    <!-- Main -->
    <main class="main">
    <!-- TOPBAR: Username + Icon (top right corner) -->
      <div class="user-topbar">
        <div class="dashboard-title">Stickify User Dashboard</div>
        <div class="user-info">
          <i class="fa-solid fa-user"></i>
          <span class="username-text">Hello, {{ Auth::user()->name }}</span> <!-- used auth user name to display name of currently logged in user-->
        </div>
        </div>
  
      <!-- Top Toolbar -->
      <div class="tabs" style="display: flex; flex-direction: column; gap: 10px; margin: 20px 20px;">
        <!-- First Row: Generate Token + Token Display -->
        <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 12px;">
        
        <!-- NO form -->
         <form id="tokenForm" method="POST" action="{{ route('generate.token') }}">
          @csrf
          <button type="submit" class="tab-btn" style="background-color: #28a745; color: white; padding: 8px 12px; border: none; border-radius: 4px;">
            Generate Token
          </button>
        </form>

          

          <div id="generatedTokenContainer" style="align-items: center; gap: 8px;">
            <!-- <label style="font-weight: bold;">Token Generated:</label> -->
            <input value="{{ session('token') }}" type="text" id="generatedTokenValue" readonly style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; background-color: #fff; cursor: pointer;">
            <small style="color: #555;">Click the box to copy the token.</small>
          </div>
        </div>

        <!-- Second Row: Search and Filters -->
        <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 12px;">
          <div style="display: flex; align-items: center; background-color: white; border: 1px solid #ccc; padding: 6px 10px; border-radius: 4px;">
            <i class="fa-solid fa-magnifying-glass" style="margin-right: 6px; color: #888;"></i>
            <input type="text" placeholder="Search your notes..." style="border: none; outline: none; width: 200px;">
          </div>

          <button class="tab-btn" style="padding: 6px 12px; border: 1px solid #ccc; border-radius: 4px;">All</button>
          <button class="tab-btn" style="padding: 6px 12px; border: 1px solid #ccc; border-radius: 4px;">Bookmarked</button>

          <button class="add-note-btn" style="margin-left: auto; background-color: #28a745; color: white; padding: 8px 16px; border: none; border-radius: 4px;">
            <i class="fa-solid fa-plus"></i> New Note
          </button>
        </div>
      </div>

    <!-- Notes Grid -->
    <div class="notes-grid">
        <div class="note-card">
          <div class="note-header">
            <span class="note-date"></span>
            <div class="note-actions">
              <button title="Bookmark"><i class="fa-regular fa-bookmark"></i></button>
              <button title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
              <button title="Delete"><i class="fa-regular fa-trash-can"></i></button>
              <button title="Save Note"><i class="fa-solid fa-floppy-disk"></i></button>
            </div>
          </div>
          <h3 class="note-title" contenteditable="true">Note Title</h3>
          <div class="note-content" contenteditable="true"></div>
          <div class="note-link"><a href="#" contenteditable="true">Add a link</a></div>
        </div>
      </div>
    </main>
  </div>

  <!-- Note Modal -->
  <div id="noteModal" class="modal">
    <div class="modal-content">
      <span class="closeNoteBtn">&times;</span>
      <div class="note-modalcard">
        <div class="note-header">
          <div class="note-modalactions">
            <button title="Bookmark"><i class="fa-regular fa-bookmark"></i></button>
            <button title="Delete"><i class="fa-regular fa-trash-can"></i></button>
            <button title="Save Note"><i class="fa-solid fa-floppy-disk"></i></button>
          </div>
        </div>
        <h3 class="note-modaltitle" contenteditable="true">Note Title</h3>
        <div class="note-modalcontent" contenteditable="true"></div>
        <div class="note-link"><a href="#" contenteditable="true">Add a link</a></div>
      </div>
    </div>
  </div>

  <!-- Settings Modal -->
  <div id="modalSettings" class="modal">
    <div class="modal-content">
      <span class="closeSettingsBtn">&times;</span>
      <div class="settingsContent">
        <h2 style="text-align: center;">Settings</h2>
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

  <!-- Profile Modal -->
  <div id="modalProfile" class="modal">
    <div class="modal-content">
      <span class="closeProfileBtn">&times;</span>
      <div class="profileContent">
        <label for="profileName">Name:</label>
        <input type="text" id="profileName" placeholder="Your Name">
        <label for="profileEmail">Email:</label>
        <input type="email" id="profileEmail" placeholder="Email">
        <label for="profileLocation">Location:</label>
        <input type="text" id="profileLocation" placeholder="Your Location">
      </div>
    </div>
  </div>

  <!-- Token Modal -->
  <div id="modalToken" class="modal">
    <div class="modal-tokencontent">
      <span class="closeTokenBtn">&times;</span>
      <div class="tokenContent">
        <h2>Extension Token</h2>
        <div id="tokenDisplay" class="token-display">Click below to generate</div>
        <div class="token-actions">
         <form id="tokenForm" method="POST" action="{{ route('generate.token') }}">
               <button id="generateExtensionTokenBtn" type="submit">Generate Token</button>
          </form>
         <button id="copy-btn">Copy to Clipboard</button>
        </div>
        <p class="token-note">Use this token to link your browser extension securely.</p>
      </div>
    </div>
  </div>

  <!-- for settings pop up garchha-->
  <div id="modalSettings" class="modal">
    <div class="modal-content">
      <span class="closeSettingsBtn">&times;</span>
      <div class="settingsContent">
        <div class="settings">
          <h1>Settings</h1>

          <div class="settings-option">
            <label for="theme">Theme:</label><!--optional-->
            <select id="theme">
              <option value="light">Light</option>
              <option value="dark">Dark</option>
            </select>
          </div>

          <div class="settings-option">
            <button id="passwordBtn">Reset Password</button>
            <button id="deleteAccountBtn">Delete Account</button>
            <button id="installExtensionBtn">Install Browser Extension</button>
            <button id="upgradePlanBtn">Upgrade Plan</button>
          </div>
        </div>
      </div>
    </div>
</div>
   
  <!-- External JS -->
  <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
