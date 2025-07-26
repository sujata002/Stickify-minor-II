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
const newNoteTrigger = document.querySelector('.add-note-btn');

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

// FOR TOKEN MODAL
const tokenModal = document.getElementById("modalToken");
const generateBtn = document.getElementById("generateExtensionTokenBtn");
const copyBtn = document.getElementById("copyTokenBtn");
const tokenDisplay = document.getElementById("tokenDisplay");
const closeTokenBtn = document.querySelector(".closeTokenBtn");
const triggerTokenBtn = document.querySelector(".add-token-btn");

// Only attach listener if the trigger exists
if (triggerTokenBtn) {
  triggerTokenBtn.addEventListener("click", () => {
    tokenModal.style.display = "block";
  });
}

// Close modal
if (closeTokenBtn) {
  closeTokenBtn.addEventListener("click", () => {
    tokenModal.style.display = "none";
  });
}

// Copy token
if (copyBtn) {
  copyBtn.addEventListener("click", () => {
    navigator.clipboard.writeText(tokenDisplay.textContent).then(() => {
      copyBtn.textContent = "Copied!";
      setTimeout(() => (copyBtn.textContent = "Copy to Clipboard"), 1500);
    });
  });
}

// Optional: click outside to close token modal
window.addEventListener("click", (e) => {
  if (e.target === tokenModal) tokenModal.style.display = "none";
});
