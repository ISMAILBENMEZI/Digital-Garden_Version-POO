const from = document.getElementById("themeForm");
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
    const themeTitle = document.getElementById("themeTitle").value.trim();
    const themeColor = document.getElementById("themeColor").value.trim();

    if (!themeTitle || !themeColor) {
        e.preventDefault();
        return Message(badMessage, "Please fill in all experience fields");
    }

    if (themeTitle.length < 3) {
        e.preventDefault();
        return Message(badMessage, "Title must contain at least 3 characters");
    }
    else if (themeTitle.length > 15) {
        e.preventDefault();
        return Message(badMessage, "The title cannot exceed 15 characters");
    }
}

setTimeout(()=>{
    const loginMsg = document.getElementById("flash_message");
    if(loginMsg)
    {
        loginMsg.style.display = 'none';
    }
},3000);