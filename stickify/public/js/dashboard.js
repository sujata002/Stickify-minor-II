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
  // for crud part
  // Notes Edit button
document.querySelectorAll('.edit-note-btn').forEach(editBtn => {
  editBtn.addEventListener('click', () => {
    const noteCard = editBtn.closest('.note-card');
    if (!noteCard) return;

    const title = noteCard.querySelector('.note-title');
    const content = noteCard.querySelector('.note-content');
    const saveBtn = noteCard.querySelector('.save-note-btn');

    title.contentEditable = 'true';
    content.contentEditable = 'true';

    editBtn.style.display = 'none';
    saveBtn.style.display = 'inline-block';
  });
});

// Notes Save button
document.querySelectorAll('.save-note-btn').forEach(saveBtn => {
  saveBtn.addEventListener('click', () => {
    const noteCard = saveBtn.closest('.note-card');
    if (!noteCard) return;

    const noteId = noteCard.dataset.noteId;
    const title = noteCard.querySelector('.note-title').innerText.trim();
    const content = noteCard.querySelector('.note-content').innerText.trim();

    title.contentEditable = 'false';
    content.contentEditable = 'false';

    saveBtn.style.display = 'none';
    noteCard.querySelector('.edit-note-btn').style.display = 'inline-block';

    fetch(`/notes/${noteId}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Accept': 'application/json',
      },
      body: JSON.stringify({
        note_text: title,
        url: content,
      }),
    })
      .then(res => {
        if (!res.ok) throw new Error('Update failed');
        return res.json();
      })
      .then(() => {
        alert('Note updated successfully!');
      })
      .catch(() => {
        alert('Failed to update note.');
      });
  });
});

// Notes Delete button
document.querySelectorAll('.delete-note-btn').forEach(deleteBtn => {
  deleteBtn.addEventListener('click', () => {
    if (!confirm('Are you sure you want to delete this note?')) return;

    const noteCard = deleteBtn.closest('.note-card');
    const noteId = noteCard.dataset.noteId;

    fetch(`/notes/${noteId}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Accept': 'application/json',
      },
    })
      .then(res => {
        if (!res.ok) throw new Error('Delete failed');
        return res.json();
      })
      .then(data => {
        alert(data.message || 'Note deleted');
        noteCard.remove();
      })
      .catch(() => alert('Failed to delete note.'));
  });
});
});
