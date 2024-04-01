import Swiper from "swiper/bundle";

const aboutSwiper = new Swiper(".about-swiper", {
    slidesPerView: 1,
    spaceBetween: 20,
    grabCursor: true,
    navigation: {
        nextEl: ".about-wrapper .next",
        prevEl: ".about-wrapper .prev",
    },
    autoHeight: true
});
