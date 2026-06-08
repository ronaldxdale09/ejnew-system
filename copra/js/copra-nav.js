document.addEventListener('DOMContentLoaded', function () {
    var sidebar = document.getElementById('adminSidebar');
    var backdrop = document.getElementById('sidebarBackdrop');
    var menuBtn = document.getElementById('sidebarToggle');

    function closeSidebar() {
        if (sidebar) sidebar.classList.remove('open');
        if (backdrop) backdrop.classList.remove('visible');
        document.body.style.overflow = '';
    }

    function openSidebar() {
        if (sidebar) sidebar.classList.add('open');
        if (backdrop) backdrop.classList.add('visible');
        document.body.style.overflow = 'hidden';
    }

    if (menuBtn) {
        menuBtn.addEventListener('click', function () {
            if (sidebar && sidebar.classList.contains('open')) closeSidebar();
            else openSidebar();
        });
    }

    if (backdrop) backdrop.addEventListener('click', closeSidebar);

    document.querySelectorAll('.admin-sidebar__nav a.admin-nav-link').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 960) closeSidebar();
        });
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 960) closeSidebar();
    });
});
