document.addEventListener("DOMContentLoaded", function() {
    // 1. Check if we have a saved tab in memory, otherwise default to 'users'
    const savedTab = localStorage.getItem('activeTab') || 'users';
    openTab(savedTab);

    // 2. Auto-hide messages after 3 seconds
    const messages = document.querySelectorAll('.php_good, .php_bad');
    if (messages.length > 0) {
        setTimeout(() => {
            messages.forEach(msg => {
                msg.style.transition = "opacity 0.5s ease";
                msg.style.opacity = "0";
                setTimeout(() => msg.remove(), 500); // Remove from DOM after fade
            });
        }, 3000);
    }
});

function openTab(tabName) {
    // 1. Get elements
    var usersDiv = document.getElementById('view-users');
    var reportsDiv = document.getElementById('view-reports');
    var btnUsers = document.getElementById('btn-users');
    var btnReports = document.getElementById('btn-reports');

    // 2. Save the selection to browser memory
    localStorage.setItem('activeTab', tabName);

    // 3. Switch logic
    if (tabName === 'users') {
        usersDiv.classList.remove('hidden');
        reportsDiv.classList.add('hidden');
        btnUsers.classList.add('active');
        btnReports.classList.remove('active');
    } else if (tabName === 'reports') {
        usersDiv.classList.add('hidden');
        reportsDiv.classList.remove('hidden');
        btnUsers.classList.remove('active');
        btnReports.classList.add('active');
    }
}