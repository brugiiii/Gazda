import Swiper from "swiper/bundle";

const thumbsSwiper = new Swiper('.thumbs-swiper', {
    spaceBetween: 27,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
    grabCursor: true,
})

const gallerySwiper = new Swiper('.product-swiper', {
    spaceBetween: 10,
    thumbs: {
        swiper: thumbsSwiper,
    },
})

const similarProductsSwiper = new Swiper(".similar-products-swiper", {
    slidesPerView: 5,
    spaceBetween: 30,
    loop: true,
    grabCursor: true,
    navigation: {
        nextEl: '.similar-products-wrapper .next',
        prevEl: ".similar-products-wrapper .prev"
    }
})