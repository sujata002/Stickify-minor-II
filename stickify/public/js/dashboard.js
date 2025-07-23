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

// FOR NOTE MODAL
const noteModal = document.getElementById('noteModal');
const closeNoteBtn = document.querySelector('.closeNoteBtn');
const newNoteTrigger = document.querySelector('.add-note-btn');

newNoteTrigger.addEventListener('click', () => {
  noteModal.style.display = 'block';
});

closeNoteBtn.addEventListener('click', () => {
  noteModal.style.display = 'none';
});

// FOR TOKEN MODAL
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

// Generate token using fetch API (AJAX)
generateBtn.addEventListener("click", async () => {
  generateBtn.disabled = true;
  generateBtn.textContent = "Generating...";
  try {
    const response = await fetch("/generate-token", {  // make sure this route matches your backend route
      method: "POST",
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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

// Close any modal when clicking outside of it
window.addEventListener("click", (event) => {
  if (event.target === settingsModal) settingsModal.style.display = "none";
  if (event.target === profileModal) profileModal.style.display = "none";
  if (event.target === noteModal) noteModal.style.display = "none";
  if (event.target === tokenModal) tokenModal.style.display = "none";
});
