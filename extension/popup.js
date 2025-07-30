document.addEventListener("DOMContentLoaded", function () {
    const noteTitleInput = document.getElementById("noteTitle");
    const loginMessage = document.getElementById("loginMessage");
    const noteArea = document.getElementById("note-area");
    const noteTextarea = document.getElementById("note");
    const saveBtn = document.getElementById("saveBtn");
    const saveMessage = document.getElementById("saveMessage");

    // Check if user is logged in using session-based route
    fetch("http://127.0.0.1:8000/extension/check-login", {
        credentials: "include" // important to send browser cookies
    })
        .then(res => {
            if (res.status === 200) {
                return res.json();
            } else {
                throw new Error("Not logged in");
            }
        })
        .then(data => {
            if (data.logged_in) {
                noteArea.style.display = "block";
                loginMessage.style.display = "none";
            } else {
                throw new Error("Not logged in");
            }
        })
        .catch(err => {
            console.error("Login check failed:", err);
            loginMessage.innerText = "Please log in at stickify.com first.";
            noteArea.style.display = "none";
        });

    // Save note button
    saveBtn.addEventListener("click", function () {
        const noteTitle = noteTitleInput.value.trim();
        const noteText = noteTextarea.value.trim();

        if (!noteTitle) {
            saveMessage.className = "error";
            saveMessage.innerText = "Please enter a title.";
            return;
        }

        if (!noteText) {
            saveMessage.className = "error";
            saveMessage.innerText = "Please enter a note.";
            return;
        }


        chrome.tabs.query({ active: true, currentWindow: true }, function (tabs) {
            const currentUrl = tabs[0]?.url || "unknown";

            fetch("http://127.0.0.1:8000/extension/save-note", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                credentials: "include", // needed to use current login session
                body: JSON.stringify({
                    title: noteTitle,
                    note_text: noteText,
                    url: currentUrl
                })
            })
                .then(res => res.json())
                .then(data => {
                    saveMessage.className = "success";
                    saveMessage.innerText = "Note saved to your dashboard!";
                    noteTextarea.value = "";
                })
                .catch(err => {
                    console.error("Error saving note:", err);
                    saveMessage.className = "error";
                    saveMessage.innerText = "Error saving note.";
                });
        });
    });
});
