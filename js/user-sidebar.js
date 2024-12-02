document.addEventListener('DOMContentLoaded', () => {
    const userModal = document.getElementById('userModal');
    const userSidebar = document.getElementById('userSidebar');
    const userSidebarOpen = document.getElementById('userSidebarOpen');
    const userSidebarClose = document.getElementById('userSidebarClose');

    userSidebarOpen.addEventListener('click', () => {
        userSidebarOpen.style.display = 'none';
        userModal.style.display = 'block';
        setTimeout(() => {
            userSidebar.style.right = '0%';
        }, 10);
    });

    userSidebarClose.addEventListener('click', () => {
        userSidebarOpen.style.display = 'block';
        userSidebar.style.right = '-32%';
        setTimeout(() => {
            userModal.style.display = 'none';
        }, 500);
    });

    window.addEventListener('click', (event) => {
        if (event.target === userModal) {
            userSidebarClose.click();
        }
    });
});
