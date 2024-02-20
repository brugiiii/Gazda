import {productsSkeleton} from "../helpers/productsSkeleton";
import refs from "../main/refs"
import {
    shopPageScrollTo,
    deliveryPageScrollTo,
    handleOrderButtonClick,
    handleOrderSelectChange,
    handleFilterChange,
    handleSelectFilterChange,
    handleRemoveFilter,
    handlePaginationClick,
    handleProductsFetchSuccess
} from "./productFunctions"

const {
    orderButtons,
    orderSelect,
    productsList,
    productsItems,
    paginationContainer,
    toolbarFilter,
    currentFilter,
    selectContainer,
    navWrapper
} = refs;


const {ajax_url, is_delivery_page} = settings;
const utils = {
    loadMoreClickCount: 0,
    initialPostsPerPage: 12
}
const query = {
    page: 1,
    categories: [],
    posts_per_page: utils.initialPostsPerPage,
    order: 'DESC',
    tags: [],
    class: is_delivery_page ? 'delivery' : 'shop'
};

export const fetchAndRenderProducts = (useSkeleton = true) => {
    if (useSkeleton) {
        const skeletonCount = window.innerWidth >= 992 ? window.innerWidth >= 1440 ? 12 : 9 : 6;
        const skeleton = productsSkeleton(skeletonCount);
        productsList.html(skeleton);
        paginationContainer.html('');
    }

    $.ajax({
        url: ajax_url,
        type: 'post',
        data: {action: 'fetch_products', ...query},
        success: (res) => handleProductsFetchSuccess(res, query),
        error: (error) => console.log(error)
    });
};

const handleCategoryButtonClick = (event) => {
    const $clickedButton = $(event.currentTarget);

    if ($clickedButton.hasClass("is-active")) {
        return;
    }

    const categoryId = $clickedButton.data('categoryId');

    utils.loadMoreClickCount = 1;

    query.categories = typeof categoryId === 'string' ? categoryId.split(', ') : [categoryId];
    query.posts_per_page = utils.initialPostsPerPage;
    currentFilter.html('')
    query.page = 1;
    query.tags = [];

    is_delivery_page ? deliveryPageScrollTo($clickedButton) : shopPageScrollTo($clickedButton)
    fetchAndRenderProducts();
};

// Listeners
navWrapper.on("click", '.category-button', handleCategoryButtonClick);
productsItems.on("click", '.pagination__item, .load-more', (e) => handlePaginationClick(e, query, utils, fetchAndRenderProducts));
orderSelect.on('change', (e) => handleOrderSelectChange(e, query, fetchAndRenderProducts))
currentFilter.on('click', 'button', (e) => handleRemoveFilter(e, query, fetchAndRenderProducts))
toolbarFilter.on("change", '.filter-wrapper__input', (e) => handleFilterChange(e, query, fetchAndRenderProducts))
selectContainer.on('change', 'select', handleSelectFilterChange);
orderButtons.on("click", (e) => handleOrderButtonClick(e, query, fetchAndRenderProducts));

$(document).ready(function () {
    is_delivery_page ? $('.nav-list__item:first .sub-menu .sub-menu__item:first button').trigger("click") : $('.products-nav__button:first').trigger("click");
});
