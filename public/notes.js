const from = document.getElementById("noteForm");
const goodMessage = document.getElementById("good");
const badMessage = document.getElementById("bad");
// ----------------------------------------------------
from.addEventListener("submit", (e) => {
    validUserData(e);
})

// ---------------------------------------------------
function Message(element, text) {
    element.textContent = text;
    element.style.display = "block";
    setTimeout(() => element.style.display = "none", 3000);
}

function validUserData(e) {
    const noteTitle = document.getElementById("noteTitle").value.trim();
    const noteContent = document.getElementById("notecontent").value.trim();

    if (!noteTitle || !noteContent) {
        e.preventDefault();
        return Message(badMessage, "Please fill in all experience fields");
    }

    if (themeTitle.length < 3) {
        e.preventDefault();
        return Message(badMessage, "Title must contain at least 3 characters");
    }
    else if (themeTitle.length > 20) {
        e.preventDefault();
        return Message(badMessage, "The title cannot exceed 15 characters");
    }
}

setTimeout(()=>{
    const noteMsg = document.getElementById("flash_message");
    if(noteMsg)
    {
        noteMsg.style.display = 'none';
    }
},3000);