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
    slidesPerView: 2,
    spaceBetween: 16,
    loop: true,
    grabCursor: true,
    autoHeight: true,
    breakpoints: {
        768: {
            slidesPerView: 3,
        },
        992: {
          slidesPerView: 4,
        },
        1200: {
            slidesPerView: 5,
        },
        1440: {
            slidesPerView: 5,
            spaceBetween: 30,
        }
    },
    navigation: {
        nextEl: '.similar-products-wrapper .next',
        prevEl: ".similar-products-wrapper .prev"
    }
})