import throttle from "lodash.throttle";
import {childSwiper, parentSwiper} from "./swiper"

$('#restaurant .nav-list').on('click', 'button', function () {
    const $this = $(this);
    const listItem = $this.closest('li');
    const subMenu = $this.next('.sub-menu');
    const otherButtons = listItem.siblings().find('button');

    if ($this.hasClass('active')) {
        // Видалити класи active та застосувати slideUp для всіх вкладених елементів button
        $this.removeClass('active');
        subMenu.slideUp();
    } else {
        // Прибрати клас active з усіх кнопок та застосувати slideUp для їхніх підменю
        otherButtons.removeClass('active');
        otherButtons.next('.sub-menu').slideUp();

        // Додати клас active поточній кнопці та застосувати slideToggle для її підменю
        $this.addClass('active');
        subMenu.slideToggle();
    }
});

const sections = $('section.products');
const links = $('#restaurant .nav-list a');
const menuItem = $('#restaurant .menu-item');

const handleSubMenu = (link) => {
    try {
        const subMenu = link.closest('.sub-menu');
        const listItem = subMenu.closest('li');
        const thisButton = listItem.find('button');
        const otherButtons = listItem.siblings().find('button');

        links.removeClass('active');
        link.addClass('active');

        // Прибрати клас active з усіх кнопок та застосувати slideUp для їхніх підменю
        otherButtons.removeClass('active');
        otherButtons.next('.sub-menu').slideUp();

        // Додати клас active поточній кнопці та застосувати slideDown для її підменю
        thisButton.addClass('active');
        subMenu.slideDown();

        menuItem.text(link.text());

        const categorySlug = link.attr('href').replace(/^#/, '');
        const childActiveSlide = $(`.child-swiper li[data-category-slug="${categorySlug}"]`);
        const childActiveSlideIndex = parseInt(childActiveSlide.attr('aria-label').split(' / ')[0], 10);

        childActiveSlide.addClass('is-active');
        childActiveSlide.siblings().removeClass('is-active');

        const parentId = childActiveSlide.data('parent-id');
        const parentActiveSlide = $(`.parent-swiper .swiper-slide[data-id="${parentId}"]`);
        const parentActiveSlideIndex = parseInt(parentActiveSlide.attr('aria-label').split(' / ')[0], 10);

        parentActiveSlide.addClass('is-active');
        parentActiveSlide.siblings().removeClass('is-active');

        childSwiper.slideTo(childActiveSlideIndex - 1, 300);
        parentSwiper.slideTo(parentActiveSlideIndex - 1, 300);
    } catch (error) {
    }
};


const handleScroll = () => {
    const top = $(window).scrollTop();

    sections.each((index, section) => {
        const $section = $(section);
        const offset = $section.offset().top;
        const height = $section.outerHeight();
        const id = $section.prop('id');
        const linkToActive = $(`#restaurant .nav-list a[href="#${id}"]`);

        if (top >= offset - 1 && top < offset + height && !linkToActive.hasClass('active')) {
            handleSubMenu(linkToActive);
        }
    });
};

$(document).ready(() => {
    handleScroll();
    if (!links.is('.active')) {
        handleSubMenu(links.eq(0));
    }
});

$(window).on('scroll', throttle(handleScroll, 100));

$('.parent-swiper').on('click', '.swiper-slide', function () {
    const $this = $(this);
    const categoryId = $this.data('id');

    const childSwiperActiveLink = $(`.child-swiper .swiper-slide[data-parent-id="${categoryId}"] a`)[0];
    childSwiperActiveLink.click()
})