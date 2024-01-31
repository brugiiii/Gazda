import Swiper from "swiper/bundle";

export const categoriesSwiper = new Swiper('.categories-swiper', {
    slidesPerView: "auto",
    spaceBetween: 10,
    allowTouchMove: true,
    slideToClickedSlide: true,
})