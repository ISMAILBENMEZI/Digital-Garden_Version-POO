

function toggleDropdown(menuId) {
    const allMenus = document.querySelectorAll('[id^="menu-"]');

    allMenus.forEach(menu => {
        const card = menu.closest('.theme');

        if (menu.id === menuId) {
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                card.style.zIndex = "50";
                card.style.position = "relative";
                console.log("Opening menu, z-index set to 50");
            } else {

                menu.classList.add('hidden');
                card.style.zIndex = "0";
                console.log("Closing menu, z-index reset");
            }
        } else {
            menu.classList.add('hidden');
            if (card) {
                card.style.zIndex = "0";
            }
        }
    });
}


window.onclick = function (event) {
    if (!event.target.closest('.theme')) {
        const allMenus = document.querySelectorAll('[id^="menu-"]');
        allMenus.forEach(menu => {
            menu.classList.add('hidden');
            const card = menu.closest('.theme');
            if (card) card.style.zIndex = "0";
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




