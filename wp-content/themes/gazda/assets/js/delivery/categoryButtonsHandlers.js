const parentSwiperButtons = $('.parent-swiper__button')
const handleParentButtonClick = (e) => {
    const $this = $(e.currentTarget);

    if ($this.hasClass('is-active')) {
        return;
    }

    $this[0].scrollIntoView({behavior: 'smooth', block: 'nearest', inline: 'center'});

    const parentCategoryId = $this.data('parentCategoryId');
    const activeChildSwiperButton = $(`.child-swiper__button[data-parent-category-id=${parentCategoryId}]`).first();

    $('.child-swiper.visible').removeClass('visible');
    activeChildSwiperButton.closest('.child-swiper').addClass('visible');

    activeChildSwiperButton.trigger('click');
}

parentSwiperButtons.on('click', handleParentButtonClick)