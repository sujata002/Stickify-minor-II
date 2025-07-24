document.addEventListener('DOMContentLoaded', () => {
  // Note Modal
  const addNoteBtn = document.querySelector('.add-note-btn');
  const noteModal = document.getElementById('noteModal');
  const closeNoteBtn = document.querySelector('.closeNoteBtn');

  addNoteBtn.addEventListener('click', () => {
    noteModal.style.display = 'block';
  });

  closeNoteBtn.addEventListener('click', () => {
    noteModal.style.display = 'none';
  });

  // Token Modal
  const addTokenBtn = document.querySelector('.add-token-btn');
  const tokenModal = document.getElementById('modalToken');
  const closeTokenBtn = document.querySelector('.closeTokenBtn');

  addTokenBtn.addEventListener('click', () => {
    tokenModal.style.display = 'block';
  });

  closeTokenBtn.addEventListener('click', () => {
    tokenModal.style.display = 'none';
  });

  // Close modals if clicking outside content
  window.addEventListener('click', (e) => {
    if (e.target === noteModal) noteModal.style.display = 'none';
    if (e.target === tokenModal) tokenModal.style.display = 'none';
  });

  // Token display and copy button
  const tokenDisplay = document.getElementById('tokenDisplay');
  const copyBtn = document.getElementById('copy-btn');

  if (copyBtn && tokenDisplay) {
    copyBtn.addEventListener('click', () => {
      navigator.clipboard.writeText(tokenDisplay.textContent).then(() => {
        copyBtn.textContent = 'Copied!';
        setTimeout(() => {
          copyBtn.textContent = 'Copy to Clipboard';
        }, 1500);
      });
    });
  }

  // Generate token button inside token modal
  const generateTokenBtn = document.getElementById('generateExtensionTokenBtn');

  generateTokenBtn.addEventListener('click', () => {
    tokenDisplay.textContent = 'Generating token...';

    fetch('/generate-token', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
      body: JSON.stringify({}),
    })
      .then((response) => {
        if (!response.ok) throw new Error('Network response was not OK');
        return response.json();
      })
      .then((data) => {
        if (data.token) {
          tokenDisplay.textContent = data.token;
        } else {
          tokenDisplay.textContent = 'Failed to generate token.';
        }
      })
      .catch(() => {
        tokenDisplay.textContent = 'Failed to generate token.';
      });
  });
});
