
setTimeout(() => {
    const loginMsg = document.getElementById("good");
    if (loginMsg) {
        loginMsg.style.display = 'none';
    }
}, 3000);

setTimeout(() => {
    const loginMsg = document.getElementById("bad");
    if (loginMsg) {
        loginMsg.style.display = 'none';
    }
}, 3000);


function showPreview(url) {
    const container = document.getElementById('previewContainer');
    const img = document.getElementById('imagePreview');
    const errorText = document.getElementById('errorText');

    url = url.trim();

    if (url === '') {
        container.classList.add('hidden');
        img.src = '';
    } else {
        container.classList.remove('hidden');
        img.style.display = 'block';
        errorText.classList.add('hidden');
        img.src = url;
    }
}

function imageLoaded() {
    document.getElementById('imagePreview').style.display = 'block';
    document.getElementById('errorText').classList.add('hidden');
}

function imageFailed() {
    document.getElementById('imagePreview').style.display = 'none';
    document.getElementById('errorText').classList.remove('hidden');
}

window.addEventListener('DOMContentLoaded', () => {
    const inputField = document.getElementById('imageInput');
    if (inputField && inputField.value) {
        showPreview(inputField.value);
    }
});