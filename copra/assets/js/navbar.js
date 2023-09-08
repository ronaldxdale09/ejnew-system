var toggle = true;
const activePage = window.location.pathname;
const navLinks = document.querySelectorAll('nav a').forEach(link => {
    if (link.href.includes(`${activePage}`)) {
        link.classList.add('active');
    }
})




$(document).on('click', '#toggle-nav-btn', function() {
    if (toggle) {
        retractNav();
        toggle = false;
    } else {
        expandNav();
        toggle = true;
    }
});

function expandNav() {
    document.getElementsByClassName('main-content')[0].style.marginLeft = '240px';
    document.getElementsByClassName('main-content')[0].style.width = 'calc(100% - 240px)';
    document.getElementById('navbar').style.width = '240px';
    var nav_texts = document.getElementsByClassName('nav-text');
    Array.from(nav_texts).forEach(element => {
        element.style.display = 'block';
        setTimeout(function() {
            element.style.opacity = '1';
        }, 250);
    });
};

function retractNav() {
    document.getElementsByClassName('main-content')[0].style.marginLeft = '65px';
    document.getElementsByClassName('main-content')[0].style.width = 'calc(100% - 65px)';
    document.getElementById('navbar').style.width = '65px';
    var nav_texts = document.getElementsByClassName('nav-text');
    Array.from(nav_texts).forEach(element => {
        element.style.opacity = '0';
        setTimeout(function() {
            element.style.display = 'none';
        }, 400);
    });
};