document.addEventListener("DOMContentLoaded", function () {
    const saveButton = document.getElementById("saveBtn");
    const noteArea = document.getElementById("note");
    const tokenInput = document.getElementById("tokenInput");
    const verifyTokenBtn = document.getElementById("verifyToken");
    const noteSection = document.getElementById("note-area");
    const tokenBox = document.querySelector(".token-box");

    // Try loading previously saved token from chrome storage
    chrome.storage.local.get(["userToken"], function (result) {
        if (result.userToken) {
            tokenInput.value = result.userToken;
            validateToken(result.userToken);
        }
    });

    // Verify token button click
    verifyTokenBtn.addEventListener("click", function () {
        const token = tokenInput.value.trim();
        if (!token) {
            showMessage("Please enter a token.", false);
            return;
        }
        validateToken(token);
    });

    // Token validation logic
    function validateToken(token){
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
                    showMessage("Token is valid!", true);
                    chrome.storage.local.set({ userToken: token });
                    tokenBox.style.display = "none";
                    noteSection.style.display = "block";
                } else {
                    showMessage("Token is invalid.", false);
                    noteSection.style.display = "none";
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                showMessage("Error validating token. Please try again.", false);
            });
    }

    // Save note button click
    saveButton.addEventListener("click", function () {
        const noteText = noteArea.value.trim();
        if (!noteText) {
            showMessage("Please enter a note.", false);
            return;
        }

        chrome.storage.local.get(["userToken"], function (result) {
            const token = result.userToken;

            chrome.tabs.query({ active: true, currentWindow: true }, function (tabs) {
                const currentUrl = tabs[0].url;

                fetch("http://127.0.0.1:8000/api/notes", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer " + token,
                    },
                    body: JSON.stringify({ note_text: noteText, url: currentUrl }),
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Failed to save note");
                        }
                        return response.json();
                    })
                    .then((data) => {
                        if (data.valid) {
                            showMessage("Note saved successfully!", true);
                            noteArea.value = "";
                        } else {
                            showMessage("Error saving note.", false);
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        showMessage("Error saving note. Please try again.", false);
                    });
            });
        });
    });

    // Display success or error message
    function showMessage(message, isSuccess = false) {
        let msgDiv = document.getElementById("message");
        if (!msgDiv) {
            msgDiv = document.createElement("div");
            msgDiv.id = "message";
            document.body.appendChild(msgDiv);
        }

        msgDiv.textContent = message;
        msgDiv.className = `message-box ${isSuccess ? "success" : "error"}`;
        msgDiv.style.display = "block";

        setTimeout(() => {
            msgDiv.style.display = "none";
            msgDiv.textContent = "";
        }, 3000);
    }
});