import Swiper from "swiper/bundle";

export const parentSwiper = new Swiper('.parent-swiper', {
    slidesPerView: "auto",
    spaceBetween: 16,
    allowTouchMove: true,
    slideToClickedSlide: true,
});

export const childSwiper = new Swiper('.child-swiper', {
    slidesPerView: "auto",
    spaceBetween: 10,
    allowTouchMove: true,
    slideToClickedSlide: true,
});