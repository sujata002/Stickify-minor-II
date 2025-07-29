document.addEventListener('DOMContentLoaded', () => {
  // ==== Note Modal ====
  const addNoteBtn = document.querySelector('.add-note-btn');
  const noteModal = document.getElementById('noteModal');
  const closeNoteBtn = document.querySelector('.closeNoteBtn');

  addNoteBtn?.addEventListener('click', () => {
    if (noteModal) noteModal.style.display = 'block';
  });

  closeNoteBtn?.addEventListener('click', () => {
    if (noteModal) noteModal.style.display = 'none';
  });
  
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

  // ==== Token Modal ====
  const addTokenBtn = document.querySelector('.add-token-btn');
  const tokenModal = document.getElementById('modalToken');
  const closeTokenBtn = document.querySelector('.closeTokenBtn');

  addTokenBtn?.addEventListener('click', () => {
    if (tokenModal) tokenModal.style.display = 'block';
  });

  closeTokenBtn?.addEventListener('click', () => {
    if (tokenModal) tokenModal.style.display = 'none';
  });

  // ==== Close modals by clicking outside ====
  window.addEventListener('click', (e) => {
    if (e.target === noteModal) noteModal.style.display = 'none';
    if (e.target === tokenModal) tokenModal.style.display = 'none';
  });

  // ==== Token display/copy in modal ====
  const copyBtn = document.getElementById('copy-btn');

  copyBtn?.addEventListener('click', () => {
    const tokenDisplay = document.getElementById('tokenDisplay');
    if (!tokenDisplay) return;

    navigator.clipboard.writeText(tokenDisplay.textContent).then(() => {
      copyBtn.textContent = 'Copied!';
      setTimeout(() => {
        copyBtn.textContent = 'Copy to Clipboard';
      }, 1500);
    });
  });

  // ==== Generate token in modal (FIXED) ====
  const generateTokenBtn = document.getElementById('generateExtensionTokenBtn');

  generateTokenBtn?.addEventListener('click', () => {
    const tokenDisplay = document.getElementById('tokenDisplay'); // FIX: move inside handler
    if (!tokenDisplay) return;

    tokenDisplay.textContent = 'Generating token...';

    fetch('/generate-token', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
      body: JSON.stringify({})
    })
      .then((response) => {
        if (!response.ok) throw new Error('Network error');
        return response.json();
      })
      .then((data) => {
        tokenDisplay.textContent = data.token || 'Token generation failed.';
      })
      .catch(() => {
        tokenDisplay.textContent = 'Token generation failed.';
      });
  });

  // ==== Generate token via top tab (inline) ====
  const generateTokenTab = document.getElementById('generateTokenTab');
  const tokenContainer = document.getElementById('generatedTokenContainer');
  const tokenInput = document.getElementById('generatedTokenValue');

  if (generateTokenTab && tokenInput && tokenContainer) {
    generateTokenTab.addEventListener('click', () => {
      tokenContainer.style.display = 'flex';
      tokenInput.value = 'Generating token...';

      fetch('/generate-token', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({})
      })
        .then((response) => {
          if (!response.ok) throw new Error('Network error');
          return response.json();
        })
        .then((data) => {
          tokenInput.value = data.token || 'Token generation failed.';
        })
        .catch(() => {
          tokenInput.value = 'Token generation failed.';
        });
    });

    tokenInput.addEventListener('click', () => {
      navigator.clipboard.writeText(tokenInput.value).then(() => {
        tokenInput.style.backgroundColor = '#d4edda';
        setTimeout(() => {
          tokenInput.style.backgroundColor = '';
        }, 1000);
      });
    });
  }
  
  // ==== Profile Modal ====
  const profileBtn = document.getElementById('profileBtn');
  const profileModal = document.getElementById('modalProfile');
  const closeProfileBtn = document.querySelector('.closeProfileBtn');

  profileBtn?.addEventListener('click', () => {
    const name = profileBtn.getAttribute('data-name');
    const email = profileBtn.getAttribute('data-email');

    document.getElementById('profileName').value = name || '';
    document.getElementById('profileEmail').value = email || '';
    profileModal.style.display = 'block';
  });

  closeProfileBtn?.addEventListener('click', () => {
    profileModal.style.display = 'none';
  });

  window.addEventListener('click', (e) => {
    if (e.target === profileModal) {
      profileModal.style.display = 'none';
    }
  });
});