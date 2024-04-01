import refs from "../main/refs"

const {
    toolbarFilter,
    orderSelect,
    orderList,
    paginationContainer,
    productsList,
    selectContainer,
    filterContainer,
    breadCrumbCurrent,
    toolbarTitle,
    currentFilter,
    orderButtonText
} = refs;

// Actions

export const handleProductsFetchSuccess = (res, query) => {
    const tempElement = document.createElement('div');
    tempElement.innerHTML = res;

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

        if (query.tags.length === 0) {
            filterContainer.html(filterWrapper)
        }
    }

    if (filterSelect) {
        filterSelect.remove();

        if (query.tags.length === 0) {
            selectContainer.html(filterSelect);
        }
    }

    const remainingHTML = tempElement.innerHTML;

    productsList.html(remainingHTML);

    const lastPaginationItem = $('.pagination__item[data-page]:last');

    lastPaginationItem.data('page') === query.page ? $('.load-more').addClass('d-none') : $('.load-more').removeClass('d-none');
};

export const deliveryPageScrollTo = ($clickedButton) => {
    const categoryId = $clickedButton.data('categoryId');
    const parentCategoryId = $clickedButton.data('parentCategoryId');
    const currentCategory = $clickedButton.text();

    const activeButtons = $(`button[data-category-id="${categoryId}"]`);
    const inactiveButtons = $(`button.is-active[data-category-id]:not([data-category-id="${categoryId}"])`);
    const activeParentButton = $(`button.parent-swiper__button[data-parent-category-id="${parentCategoryId}"]`);
    const inactiveParentButton = $(`button.is-active.parent-swiper__button`).not(activeParentButton);
    const scrollToViewOptions = {behavior: 'smooth', block: 'nearest', inline: 'center'};

    activeParentButton[0].scrollIntoView(scrollToViewOptions);
    $(`.nav-wrapper .sub-menu__button[data-parent-category-id="${parentCategoryId}"]`).closest('.nav-list__item').find('.nav-list__button').trigger('click');

    if ($clickedButton.hasClass('child-swiper__button')) {
        $clickedButton[0].scrollIntoView(scrollToViewOptions)
    } else {
        const closestChildSwiper = $(`.child-swiper__button[data-category-id="${categoryId}"]`).closest('.child-swiper');

        if (!closestChildSwiper.hasClass('visible')) {
            $('.child-swiper.visible').removeClass('visible');
            closestChildSwiper.addClass('visible');
        }

        $(`button.child-swiper__button[data-category-id="${categoryId}"]`)[0].scrollIntoView(scrollToViewOptions)
    }

    activeButtons.addClass('is-active');
    inactiveButtons.removeClass('is-active');
    activeParentButton.addClass('is-active');
    inactiveParentButton.removeClass('is-active');

    breadCrumbCurrent.text(currentCategory);
    toolbarTitle.text(currentCategory);
}
export const shopPageScrollTo = ($clickedButton) => {
    const currentCategory = $clickedButton.text();
    const categoryId = $clickedButton.data('categoryId');

    const activeButtons = $(`.products-nav__button[data-category-id="${categoryId}"]`);
    const inactiveButtons = $(`.products-nav__button.is-active[data-category-id]:not([data-category-id="${categoryId}"])`);

    if ($clickedButton.hasClass('swiper-button-js')) {
        $clickedButton[0].scrollIntoView({behavior: 'smooth', block: 'nearest', inline: 'center'});
    } else {
        $(`.swiper-button-js[data-category-id="${categoryId}"]`)[0].scrollIntoView({
            behavior: 'smooth',
            block: 'nearest',
            inline: 'center'
        });
    }

    inactiveButtons.each(function () {
        $(this).removeClass('is-active');
    });

    activeButtons.each(function () {
        $(this).addClass('is-active');
    });

    breadCrumbCurrent.text(currentCategory);
    toolbarTitle.text(currentCategory)

    currentFilter.html('')
};

export const handleOrderButtonClick = (e, query, fetchProducts) => {
    const $clickedButton = $(e.currentTarget);
    const order = $clickedButton.data("order");

    if (query.order === order) {
        return;
    }

    $clickedButton.addClass("is-active").siblings().removeClass('is-active');
    orderButtonText.text($clickedButton.text());
    orderList.addClass('is-hidden');
    orderSelect.val(order)

    query.order = order;

    fetchProducts();
};

export const handleOrderSelectChange = (e, query, fetchProducts) => {
    const $this = $(e.target);
    const value = $this.val();
    const orderButtonToActive = $(`.order-list__button[data-order="${value}"]`);
    const selectedOptionText = $this.find(`option[value="${value}"]`).text();

    orderButtonToActive.siblings().removeClass('is-active');
    orderButtonToActive.addClass('is-active');
    orderButtonText.text(selectedOptionText);

    query.order = value;

    fetchProducts();
}

export const handleFilterChange = (e, query, fetchProducts) => {
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

    fetchProducts();
}

export const handleSelectFilterChange = (e) => {
    const $this = $(e.target);
    const values = $this.val();

    $('.filter-wrapper__input').each(function () {
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

export const handleRemoveFilter = (e, query, fetchProducts) => {
    const $this = $(e.currentTarget);
    const {tags} = query;
    const tagId = String($this.data('id'));
    const tagIndex = tags.indexOf(tagId);

    currentFilter.find(`button[data-id="${tagId}"]`).remove();
    tags.splice(tagIndex, 1);
    toolbarFilter.find(`input[value="${tagId}"]`).prop('checked', false);

    fetchProducts();
}

export const handleLoadMoreClick = ($this, query, utils, fetchProducts) => {
    $this.addClass('loading')
    $this.attr('disabled', true)

    utils.loadMoreClickCount += 1;
    query.posts_per_page = utils.initialPostsPerPage * utils.loadMoreClickCount;

    fetchProducts(false);
};

export const handlePaginationButtonClick = ($clickedButton, query, fetchProducts) => {
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

    fetchProducts();
};

export const handlePaginationClick = (e, query, utils, fetchProducts) => {
    const $clickedButton = $(e.currentTarget);

    if ($clickedButton.hasClass('load-more')) {
        handleLoadMoreClick($clickedButton, query, utils, fetchProducts);
    } else {
        handlePaginationButtonClick($clickedButton, query, fetchProducts);
    }
};