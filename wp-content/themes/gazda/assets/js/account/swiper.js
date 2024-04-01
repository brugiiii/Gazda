import Swiper from "swiper/bundle";

export const ordersSwiper = new Swiper(".orders-swiper", {
    slidesPerView: 1,
    spaceBetween: 16,
    navigation: {
        prevEl: ".orders-swiper .prev",
    },
    autoHeight: true,
    allowTouchMove: false
});
