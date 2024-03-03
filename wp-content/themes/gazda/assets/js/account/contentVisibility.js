import refs from "../main/refs"

const {accountNav} = refs

const handleNavClick = (e) => {
    const $this = $(e.currentTarget);

    if ($this.hasClass('is-active')) return;

    const previousActiveButton = $('.nav-list__button.is-active');
    const data = $this.data('content');
    const previousActiveSectionItem = $('.section__item:visible')
    const activeSectionItem = $(`.section__item[data-content="${data}"]`)

    previousActiveSectionItem.hide();
    activeSectionItem.show();
    previousActiveButton.removeClass('is-active');
    $this.addClass('is-active');
}

accountNav.on("click", '.nav-list__button', handleNavClick)