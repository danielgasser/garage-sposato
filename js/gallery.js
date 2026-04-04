/* ============================================
Garage Sposato — Gallery (Swiper + GLightbox)
============================================ */

document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.gallery-swiper')) {
        new Swiper('.gallery-swiper', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

        });
        if (typeof GLightbox !== 'undefined') {
            GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                closeButton: true,
                closeOnOutsideClick: true,
                zoomable: false,
                loop: true,
                draggable: false,
            });
        }
    }
});