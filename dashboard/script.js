document.addEventListener('DOMContentLoaded', function() {
  // Get the "Add Note" button and the notes grid container
  const addNoteBtn = document.querySelector('.add-note-btn');
  const notesGrid = document.querySelector('.notes-grid');

  // Handle adding a new note when the button is clicked
  addNoteBtn.addEventListener('click', function() {
    // Get today's date in a readable format
    const today = new Date();
    const dateString = today.toLocaleDateString('en-GB', {
      day: 'numeric',
      month: 'long',
      year: 'numeric'
    });

    // Create a new note card element with default content
    const noteCard = document.createElement('div');
    noteCard.className = 'note-card';
    noteCard.innerHTML = `
      <div class="note-header">
        <span class="note-date">${dateString}</span>
        <div class="note-actions">
          <button class="bookmark-btn" title="Bookmark"><i class="fa-regular fa-bookmark"></i></button>
          <button class="edit-btn" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
          <button class="delete-btn" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
        </div>
      </div>
      <h3 class="note-title" contenteditable="false">Note Title</h3>
      <div class="note-content" contenteditable="false">Write your note here...</div>
    `;
    // Add the new note card to the top of the notes grid
    notesGrid.prepend(noteCard);
  });

  // Handle note actions (delete, bookmark, edit) using event delegation
  notesGrid.addEventListener('click', function(e) {
    const target = e.target;
    // Find the closest note card for the clicked element
    const noteCard = target.closest('.note-card');
    if (!noteCard) return;

    // DELETE: Remove the note card when the delete button is clicked
    if (target.closest('.delete-btn')) {
      noteCard.remove();
    }

    // BOOKMARK: Toggle bookmark icon and highlight the note card
    if (target.closest('.bookmark-btn')) {
      const icon = noteCard.querySelector('.bookmark-btn i');
      icon.classList.toggle('fa-regular');
      icon.classList.toggle('fa-solid');
      // Toggle a class for styling bookmarked notes
      noteCard.classList.toggle('bookmarked');
    }

    // EDIT: Toggle edit mode for the note title and content
    if (target.closest('.edit-btn')) {
      const title = noteCard.querySelector('.note-title');
      const content = noteCard.querySelector('.note-content');
      const isEditable = title.isContentEditable;
      // Toggle contenteditable attribute
      title.contentEditable = !isEditable;
      content.contentEditable = !isEditable;
      // Focus the title for immediate editing
      title.focus();
      // Change the edit icon to a save icon and back
      const icon = noteCard.querySelector('.edit-btn i');
      icon.classList.toggle('fa-pen-to-square');
      icon.classList.toggle('fa-floppy-disk');
    }
  });
});