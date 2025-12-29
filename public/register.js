const from = document.getElementById("from");
const goodMessage = document.getElementById("good");
const badMessage = document.getElementById("bad");
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!.])[A-Za-z\d@#$!.]{6,}$/;
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
    const userName = document.getElementById("userName").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    if (!userName || !email || !password || !confirmPassword) {
        e.preventDefault();
        return Message(badMessage, "Please fill in all experience fields");
    }

    if(userName.length < 3)
    {
        e.preventDefault();
        return Message(badMessage , "Username must contain at least 3 characters")
    }

    if (!emailRegex.test(email)) {
        e.preventDefault();
        return Message(badMessage, "Invalid email address");
    }

    if (!passwordRegex.test(password)) {
        e.preventDefault();
        return Message(badMessage, "Invalid password");
    }


    if (password != confirmPassword) {
        e.preventDefault();
        return Message(badMessage, "Passwords must match");
    }
}