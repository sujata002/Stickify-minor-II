document.addEventListener("DOMContentLoaded", loadNotes);

function addNote() {
  const noteText = document.getElementById("noteInput").value;
  if (noteText.trim() === "") return;

  const note = {
    id: Date.now(),
    text: noteText
  };

  const notes = getNotes();
  notes.push(note);
  localStorage.setItem("notes", JSON.stringify(notes));
  document.getElementById("noteInput").value = "";
  renderNotes();
}

function deleteNote(id) {
  const notes = getNotes().filter(note => note.id !== id);
  localStorage.setItem("notes", JSON.stringify(notes));
  renderNotes();
}

function getNotes() {
  return JSON.parse(localStorage.getItem("notes") || "[]");
}

function renderNotes() {
  const container = document.getElementById("notesContainer");
  container.innerHTML = "";

  getNotes().forEach(note => {
    const div = document.createElement("div");
    div.className = "note";
    div.innerHTML = `
      ${note.text}
      <button class="delete-btn" onclick="deleteNote(${note.id})">×</button>
    `;
    container.appendChild(div);
  });
}

function loadNotes() {
  renderNotes();
}
