import {productsSkeleton} from "../helpers/productsSkeleton";

const {ajax_url} = settings;
const productsItems = $('.products-items');
const productsNav = $('.products-nav');
const orderButtons = $('.order-list__button')
const orderButton = $('.order-button__text')
const orderList = $('.order-list')
const breadCrumbCurrent = $('.breadcrumb .current')

const query = {
    page: 1,
    categories: [],
    posts_per_page: 12,
    order: 'ASC',
    attributes: []
}

export const loadPosts = () => {
    productsItems.html(productsSkeleton);

    $.ajax({
        url: ajax_url,
        type: 'post',
        data: {
            action: 'fetch_products',
            ...query
        },
        success: response => productsItems.html(response),
        error: error => console.log(error)
    });
};

const handleCategoryClick = e => {
    const $this = $(e.currentTarget);

    if ($this.hasClass("is-active")){
        return;
    }

    const categoriesIds = $this.data('categoriesIds');
    const navItem = $this.closest('.products-nav__item');
    const siblingButtons = navItem.siblings().find('.products-nav__button');

    $this.addClass('is-active');
    siblingButtons.removeClass('is-active');
    breadCrumbCurrent.text($this.text())

    if (categoriesIds) {
        const idsArray = categoriesIds.split(' ');
        query.categories = idsArray;
    } else {
        const categoryId = $this.data('categoryId');
        query.categories = [categoryId];
    }

    query.page = 1;

    loadPosts();
}

const handlePaginationClick = e => {
    const $this = $(e.currentTarget);

    if ($this.hasClass('current')) {
        return;
    }

    const action = $this.data("action");

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
                query.page = $this.data('last-page');
                break;
        }
    } else {
        query.page = $this.data("page");
    }

    loadPosts();
};

const handleOrderButtonClick = e => {
    const $this = $(e.currentTarget);
    const order = $this.data("order");

    if (query.order === order) {
        return;
    }

    $this.addClass("is-active").siblings().removeClass('is-active');
    orderButton.text($this.text());
    orderList.addClass('is-hidden')

    query.order = order;
    loadPosts();
};

const showOrderButtons = () => {
    e.stopPropagation();

    if(orderList.hasClass('is-hidden')){
        $(document).on("click", function (e) {
            if (!orderList.is(e.target) && orderList.has(e.target).length === 0) {
                orderList.addClass('is-hidden');
                $(document).off("click");
            }
        });
    }

    orderList.toggleClass('is-hidden');
}

productsItems.on("click", '.pagination__item', handlePaginationClick);
productsNav.on("click", '.products-nav__button', handleCategoryClick)
orderButtons.on("click", handleOrderButtonClick)
orderButton.on("click", showOrderButtons);

$(document).ready(function () {
    $('.products-nav__button:first').trigger("click")
})
