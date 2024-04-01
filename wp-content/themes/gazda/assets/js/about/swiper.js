import Swiper from "swiper/bundle";

const teamSwiper = new Swiper(".team-swiper", {
    slidesPerView: 1,
    spaceBetween: 20,
    grabCursor: true,
    navigation: {
        prevEl: ".team .prev",
        nextEl: ".team .next",
    },
    breakpoints: {
        576: {
            slidesPerView: 2
        },
        768: {
            slidesPerView: 3
        },
        992: {
            slidesPerView: 4
        }
    }
});
