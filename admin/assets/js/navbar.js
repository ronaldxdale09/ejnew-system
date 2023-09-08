var toggle = true;

// Function to highlight the active page in navigation
const activePage = window.location.pathname;
document.querySelectorAll('nav a').forEach(link => {
    if (link.href.includes(`${activePage}`)) {
        link.classList.add('active');
    }
});

// Function to toggle navigation
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
    $('.main-content').css({
        'margin-left': '240px',
        'width': 'calc(100% - 240px)'
    });
    $('#navbar').css('width', '240px');
    $('.dropdown').removeClass('retracted'); // remove the 'retracted' class
    $('.nav-text').each(function() {
        $(this).css('display', 'block');
        setTimeout(() => {
            $(this).css('opacity', '1');
        }, 250);
    });
}

function retractNav() {
    $('.main-content').css({
        'margin-left': '65px',
        'width': 'calc(100% - 65px)'
    });
    $('#navbar').css('width', '65px');
    $('.dropdown').addClass('retracted'); // add the 'retracted' class
    $('.nav-text').each(function() {
        $(this).css('opacity', '0');
        setTimeout(() => {
            $(this).css('display', 'none');
        }, 400);
    });
}

// Function to check the window size and retract the navbar
function checkWindowSize() {
    if (window.innerWidth <= 1024) {
        retractNav();
        toggle = false;
    } else {
        expandNav();
        toggle = true;
    }
}

// Listen to resize and load events
window.addEventListener('resize', checkWindowSize);
window.addEventListener('load', checkWindowSize);