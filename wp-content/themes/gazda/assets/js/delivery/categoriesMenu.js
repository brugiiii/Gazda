const handleNavListButtonClick = (e) => {
    const $this = $(e.currentTarget);
    const closestListItem = $this.closest('.nav-list__item');
    const subMenu = closestListItem.find('.sub-menu');

    if ($this.hasClass('is-active')) {
        return;
    } else {
        const siblingsListItems = closestListItem.siblings();

        $('.nav-list__button').not($this).removeClass('is-active');
        siblingsListItems.find('.sub-menu').slideUp();

        $this.addClass('is-active');
        subMenu.slideDown();
    }
}

$('.nav-wrapper').on('click', '.nav-list__button', handleNavListButtonClick);
