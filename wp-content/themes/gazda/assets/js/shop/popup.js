import {showBackdrop, hideBackdrop} from "../main/utils"

const categoriesBackdrop = $('#categories-menu');
const categoriesButton = $('.categories-button');
const hideCategoriesButton = $('.menu-button');

categoriesButton.on("click", () => showBackdrop(categoriesBackdrop, true));
hideCategoriesButton.on("click", () => hideBackdrop(categoriesBackdrop));
categoriesBackdrop.on("click", '.products-nav__button, .category-button', () => hideBackdrop(categoriesBackdrop));