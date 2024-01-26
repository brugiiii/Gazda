import {productsSkeleton} from "../helpers/productsSkeleton";

const productsItems = $('.products-items');
const productsList = $('.products-list');
const paginationContainer = $('.pagination-container');
const filterContainer = $('.filter-container')
const productsNav = $('.products-nav');
const orderButtons = $('.order-list__button');
const orderButton = $('.order-button');
const orderButtonText = $('.order-button__text');
const orderList = $('.order-list');
const breadCrumbCurrent = $('.breadcrumb .current');
const toolbarFilter = $('.toolbar-filter')
const filterButton = $('.filter-button')

const initialPostsPerPage = 12;
let loadMoreClickCount = 0;

const {ajax_url} = settings;
const query = {
    page: 1,
    categories: [],
    posts_per_page: initialPostsPerPage,
    order: 'ASC',
    tags: []
};

export const fetchAndRenderProducts = (useSkeleton = true) => {
    if (useSkeleton) {
        productsList.html(productsSkeleton);
    }

    $.ajax({
        url: ajax_url,
        type: 'post',
        data: {action: 'fetch_products', ...query},
        success: handleProductsFetchSuccess,
        error:  (error) => console.log(error)
    });
};

const handleProductsFetchSuccess = (response) => {
    const tempElement = document.createElement('div');
    tempElement.innerHTML = response;

    const paginationWrapper = tempElement.querySelector('.pagination-wrapper');
    const filterWrapper = tempElement.querySelector('.filter-wrapper');

    paginationContainer.addClass("d-none");
    toolbarFilter.addClass('d-none');

    if (paginationWrapper) {
        paginationContainer.removeClass('d-none');
        paginationWrapper.remove();

        paginationContainer.html(paginationWrapper);
    }

    if (filterWrapper) {
        toolbarFilter.removeClass('d-none');
        filterWrapper.remove();


        if(query.tags.length === 0) {
            filterContainer.html(filterWrapper)
        }
    }

    const remainingHTML = tempElement.innerHTML;

    productsList.html(remainingHTML);

    const lastPaginationItem = $('.pagination__item[data-page]:last');

    lastPaginationItem.data('page') === query.page ? $('.load-more').addClass('d-none') : $('.load-more').removeClass('d-none');
};

const handleCategoryButtonClick = (event) => {
    const $clickedButton = $(event.currentTarget);

    if ($clickedButton.hasClass("is-active")) {
        return;
    }

    const categoryIds = $clickedButton.data('categoriesIds');
    const navItem = $clickedButton.closest('.products-nav__item');
    const siblingButtons = navItem.siblings().find('.products-nav__button');

    $clickedButton.addClass('is-active');
    siblingButtons.removeClass('is-active');
    breadCrumbCurrent.text($clickedButton.text());
    loadMoreClickCount = 1;

    query.categories = categoryIds ? categoryIds.split(' ') : [$clickedButton.data('categoryId')];
    query.posts_per_page = initialPostsPerPage;
    query.page = 1;
    query.tags = [];

    fetchAndRenderProducts();
};

const handleFilterChange = (e) => {
    const $this = $(e.currentTarget);
    const tagId = $this.val();

    const tagIndex = query.tags.indexOf(tagId);

    if (tagIndex === -1) {
        // Якщо тега немає в масиві, то додаємо його
        query.tags.push(tagId);
    } else {
        // Якщо тег вже є в масиві, то видаляємо його
        query.tags.splice(tagIndex, 1);
    }

    fetchAndRenderProducts();
}

const handleLoadMoreClick = ($this) => {
    $this.addClass('loading')
    $this.attr('disabled', true)

    loadMoreClickCount += 1;
    query.posts_per_page = initialPostsPerPage * loadMoreClickCount;

    fetchAndRenderProducts(false);
};

const handlePaginationButtonClick = ($clickedButton) => {
    if ($clickedButton.hasClass('current')) {
        return;
    }

    const action = $clickedButton.data("action");

    if (action) {
        switch (action) {
            case 'prev':
                query.page -= 1;
                break;
            case 'next':
                query.page += 1;
                break;
            case 'first':
                query.page = 1;
                break;
            case 'last':
                query.page = $clickedButton.data('last-page');
                break;
        }
    } else {
        query.page = $clickedButton.data("page");
    }

    fetchAndRenderProducts();
};

const handlePaginationClick = (event) => {
    const $clickedButton = $(event.currentTarget);

    if ($clickedButton.hasClass('load-more')) {
        handleLoadMoreClick($clickedButton);
    } else {
        handlePaginationButtonClick($clickedButton);
    }
};

const handleOrderButtonClick = (event) => {
    const $clickedButton = $(event.currentTarget);
    const order = $clickedButton.data("order");

    if (query.order === order) {
        return;
    }

    $clickedButton.addClass("is-active").siblings().removeClass('is-active');
    orderButtonText.text($clickedButton.text());
    orderList.addClass('is-hidden');

    query.order = order;
    fetchAndRenderProducts();
};

const toggleOrderListVisibility = (event) => {
    event.stopPropagation();

    if (orderList.hasClass('is-hidden')) {
        // Keyboard tracking
        $(document).on("keydown", function (e) {
            if (e.key === "Escape") {
                orderList.addClass('is-hidden');
                $(document).off("keydown");
            }
        });

        // Click tracking
        $(document).on("click", function (e) {
            if (!orderList.is(e.target) && orderList.has(e.target).length === 0) {
                orderList.addClass('is-hidden');
                $(document).off("click");
                $(document).off("keydown");
            }
        });
    } else {
        $(document).off("keydown");
        $(document).off("click")
    }

    orderList.toggleClass('is-hidden');
};

const toggleFilterListVisibility = (event) => {
    event.stopPropagation();

    if (filterContainer.hasClass('is-hidden')) {
        // Keyboard tracking
        $(document).on("keydown", function (e) {
            if (e.key === "Escape") {
                filterContainer.addClass('is-hidden');
                $(document).off("keydown");
            }
        });

        // Click tracking
        $(document).on("click", function (e) {
            if (!filterContainer.is(e.target) && filterContainer.has(e.target).length === 0) {
                filterContainer.addClass('is-hidden');
                $(document).off("click");
                $(document).off("keydown");
            }
        });
    } else {
        $(document).off("keydown");
        $(document).off("click")
    }

    filterContainer.toggleClass('is-hidden');
}

productsItems.on("click", '.pagination__item, .load-more', handlePaginationClick);
productsNav.on("click", '.products-nav__button', handleCategoryButtonClick);
toolbarFilter.on("change", '.filter-wrapper__input', handleFilterChange)
orderButtons.on("click", handleOrderButtonClick);
orderButton.on("click", toggleOrderListVisibility);
filterButton.on('click', toggleFilterListVisibility)

$(document).ready(function () {
    $('.products-nav__button:first').trigger("click");
});
