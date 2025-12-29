const loginForm = document.getElementById("loginForm");
const goodMessage = document.getElementById("good");
const badMessage = document.getElementById("bad");
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!.])[A-Za-z\d@#$!.]{6,}$/;
// --------------------------------------------
loginForm.addEventListener("submit", (e) => {
    validUserData(e);
})

// --------------------------------------------
function Message(element, text) {
    element.textContent = text;
    element.style.display = "block";
    setTimeout(() => element.style.display = "none", 3000);
}

function validUserData(e) {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (!email || !password) {
        e.preventDefault();
        return Message(badMessage, "Please fill in all experience fields");
    }

    if (!emailRegex.test(email)) {
        e.preventDefault();
        return Message(badMessage, "Invalid email address");
    }

    if (!passwordRegex.test(password)) {
        e.preventDefault();
        return Message(badMessage, "Invalid password");
    }
}

setTimeout(()=>{
    const loginMsg = document.getElementById("flash_message");
    if(loginMsg)
    {
        loginMsg.style.display = 'none';
    }
},2000);
