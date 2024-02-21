import refs from "./refs";
import throttle from "lodash.throttle";
const { burgerMenu, burgerButton, burgerLinks, searchForm, headerSearch } = refs;

const handleBurgerClick = function (e) {
    const $this = $(e.currentTarget);
    $this.toggleClass("is-active");
    burgerMenu.slideToggle();

    if(searchForm.is(':visible')){
        searchForm.slideToggle();
        headerSearch.toggleClass('is-active')
    }
};

const handleBurgerLinkClick = (e) => {
    const $this = $(e.currentTarget);
    const subMenu = $this.next('.sub-menu');
    const activeOtherBurgerLink = burgerLinks.not($this).filter('.is-active');

    activeOtherBurgerLink.next('.sub-menu').slideToggle();
    activeOtherBurgerLink.removeClass('is-active');

    subMenu.slideToggle();
    $this.toggleClass("is-active")
}

burgerButton.on("click", throttle(handleBurgerClick, 500));
burgerLinks.on("click", handleBurgerLinkClick)
