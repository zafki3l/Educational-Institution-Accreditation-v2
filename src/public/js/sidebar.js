const sidebarItems = document.querySelectorAll('.sidebar-item');
const ACTIVE_KEY = 'activeSidebar';

sidebarItems.forEach(item => {
    item.addEventListener('click', () => {
        sidebarItems.forEach(i => i.classList.remove('active'));

        item.classList.add('active');

        localStorage.setItem(ACTIVE_KEY, item.getAttribute('href'));
    });
});

const activeHref = localStorage.getItem(ACTIVE_KEY);
if (activeHref) {
    sidebarItems.forEach(item => {
        if (item.getAttribute('href') === activeHref) {
            item.classList.add('active');
        }
    });
}

const GROUP_OPEN_KEY = 'sidebarGroupOpen';
const toggle = document.querySelector('.sidebar-toggle');
const group = document.querySelector('.sidebar-group');

toggle.addEventListener('click', () => {
    group.classList.toggle('open');

    const isOpen = group.classList.contains('open');
    localStorage.setItem(GROUP_OPEN_KEY, isOpen ? '1' : '0');
});

const isGroupOpen = localStorage.getItem(GROUP_OPEN_KEY);

if (isGroupOpen === '1') {
    group.classList.add('open');
}