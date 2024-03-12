import refs from "./refs";
import throttle from "lodash.throttle";
const { burgerMenu, burgerButton, burgerLinks, searchForm, headerSearch } = refs;
const {is_search_page} = settings;
const handleBurgerClick = function (e) {
    const $this = $(e.currentTarget);
    $this.toggleClass("is-active");
    burgerMenu.slideToggle();

    if(searchForm.is(':visible') && !is_search_page){
        searchForm.slideToggle();
        headerSearch.toggleClass('is-active')
    }

    if(burgerMenu.is(':visible') && is_search_page){
        searchForm.slideToggle();
    }
};

const handleBurgerLinkClick = (e) => {
    const $this = $(e.currentTarget);

    if(window.innerWidth >= 1440) return

    const subMenu = $this.find('.sub-menu');
    const activeOtherBurgerLink = burgerLinks.not($this).filter('.is-active');

    activeOtherBurgerLink.find('.sub-menu').slideToggle();
    activeOtherBurgerLink.removeClass('is-active');

    subMenu.slideToggle();
    $this.toggleClass("is-active")
}

burgerButton.on("click", throttle(handleBurgerClick, 500));
burgerLinks.on("click", handleBurgerLinkClick)
