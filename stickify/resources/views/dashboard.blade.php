<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Stickify</title>
  <!-- Font Awesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />

</head>

<body>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
      <div class="logo">
        <p>STICKIFY</p>
      </div>

      <nav>
        <a href="#"><i class="fa-solid fa-bars"></i> Dashboard</a><!--dashboard ko page link garne i.e this home page only -->
        <a href="#"><i class="fa-solid fa-note-sticky"></i> My Notes</a><!--stoted page backendwork-->
        <a href="#"><i class="fa-solid fa-bookmark"></i> Bookmarks</a><!--optional-->
        <a href="#"><i class="fa-solid fa-folder-plus"></i> Categories</a><!--optional-->
        <a href="#"><i class="fa-solid fa-trash"></i> Trash</a><!--optional-->
      </nav>

      <div class="projects">
        <a href="#" id="settingsLink"><i class="fa-solid fa-gear"></i> Settings</a><!--pop up-->
        <a href="#"><i class="fa-solid fa-circle-question"></i> Help & Feedback</a><!--contacts sanga link garne-->
        <a href="#"><i class="fa-solid fa-right-from-bracket"></i> Logout</a><!--login snaga link garne-->
      </div>
    </aside>

    <!-- Main -->
    <main class="main">
      <div class="topbar">
        <div class="search">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" placeholder="Search your notes..." />
        </div>

        <div class="user-info" id="profileBtn" title="Profile"><!--pop up-->
          <i class="fa-solid fa-user"></i>
        </div>
      </div>

      <div class="tabs">
        <button>All</button>
        <button>Bookmarked</button>
        <button class="add-note-btn">
          <i class="fa-solid fa-plus"></i> New Note
        </button><!--database sanga link gaarne ig-->
        <button class="add-token-btn">
          <i class="fa-solid fa-plus"></i> Generate Token </button>
      </div>
      <!-- Notes-->
      <div class="notes-grid">
        <div class="note-card">
          <div class="note-header">
            <span class="note-date"></span><!-- Date of the note but idk how you put that so it's like this for now-->
            <div class="note-actions">
              <button title="Bookmark"><i class="fa-regular fa-bookmark"></i></button> <!--optional-->
              <button title="Edit"><i class="fa-regular fa-pen-to-square"></i></button><!--edit button-->
              <button title="Delete"><i class="fa-regular fa-trash-can"></i></button><!--delete button-->
              <button title="Save Note"><i class="fa-solid fa-floppy-disk"></i></button><!--save button-->
            </div>
          </div>
          <h3 class="note-title" contenteditable="true">Note Title</h3><!-- containtable="true" means its editable field -->
          <div class="note-content" contenteditable="true"> </div>
          <div class="note-link" containtable="true"> <!--url should be saved here-->
            <a href="#" contenteditable="true">Add a link</a>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!--for notes pop up-->
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
      <h3 class="note-modaltitle" contenteditable="true" placeholder="Note Title">Note Title</h3>
      <div class="note-modalcontent" contenteditable="true"></div>
      <div class="note-link">
        <a href="#" contenteditable="true">Add a link</a>
      </div>
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

  <!-- for profile pop up-->
  <div id="modalProfile" class="modal">
    <div class="modal-content">
      <span class="closeProfileBtn">&times;</span>
      <div class="profileContent">
        <label for="profileName">Name:</label>
        <input type="" id="profileName" placeholder="Your Name" value="">

        <label for="profileEmail">Email:</label>
        <input type="" id="profileEmail" placeholder="Email" value="">

        <label for="profileLocation">Location:</label>
        <input type="" id="profileLocation" placeholder="Your Location" value="">
      </div>
      </div>
      </div>
  
  
      <!-- for token pop up-->
    <div id="modalToken" class="modal">
    <div class="modal-tokencontent">
    <span class="closeTokenBtn">&times;</span>
    <div class="tokenContent">
      <h2>Extension Token</h2>
      <div id="tokenDisplay" class="token-display">Click below to generate</div>

      <div class="token-actions">
        <button id="generateExtensionTokenBtn">Generate Token</button>
        <button id="copyTokenBtn">Copy to Clipboard</button>
      </div>

      <p class="token-note">Use this token to link your browser extension securely.</p>
    </div>
  </div>
</div>
  
  <!-- Scripts -->
  <script src="dashboard.js"></script>

<!-- Scripts -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const tokenModal = document.getElementById("modalToken");
  const generateBtn = document.getElementById("generateExtensionTokenBtn");
  const copyBtn = document.getElementById("copyTokenBtn");
  const tokenDisplay = document.getElementById("tokenDisplay");
  const closeTokenBtn = document.querySelector(".closeTokenBtn");
  const triggerTokenBtn = document.querySelector(".add-token-btn");

  // Show modal on button click
  triggerTokenBtn.addEventListener("click", () => {
    tokenModal.style.display = "block";
  });

  // Close modal
  closeTokenBtn.addEventListener("click", () => {
    tokenModal.style.display = "none";
  });

  // Copy token to clipboard
  copyBtn.addEventListener("click", () => {
    if(tokenDisplay.textContent.trim() && tokenDisplay.textContent !== 'Click below to generate'){
      navigator.clipboard.writeText(tokenDisplay.textContent).then(() => {
        copyBtn.textContent = "Copied!";
        setTimeout(() => (copyBtn.textContent = "Copy to Clipboard"), 1500);
      });
    }
  });

  // Generate token using fetch AJAX
  generateBtn.addEventListener("click", async () => {
    generateBtn.disabled = true;
    generateBtn.textContent = "Generating...";
    try {
      const response = await fetch("{{ route('generate.token') }}", {
        method: "POST",
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify({})
      });

      if (!response.ok) throw new Error('Network response was not ok');

      const data = await response.json();
      tokenDisplay.textContent = data.token || 'Error generating token';
    } catch (error) {
      tokenDisplay.textContent = 'Failed to generate token';
      console.error('Error:', error);
    } finally {
      generateBtn.disabled = false;
      generateBtn.textContent = "Generate Token";
    }
  });

  // Optional: close modal by clicking outside
  window.addEventListener("click", (e) => {
    if (e.target === tokenModal) tokenModal.style.display = "none";
  });
});



//start
//arko folder ko js sangai html sanga rakhda chai chalyo but seperate file haru ma chalena 

// FOR SETTINGS MODAL
const settingsLink = document.getElementById('settingsLink');
const settingsModal = document.getElementById('modalSettings');
const closeSettingsBtn = document.querySelector('.closeSettingsBtn');

settingsLink.addEventListener('click', e => {
  e.preventDefault();
  settingsModal.style.display = 'block';
});

closeSettingsBtn.addEventListener('click', () => {
  settingsModal.style.display = 'none';
});

// FOR PROFILE MODAL
const profileBtn = document.getElementById('profileBtn');
const profileModal = document.getElementById('modalProfile');
const closeProfileBtn = document.querySelector('.closeProfileBtn');

profileBtn.addEventListener('click', e => {
  e.preventDefault();
  profileModal.style.display = 'block';
});

closeProfileBtn.addEventListener('click', () => {
  profileModal.style.display = 'none';
});

// CLOSE MODALS ON OUTSIDE CLICK
window.addEventListener('click', event => {
  if (event.target === settingsModal) {
    settingsModal.style.display = 'none';
  }
  if (event.target === profileModal) {
    profileModal.style.display = 'none';
  }
});

// FOR NOTE MODAL
const noteModal = document.getElementById('noteModal');
const closeNoteBtn = document.querySelector('.closeNoteBtn');
const newNoteTrigger = document.querySelector('.add-note-btn'); // or any trigger

newNoteTrigger.addEventListener('click', () => {
  noteModal.style.display = 'block';
});

closeNoteBtn.addEventListener('click', () => {
  noteModal.style.display = 'none';
});

window.addEventListener('click', event => {
  if (event.target === noteModal) {
    noteModal.style.display = 'none';
  }
});

//for token
const tokenModal = document.getElementById("modalToken");
const generateBtn = document.getElementById("generateExtensionTokenBtn");
const copyBtn = document.getElementById("copyTokenBtn");
const tokenDisplay = document.getElementById("tokenDisplay");
const closeTokenBtn = document.querySelector(".closeTokenBtn");
const triggerTokenBtn = document.querySelector(".add-token-btn");

// Show modal when button is clicked
triggerTokenBtn.addEventListener("click", () => {
  tokenModal.style.display = "block";
});

// Close modal
closeTokenBtn.addEventListener("click", () => {
  tokenModal.style.display = "none";
});

// Copy token
copyBtn.addEventListener("click", () => {
  navigator.clipboard.writeText(tokenDisplay.textContent).then(() => {
    copyBtn.textContent = "Copied!";
    setTimeout(() => (copyBtn.textContent = "Copy to Clipboard"), 1500);
  });
});

// Optional: click outside to close
window.addEventListener("click", (e) => {
  if (e.target === tokenModal) tokenModal.style.display = "none";
});
//end
</script>
</body>
</html>


      