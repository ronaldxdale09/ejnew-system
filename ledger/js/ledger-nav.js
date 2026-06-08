document.addEventListener('DOMContentLoaded', function () {
    var sidebar = document.getElementById('adminSidebar');
    var backdrop = document.getElementById('sidebarBackdrop');
    var menuBtn = document.getElementById('sidebarToggle');

    function openSidebar() {
        if (sidebar) sidebar.classList.add('open');
        if (backdrop) backdrop.classList.add('visible');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        if (sidebar) sidebar.classList.remove('open');
        if (backdrop) backdrop.classList.remove('visible');
        document.body.style.overflow = '';
    }

    if (menuBtn) {
        menuBtn.addEventListener('click', function () {
            if (sidebar && sidebar.classList.contains('open')) closeSidebar();
            else openSidebar();
        });
    }

    if (backdrop) backdrop.addEventListener('click', closeSidebar);

    document.querySelectorAll('.admin-nav-toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var group = btn.closest('.admin-nav-group');
            if (!group) return;
            var willOpen = !group.classList.contains('open');
            document.querySelectorAll('.admin-sidebar__nav > .admin-nav-group > .admin-nav-group.open').forEach(function (other) {
                if (other !== group) {
                    other.classList.remove('open');
                    var otherBtn = other.querySelector(':scope > .admin-nav-toggle');
                    if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
                }
            });
            group.classList.toggle('open', willOpen);
            btn.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
            btn.blur();
        });
    });

    document.querySelectorAll('.admin-sidebar__nav a.admin-nav-link:not(.admin-nav-toggle)').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 960) closeSidebar();
        });
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 960) closeSidebar();
    });
});
