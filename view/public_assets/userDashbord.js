
function toggleDropdown(menuId) {
    const allMenus = document.querySelectorAll('[id^="menu-"]');
    allMenus.forEach(menu => {
        if (menu.id !== menuId) {
            menu.classList.add('hidden');
        }
    });
    const menu = document.getElementById(menuId);
    menu.classList.toggle('hidden');
}

window.onclick = function (event) {
    if (!event.target.closest('.theme')) {
        const allMenus = document.querySelectorAll('[id^="menu-"]');
        allMenus.forEach(menu => {
            menu.classList.add('hidden');
        });
    }
}


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




