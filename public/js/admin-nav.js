(function() {
    var wrapper = document.getElementById('adminWrapper');
    var btn = document.getElementById('adminMenuBtn');
    var overlay = document.getElementById('adminSidebarOverlay');
    var sidebar = document.getElementById('adminSidebar');
    if (!wrapper || !btn || !overlay || !sidebar) return;
    function open() {
        wrapper.classList.add('admin-nav-open');
        btn.setAttribute('aria-expanded', 'true');
        overlay.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }
    function close() {
        wrapper.classList.remove('admin-nav-open');
        btn.setAttribute('aria-expanded', 'false');
        overlay.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }
    function toggle() {
        if (wrapper.classList.contains('admin-nav-open')) close(); else open();
    }
    btn.addEventListener('click', toggle);
    overlay.addEventListener('click', close);
    sidebar.querySelectorAll('a').forEach(function(a) {
        a.addEventListener('click', close);
    });
    window.addEventListener('resize', function() {
        if (window.innerWidth > 992) close();
    });
})();
