export function preloader_hide() {
    $(".preloader").delay(90).fadeOut(100).addClass('loaded');
}

export function preloader_show() {
    $(".preloader").delay(90).fadeOut(100).removeClass('loaded');
}