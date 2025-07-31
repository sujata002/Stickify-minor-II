document.addEventListener("DOMContentLoaded", function () {
    const saveButton = document.getElementById("saveBtn");
    const noteArea = document.getElementById("note");
    const noteTitle = document.getElementById("noteTitle");
    const tokenInput = document.getElementById("tokenInput");
    const verifyTokenBtn = document.getElementById("verifyToken");
    const noteSection = document.getElementById("note-area");
    const tokenBox = document.querySelector(".token-box");

    noteSection.style.display = "none";

    // Secure token check on load
    chrome.storage.local.get(["userToken", "userEmail"], function (result) {
        if (result.userToken && result.userEmail) {
            fetch("http://127.0.0.1:8000/api/verify-token", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ token: result.userToken }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.valid && data.user_email === result.userEmail) {
                        tokenInput.value = result.userToken;
                        tokenBox.style.display = "none";
                        noteSection.style.display = "flex";
                    } else {
                        chrome.storage.local.remove(["userToken", "userEmail"]);
                        tokenBox.style.display = "block";
                        noteSection.style.display = "none";
                    }
                })
                .catch(() => {
                    chrome.storage.local.remove(["userToken", "userEmail"]);
                    tokenBox.style.display = "block";
                    noteSection.style.display = "none";
                });
        } else {
            tokenBox.style.display = "block";
            noteSection.style.display = "none";
        }
    });

    verifyTokenBtn.addEventListener("click", function () {
        const token = tokenInput.value.trim();

        if (!token) {
            showMessage("Please enter a token.", false, "tokenMessage");
            return;
        }

        if (token.length !== 8) {
            showMessage("Token must be exactly 8 characters.", false, "tokenMessage");
            return;
        }

        validateToken(token);
    });

    function validateToken(token) {
        fetch("http://127.0.0.1:8000/api/verify-token", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ token: token }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.valid) {
                    showMessage("Token is valid!", true, "tokenMessage");

                    chrome.storage.local.set({
                        userToken: token,
                        userEmail: data.user_email
                    });

                    tokenBox.style.display = "none";
                    noteSection.style.display = "flex";
                } else {
                    showMessage(data.message || "Invalid token.", false, "tokenMessage");
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                showMessage("Error validating token. Please try again.", false, "tokenMessage");
            });
    }

    saveButton.addEventListener("click", function () {
        const title = noteTitle.value.trim();
        const noteText = noteArea.value.trim();

        if (!title) {
            showMessage("Please enter a title.", false, "noteMessage");
            return;
        }

        if (!noteText) {
            showMessage("Please enter your note.", false, "noteMessage");
            return;
        }

        chrome.storage.local.get(["userToken"], function (result) {
            const token = result.userToken;

            chrome.tabs.query({ active: true, currentWindow: true }, function (tabs) {
                if (!tabs || tabs.length === 0 || !tabs[0].url) {
                    showMessage("Unable to get tab URL. Please try again.", false, "noteMessage");
                    return;
                }

                const currentUrl = tabs[0].url;

                fetch("http://127.0.0.1:8000/api/notes", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer " + token,
                    },
                    body: JSON.stringify({
                        title: title,
                        note_text: noteText,
                        url: currentUrl
                    }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.valid) {
                            showMessage("Note saved successfully!", true, "noteMessage");
                            noteArea.value = "";
                            noteTitle.value = "";
                        } else {
                            showMessage("Error saving note.", false, "noteMessage");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        showMessage("Error saving note. Please try again.", false, "noteMessage");
                    });
            });
        });
    });

    function showMessage(message, isSuccess = false, elementId) {
        const msgDiv = document.getElementById(elementId);

        msgDiv.textContent = message;
        msgDiv.className = `message-box ${isSuccess ? "success" : "error"}`;
        msgDiv.style.display = "block";

        clearTimeout(msgDiv._timeout);
        msgDiv._timeout = setTimeout(() => {
            msgDiv.style.display = "none";
            msgDiv.textContent = "";
        }, 3000);
    }
});
