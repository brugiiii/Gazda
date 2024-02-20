import Swiper from "swiper/bundle";

const heroSwiper = new Swiper(".hero-swiper", {
    slidesPerView: 1,
    grabCursor: true,
    navigation: {
        nextEl: ".hero-wrapper .next",
        prevEl: ".hero-wrapper .prev",
    },
    loop: true,
    autoHeight: true
});

const reviewsSwiper = new Swiper(".reviews-swiper", {
    slidesPerView: 1,
    spaceBetween: 16,
    grabCursor: true,
    keyboard: true,

    breakpoints: {
        768: {
            slidesPerView: 2,
        },
        1200: {
            slidesPerView: 3,
        },
        1440: {
            slidesPerView: 3,
            spaceBetween: 24.24,
        }
    }
});

const gallerySwiper = new Swiper(".gallery-swiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    grabCursor: true,
    pagination: {
        el: ".gallery .swiper-pagination",
    },
    breakpoints: {
        576: {
            slidesPerView: 2,
        },
        1200: {
            slidesPerView: 3,
        },
        1920: {
            slidesPerView: 4
        }
    }
});