document.addEventListener('DOMContentLoaded', () => {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const notesList = document.getElementById('notesList');
  const createNoteBtn = document.getElementById('createNoteBtn');
  const noNotesMsg = document.getElementById('noNotesMessage');

  const showNoNotesMessage = () => {
    noNotesMsg.style.display = notesList.children.length === 0 ? 'block' : 'none';
  };

  const hideNoNotesMessage = () => {
    noNotesMsg.style.display = 'none';
  };

  const createNoteForm = () => {
    const li = document.createElement('li');
    li.classList.add('note-form');

    li.innerHTML = `
      <input type="text" class="note-title" placeholder="Note Title">
      <textarea class="note-text" placeholder="Write your note..."></textarea>
      <div class="note-form-actions">
        <button class="save-note">Save</button>
        <button class="cancel-note">Cancel</button>
      </div>
    `;

    notesList.prepend(li);
    hideNoNotesMessage();

    li.querySelector('.cancel-note').addEventListener('click', () => {
      li.remove();
      showNoNotesMessage();
    });

    li.querySelector('.save-note').addEventListener('click', () => saveNote(li));
  };

  const saveNote = (li) => {
    const title = li.querySelector('.note-title').value.trim();
    const text = li.querySelector('.note-text').value.trim();

    if (!title || !text) return alert('Both fields are required.');

    fetch('/notes', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({ title, note_text: text })
    })
      .then(res => res.json())
      .then(note => {
        li.remove();
        renderNote(note);
      })
      .catch(err => console.error(err));
  };

  const renderNote = (note) => {
    const li = document.createElement('li');
    li.classList.add('note-item');
    li.dataset.id = note.id;

    li.innerHTML = `
      <h3 class="note-title-display">${note.note_title}</h3>
      <p class="note-text-display">${note.note_text}</p>
      <div class="note-form-actions">
        <button class="edit-note">Edit</button>
        <button class="delete-note">Delete</button>
      </div>
    `;

    li.querySelector('.edit-note').addEventListener('click', () => editNote(li));
    li.querySelector('.delete-note').addEventListener('click', () => deleteNote(li));

    notesList.appendChild(li);
    hideNoNotesMessage();
  };

  const editNote = (li) => {
    const id = li.dataset.id;
    const currentTitle = li.querySelector('.note-title-display').innerText;
    const currentText = li.querySelector('.note-text-display').innerText;

    li.innerHTML = `
      <input type="text" class="note-title" value="${currentTitle}">
      <textarea class="note-text">${currentText}</textarea>
      <div class="note-form-actions">
        <button class="update-note">Update</button>
        <button class="delete-note">Delete</button>
        <button class="cancel-edit">Cancel</button>
      </div>
    `;

    li.querySelector('.update-note').addEventListener('click', () => updateNote(li, id));
    li.querySelector('.delete-note').addEventListener('click', () => deleteNote(li));
    li.querySelector('.cancel-edit').addEventListener('click', () => fetchNote(id, li));
  };

  const updateNote = (li, id) => {
    const newTitle = li.querySelector('.note-title').value.trim();
    const newText = li.querySelector('.note-text').value.trim();

    if (!newTitle || !newText) return alert('Both fields are required.');

    fetch(`/notes/${id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({ title: newTitle, note_text: newText })
    })
      .then(() => fetchNote(id, li))
      .catch(err => console.error(err));
  };

  const fetchNote = (id, li) => {
    fetch(`/notes/${id}`)
      .then(res => res.json())
      .then(note => {
        li.innerHTML = `
          <h3 class="note-title-display">${note.note_title}</h3>
          <p class="note-text-display">${note.note_text}</p>
          <div class="note-form-actions">
            <button class="edit-note">Edit</button>
            <button class="delete-note">Delete</button>
          </div>
        `;

        li.querySelector('.edit-note').addEventListener('click', () => editNote(li));
        li.querySelector('.delete-note').addEventListener('click', () => deleteNote(li));
      });
  };

  const deleteNote = (li) => {
    const id = li.dataset.id;

    fetch(`/notes/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      }
    })
      .then(() => {
        li.remove();
        showNoNotesMessage();
      })
      .catch(err => console.error(err));
  };

  const fetchAllNotes = () => {
    fetch('/notes')
      .then(res => res.json())
      .then(data => {
        if (Array.isArray(data) && data.length > 0) {
          data.forEach(renderNote);
          hideNoNotesMessage();
        } else {
          showNoNotesMessage();
        }
      });
  };

  createNoteBtn.addEventListener('click', createNoteForm);
  fetchAllNotes();
});
