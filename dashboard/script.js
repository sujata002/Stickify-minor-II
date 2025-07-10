// document.addEventListener('DOMContentLoaded', function() {
//   // Get the "Add Note" button and the notes grid container for note management
//   const addNoteBtn = document.querySelector('.add-note-btn');
//   const notesGrid = document.querySelector('.notes-grid');
//   const searchInput = document.querySelector('.search input');

//   // Save all notes to localStorage so they persist after reload
//   function saveNotes() {
//     // Gather all note data from the DOM and store as an array of objects
//     const notes = Array.from(document.querySelectorAll('.note-card')).map(card => ({
//       date: card.querySelector('.note-date').innerText,
//       title: card.querySelector('.note-title').innerText,
//       content: card.querySelector('.note-content').innerText,
//       bookmarked: card.classList.contains('bookmarked'),
//     }));
//     // Save the notes array as a JSON string in localStorage
//     localStorage.setItem('stickifyNotes', JSON.stringify(notes));
//   }

//   // Load notes from localStorage and render them in the grid
//   function loadNotes() {
//     // Retrieve notes from localStorage or use an empty array if none exist
//     const saved = JSON.parse(localStorage.getItem('stickifyNotes')) || [];
//     notesGrid.innerHTML = ''; // Clear current notes
//     saved.forEach(note => {
//       // For each saved note, create a note card and add it to the grid
//       const noteCard = document.createElement('div');
//       noteCard.className = 'note-card' + (note.bookmarked ? ' bookmarked' : '');
//       noteCard.innerHTML = `
//         <div class="note-header">
//           <span class="note-date">${note.date}</span>
//           <div class="note-actions">
//             <button class="bookmark-btn" title="Bookmark"><i class="${note.bookmarked ? 'fa-solid' : 'fa-regular'} fa-bookmark"></i></button>
//             <button class="edit-btn" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
//             <button class="delete-btn" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
//           </div>
//         </div>
//         <h3 class="note-title" contenteditable="false">${note.title}</h3>
//         <div class="note-content" contenteditable="false">${note.content}</div>
//       `;
//       notesGrid.appendChild(noteCard);
//     });
//   }

//   // Initial load of notes when the page loads
//   loadNotes();

//   // Handle adding a new note when the button is clicked
//   addNoteBtn.addEventListener('click', function() {
//     // Get today's date in a readable format for the note
//     const today = new Date();
//     const dateString = today.toLocaleDateString('en-GB', {
//       day: 'numeric',
//       month: 'long',
//       year: 'numeric'
//     });

//     // Create a new note card element with default content
//     const noteCard = document.createElement('div');
//     noteCard.className = 'note-card';
//     noteCard.innerHTML = `
//       <div class="note-header">
//         <span class="note-date">${dateString}</span>
//         <div class="note-actions">
//           <button class="bookmark-btn" title="Bookmark"><i class="fa-regular fa-bookmark"></i></button>
//           <button class="edit-btn" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
//           <button class="delete-btn" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
//         </div>
//       </div>
//       <h3 class="note-title" contenteditable="false">Note Title</h3>
//       <div class="note-content" contenteditable="false">Write your note here...</div>
//     `;
//     // Add the new note card to the top of the notes grid
//     notesGrid.prepend(noteCard);
//     saveNotes(); // Save the new note to localStorage
//   });

//   // Handle note actions (delete, bookmark, edit) using event delegation
//   notesGrid.addEventListener('click', function(e) {
//     const target = e.target;
//     // Find the closest note card for the clicked element
//     const noteCard = target.closest('.note-card');
//     if (!noteCard) return;

//     // DELETE: Remove the note card when the delete button is clicked
//     if (target.closest('.delete-btn')) {
//       noteCard.remove(); // Remove the note card from the DOM
//       saveNotes(); // Update localStorage after deletion
//     }

//     // BOOKMARK: Toggle bookmark icon and highlight the note card
//     if (target.closest('.bookmark-btn')) {
//       const icon = noteCard.querySelector('.bookmark-btn i');
//       // Toggle between regular and solid bookmark icon
//       icon.classList.toggle('fa-regular');
//       icon.classList.toggle('fa-solid');
//       // Toggle the bookmarked class for styling and persistence
//       noteCard.classList.toggle('bookmarked');
//       saveNotes(); // Update localStorage after bookmarking
//     }

//     // EDIT: Toggle edit mode for the note title and content
//     if (target.closest('.edit-btn')) {
//       const title = noteCard.querySelector('.note-title');
//       const content = noteCard.querySelector('.note-content');
//       const isEditable = title.isContentEditable;
//       // Toggle contenteditable attribute for inline editing
//       title.contentEditable = !isEditable;
//       content.contentEditable = !isEditable;
//       const icon = noteCard.querySelector('.edit-btn i');
//       // Change the icon to a floppy disk when editing, and back to pen when done
//       icon.classList.toggle('fa-pen-to-square');
//       icon.classList.toggle('fa-floppy-disk');
//       if (!isEditable) {
//         // Focus the title for immediate editing
//         title.focus();
//       } else {
//         // When editing is done, blur and show a green flash to indicate save
//         title.blur();
//         content.blur();
//         // Add a temporary class for a green border flash
//         noteCard.classList.add('saved');
//         setTimeout(() => noteCard.classList.remove('saved'), 1000);
//         saveNotes(); // Save changes to localStorage
//       }
//     }
//   });

//   // Search functionality: filter notes as the user types in the search bar
//   if (searchInput) {
//     searchInput.addEventListener('input', () => {
//       const query = searchInput.value.toLowerCase();
//       // Loop through all note cards and show/hide based on search query
//       document.querySelectorAll('.note-card').forEach(card => {
//         const title = card.querySelector('.note-title').innerText.toLowerCase();
//         const content = card.querySelector('.note-content').innerText.toLowerCase();
//         const visible = title.includes(query) || content.includes(query);
//         card.style.display = visible ? 'block' : 'none';
//       });
//     });
//   }

//   // // Profile toggle logic: show profile section and hide notes when profile icon is clicked
//   // const profileBtn = document.getElementById('profileBtn');
//   // const profileSection = document.getElementById('profileSection');

//   // if (profileBtn && profileSection && notesGrid) {
//   //   profileBtn.addEventListener('click', () => {
//   //     // Hide notes grid and show profile section
//   //     notesGrid.style.display = 'none';
//   //     profileSection.style.display = 'flex';
//   //   });
//   // }


//   // // Save profile changes (name, email, location) to localStorage
//   // const saveProfileBtn = document.getElementById('saveProfileBtn');
//   // if (saveProfileBtn) {
//   //   saveProfileBtn.addEventListener('click', () => {
//   //     // Gather profile info from editable fields
//   //     const name = document.querySelector('.profile-name').innerText;
//   //     const email = document.querySelector('.profile-email').innerText;
//   //     const location = document.querySelector('.profile-location').innerText;
//   //     // Save profile info to localStorage
//   //     localStorage.setItem('profileData', JSON.stringify({ name, email, location, avatar }));
//   //     // Give user feedback that changes are saved
//   //     saveProfileBtn.innerText = "Saved!";
//   //     setTimeout(() => saveProfileBtn.innerText = "Save Changes", 1200);
//   //   });
//   // }
  
//   // // Cancel profile editing and revert to previous state
//   // const cancelProfileBtn = document.getElementById('cancelProfileBtn');
//   // if (cancelProfileBtn) {
//   //   cancelProfileBtn.addEventListener('click', () => {
     
//   //     // Hide profile section and show notes grid again
//   //     profileSection.style.display = 'none';
//   //     notesGrid.style.display = 'grid';
     
//   //     // Reset save button text
//   //     saveProfileBtn.innerText = "Save Changes";
//   //   });
    
    
//   //   // Load profile data if exists and populate fields
//   //   const data = JSON.parse(localStorage.getItem('profileData') || '{}');
//   //   if (data.name) document.querySelector('.profile-name').innerText = data.name;
//   //   if (data.email) document.querySelector('.profile-email').innerText = data.email;
//   //   if (data.location) document.querySelector('.profile-location').innerText = data.location;
//   //   if (data.avatar) document.getElementById('profileAvatar').innerHTML = data.avatar;
//   // }

// });