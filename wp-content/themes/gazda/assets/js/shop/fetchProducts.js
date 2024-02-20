import {productsSkeleton} from "../helpers/productsSkeleton";
import refs from "../main/refs"
import {
    scrollToAndActivateCategory,
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
    productsNav,
    toolbarFilter,
    currentFilter,
    selectContainer
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
};

const fetchAndRenderProducts = (useSkeleton = true) => {
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

const handleCategoryButtonClick = (event) => {
    const $clickedButton = $(event.currentTarget);

    if ($clickedButton.hasClass("is-active")) {
        return;
    }

    const categoryId = $clickedButton.data('categoryId');
    let categoryIds;

    if (typeof categoryId === 'string') {
        categoryIds = categoryId.split(' ');
    }

    utils.loadMoreClickCount = 1;

    query.categories = categoryIds ? categoryIds : [categoryId];
    query.posts_per_page = utils.initialPostsPerPage;
    currentFilter.html('')
    query.page = 1;
    query.tags = [];

    scrollToAndActivateCategory($clickedButton);
    fetchAndRenderProducts();
};

// Listeners
productsNav.on("click", '.products-nav__button', handleCategoryButtonClick);
productsItems.on("click", '.pagination__item, .load-more', (e) => handlePaginationClick(e, query, utils, fetchAndRenderProducts));
toolbarFilter.on("change", '.filter-wrapper__input', (e) => handleFilterChange(e, query, fetchAndRenderProducts))
orderSelect.on('change', (e) => handleOrderSelectChange(e, query, fetchAndRenderProducts))
currentFilter.on('click', 'button', (e) => handleRemoveFilter(e, query, fetchAndRenderProducts))
selectContainer.on('change', 'select', handleSelectFilterChange);
orderButtons.on("click", (e) => handleOrderButtonClick(e, query, fetchAndRenderProducts));

$(document).ready(function () {
    $('.products-nav__button:first').trigger("click");
});
