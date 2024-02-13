import {productsSkeleton} from "../helpers/productsSkeleton";
// import {categoriesSwiper} from "./swiper";

const productsItems = $('.products-items');
const productsList = $('.products-list');
const paginationContainer = $('.pagination-container');
const filterContainer = $('.filter-container');
const navList = $('.nav-wrapper .nav-list');
const orderButtons = $('.order-list__button');
const orderButton = $('.order-button');
const orderButtonText = $('.order-button__text');
const orderList = $('.order-list');
const breadCrumbCurrent = $('.breadcrumb .current');
const toolbarFilter = $('.toolbar-filter');
const filterButton = $('.filter-button');
const currentFilter = $('.current-filter');
const toolbarTitle = $('.toolbar-wrapper__title');
const orderSelect = $('select.toolbar-els__button');
const selectContainer = $('.select-container');

const initialPostsPerPage = 12;
let loadMoreClickCount = 0;

const {ajax_url} = settings;
const query = {
    page: 1,
    categories: [],
    posts_per_page: initialPostsPerPage,
    order: 'DESC',
    tags: [],
    class: 'delivery'
};

export const fetchAndRenderProducts = (useSkeleton = true) => {
    if (useSkeleton) {
        productsList.html(productsSkeleton);
        paginationContainer.html('');
    }

    $.ajax({
        url: ajax_url,
        type: 'post',
        data: {action: 'fetch_products', ...query},
        success: handleProductsFetchSuccess,
        error: (error) => console.log(error)
    });
};

const handleProductsFetchSuccess = (response) => {
    const tempElement = document.createElement('div');
    tempElement.innerHTML = response;

    const paginationWrapper = tempElement.querySelector('.pagination-wrapper');
    const filterWrapper = tempElement.querySelector('.filter-wrapper');
    const filterSelect = tempElement.querySelector('.filter-select');

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

        if(query.tags.length === 0){
            filterContainer.html(filterWrapper)
        }
    }

    if (filterSelect) {
        filterSelect.remove();

        if(query.tags.length === 0){
            selectContainer.html(filterSelect);
        }
    }

    const remainingHTML = tempElement.innerHTML;

    productsList.html(remainingHTML);

    const lastPaginationItem = $('.pagination__item[data-page]:last');

    lastPaginationItem.data('page') === query.page ? $('.load-more').addClass('d-none') : $('.load-more').removeClass('d-none');
};

// Actions
const handleCategoryButtonClick = (event) => {
    const $clickedButton = $(event.target);

    if ($clickedButton.hasClass("is-active")) {
        return;
    }

    const currentCategory = $clickedButton.text();
    const categoryId = $clickedButton.data('categoryId');
    const activeButtons = $(`.products-nav__button:contains('${currentCategory}')`);
    const siblingButtons = activeButtons.map(function () {
        const navItem = $(this).closest('.products-nav__item');
        return navItem.siblings().find('.products-nav__button');
    });

    if ($clickedButton.closest('.swiper-slide').length === 0) {
        const activeSlideIndex = activeButtons.map(function () {
            return $(this).closest('.swiper-slide').index();
        }).get().find(index => index >= 0);

        // categoriesSwiper.slideTo(activeSlideIndex)
    }

    siblingButtons.each(function () {
        $(this).removeClass('is-active');
    });

    activeButtons.each(function () {
        $(this).addClass('is-active');
    });

    breadCrumbCurrent.text(currentCategory);
    toolbarTitle.text(currentCategory)
    loadMoreClickCount = 1;

    query.categories = [categoryId];
    query.posts_per_page = initialPostsPerPage;
    currentFilter.html('')
    query.page = 1;
    query.tags = [];

    fetchAndRenderProducts();
};

const handleFilterChange = (e) => {
    const $this = $(e.currentTarget);
    const tagId = $this.val();

    const tagIndex = query.tags.indexOf(tagId);

    const {tags} = query;

    if (tagIndex === -1) {
        // Якщо тега немає в масиві, то додаємо його
        tags.push(tagId);

        currentFilter.append(`<button data-id="${tagId}">${$this.closest('label').text()}</button>`);
    } else {
        // Якщо тег вже є в масиві, то видаляємо його
        tags.splice(tagIndex, 1);

        currentFilter.find(`button[data-id="${tagId}"]`).remove();
    }

    fetchAndRenderProducts();
}

const handleSelectFilterChange = (e) => {
    const $this = $(e.target);
    const values = $this.val();

    $('.filter-wrapper__input').each(function() {
        const inputValue = $(this).val();
        const isChecked = values && values.includes(inputValue);

        if (isChecked && !$(this).prop('checked')) {
            // Якщо елемент повинен бути вибраним і він не вибраний, викликаємо click
            $(this).click();
        } else if (!isChecked && $(this).prop('checked')) {
            // Якщо елемент не повинен бути вибраним і він вибраний, викликаємо click
            $(this).click();
        }
    });
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
    orderSelect.val(order)

    query.order = order;
    fetchAndRenderProducts();
};

const handleOrderSelectChange = (event) => {
    const $this = $(event.target);
    const value = $this.val();
    const orderButtonToActive = $(`.order-list__button[data-order="${value}"]`);
    const selectedOptionText = $this.find(`option[value="${value}"]`).text();

    orderButtonToActive.siblings().removeClass('is-active');
    orderButtonToActive.addClass('is-active');
    orderButtonText.text(selectedOptionText);

    query.order = value;

    fetchAndRenderProducts();
}

const handleRemoveFilter = (e) => {
    const $this = $(e.currentTarget);
    const {tags} = query;
    const tagId = String($this.data('id'));
    const tagIndex = tags.indexOf(tagId);

    currentFilter.find(`button[data-id="${tagId}"]`).remove();
    tags.splice(tagIndex, 1);
    toolbarFilter.find(`input[value="${tagId}"]`).prop('checked', false);

    fetchAndRenderProducts();
}

// Lists visibility
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

// Listeners
productsItems.on("click", '.pagination__item, .load-more', handlePaginationClick);
navList.on("click", '.sub-menu__button', handleCategoryButtonClick);
toolbarFilter.on("change", '.filter-wrapper__input', handleFilterChange)
orderSelect.on('change', handleOrderSelectChange)
orderButtons.on("click", handleOrderButtonClick);
orderButton.on("click", toggleOrderListVisibility);
filterButton.on('click', toggleFilterListVisibility)
currentFilter.on('click', 'button', handleRemoveFilter)
selectContainer.on('change', 'select', handleSelectFilterChange);

$(document).ready(function () {
    // $('.products-nav__button:first').trigger("click");
});
