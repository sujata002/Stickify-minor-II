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

    //for crud operation

    function fetchNotes() {
    fetch('/notes')
        .then(response => response.json())
        .then(data => {
            // Render notes to your notes grid
            renderNotes(data);
        })
        .catch(error => console.error('Error fetching notes:', error));
}
//for creating notes
function createNote(noteText, url = '') {
    fetch('/notes', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ note_text: noteText, url: url })
    })
    .then(response => response.json())
    .then(note => {
        // Add note to the UI
        addNoteToUI(note);
    })
    .catch(error => console.error('Error creating note:', error));
}
//for updating notes
function updateNote(noteId, noteText, url = '') {
    fetch(`/notes/${noteId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ note_text: noteText, url: url })
    })
    .then(response => response.json())
    .then(updatedNote => {
        // Update note in the UI
        updateNoteInUI(updatedNote);
    })
    .catch(error => console.error('Error updating note:', error));
}

//for deletion 
function deleteNote(noteId) {
    fetch(`/notes/${noteId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(result => {
        // Remove note from UI
        removeNoteFromUI(noteId);
    })
    .catch(error => console.error('Error deleting note:', error));
}


    tokenInput.addEventListener('click', () => {
      navigator.clipboard.writeText(tokenInput.value).then(() => {
        tokenInput.style.backgroundColor = '#d4edda';
        setTimeout(() => {
          tokenInput.style.backgroundColor = '';
        }, 1000);
      });
    });
  }
});
