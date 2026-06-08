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
            if (sidebar && sidebar.classList.contains('open')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
    }

    if (backdrop) {
        backdrop.addEventListener('click', closeSidebar);
    }

    document.querySelectorAll('.admin-nav-toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var group = btn.closest('.admin-nav-group');
            if (!group) return;
            var isOpen = group.classList.toggle('open');
            btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
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

    document.querySelectorAll('[data-adm-tab]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var target = btn.getAttribute('data-adm-tab');
            document.querySelectorAll('[data-adm-tab]').forEach(function (b) {
                b.classList.toggle('active', b === btn);
            });
            document.querySelectorAll('[data-adm-panel]').forEach(function (panel) {
                panel.classList.toggle('active', panel.getAttribute('data-adm-panel') === target);
            });
        });
    });
});
