export function preloader_hide() {
    $(".preloader").delay(90).fadeOut(100).addClass('loaded');
}

export function preloader_show() {
    $(".preloader").delay(90).fadeOut(100).removeClass('loaded');
}

export function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}