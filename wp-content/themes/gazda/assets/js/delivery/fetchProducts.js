import {productsSkeleton} from "../helpers/productsSkeleton";
import {scrollToAndActivateCategory} from "./categoryButtonsHandlers"
import {
    handleOrderButtonClick,
    handleOrderSelectChange,
    handleFilterChange,
    handleSelectFilterChange,
    handleRemoveFilter,
    handlePaginationClick,
    handleProductsFetchSuccess
} from "../shop/productFunctions"
import refs from "../main/refs"

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

const skeleton = productsSkeleton();
const {ajax_url} = settings;
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
    class: 'delivery'
};

export const fetchAndRenderProducts = (useSkeleton = true) => {
    if (useSkeleton) {
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

// Actions
const handleCategoryButtonClick = (event) => {
    const $clickedButton = $(event.target);

    if ($clickedButton.hasClass("is-active")) {
        return;
    }

    utils.loadMoreClickCount = 1;

    currentFilter.html('')

    query.categories = [$clickedButton.data('categoryId')];
    query.posts_per_page = utils.initialPostsPerPage;
    query.page = 1;
    query.tags = [];

    scrollToAndActivateCategory($clickedButton);
    fetchAndRenderProducts();
};

// Listeners
navWrapper.on("click", '.category-button', handleCategoryButtonClick);
productsItems.on("click", '.pagination__item, .load-more', (e) => handlePaginationClick(e, query, utils, fetchAndRenderProducts));
toolbarFilter.on("change", '.filter-wrapper__input', (e) => handleFilterChange(e, query, fetchAndRenderProducts))
orderSelect.on('change', (e) => handleOrderSelectChange(e, query, fetchAndRenderProducts))
currentFilter.on('click', 'button', (e) => handleRemoveFilter(e, query, fetchAndRenderProducts))

selectContainer.on('change', 'select', handleSelectFilterChange);
orderButtons.on("click", (e) => handleOrderButtonClick(e, query, fetchAndRenderProducts));

$(document).ready(function () {
    $('.nav-list__item:first .sub-menu .sub-menu__item:first button').trigger("click");
});
