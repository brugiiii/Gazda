const parentSwiperButtons = $('.parent-swiper__button')
const breadCrumbCurrent = $('.breadcrumb .current');
const toolbarTitle = $('.toolbar-wrapper__title');

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

export const scrollToAndActivateCategory = ($clickedButton) => {
    const categoryId = $clickedButton.data('categoryId');
    const parentCategoryId = $clickedButton.data('parentCategoryId');
    const currentCategory = $clickedButton.text();

    const activeButtons = $(`button[data-category-id="${categoryId}"]`);
    const inactiveButtons = $(`button.is-active[data-category-id]:not([data-category-id="${categoryId}"])`);
    const activeParentButton = $(`button.parent-swiper__button[data-parent-category-id="${parentCategoryId}"]`);
    const inactiveParentButton = $(`button.is-active.parent-swiper__button`).not(activeParentButton);
    const scrollToViewOptions = {behavior: 'smooth', block: 'nearest', inline: 'center'};

    activeParentButton[0].scrollIntoView(scrollToViewOptions);
    $(`.nav-wrapper .sub-menu__button[data-parent-category-id="${parentCategoryId}"]`).closest('.nav-list__item').find('.nav-list__button').trigger('click');

    if ($clickedButton.hasClass('child-swiper__button')) {
        $clickedButton[0].scrollIntoView(scrollToViewOptions)
    } else {
        const closestChildSwiper = $(`.child-swiper__button[data-category-id="${categoryId}"]`).closest('.child-swiper');

        if (!closestChildSwiper.hasClass('visible')) {
            $('.child-swiper.visible').removeClass('visible');
            closestChildSwiper.addClass('visible');
        }

        $(`button.child-swiper__button[data-category-id="${categoryId}"]`)[0].scrollIntoView(scrollToViewOptions)
    }

    activeButtons.addClass('is-active');
    inactiveButtons.removeClass('is-active');
    activeParentButton.addClass('is-active');
    inactiveParentButton.removeClass('is-active');

    breadCrumbCurrent.text(currentCategory);
    toolbarTitle.text(currentCategory);
};


parentSwiperButtons.on('click', handleParentButtonClick)