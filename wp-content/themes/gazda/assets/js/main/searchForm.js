import debounce from "lodash.debounce";
import refs from "./refs";
import {productsSkeleton} from "../helpers/productsSkeleton";
import {
    handleOrderButtonClick,
    handleOrderSelectChange,
    handlePaginationClick,
    handleProductsFetchSuccess
} from "../shop/productFunctions";

const {
    headerSearch,
    searchForm,
    searchInput,
    orderButtons,
    orderSelect,
    productsList,
    productsItems,
    burgerMenu,
    burgerButton
} = refs;
const {ajax_url, is_search_page, search_page_link} = settings;
const utils = {
    loadMoreClickCount: 1,
    initialPostsPerPage: 10
}
const query = {action: 'search_products', s: '', order: "DESC", page: 1, posts_per_page: utils.initialPostsPerPage};
const handleHeaderSearchClick = (e) => {
    if (!is_search_page) {
        $(e.currentTarget).toggleClass('is-active');
        searchForm.slideToggle();

        if (burgerMenu.is(':visible')) {
            burgerMenu.slideToggle();
            burgerButton.toggleClass('is-active');
        }
    }
}

const handleInput = (e) => {
    const s = $(e.currentTarget).val();
    sessionStorage.setItem('searchQuery', s);

    if (s) {
        if (!is_search_page) {
            window.location.href = search_page_link;
        } else {
            if (burgerMenu.is(':visible')) burgerMenu.slideToggle() && burgerButton.toggleClass('is-active');

            query.s = s;
            fetchProducts();
        }
    }
}


const fetchProducts = (useSkeleton = true) => {
    const skeletonCount = window.innerWidth >= 992 ? window.innerWidth >= 1440 ? 10 : 8 : 6;
    const skeleton = productsSkeleton(skeletonCount);

    if (useSkeleton) {
        productsList.html(skeleton);
    }

    $.ajax({
        url: ajax_url,
        type: 'post',
        data: query,
        success: (res) => handleProductsFetchSuccess(res, query),
        error: (error) => console.log(error)
    });
}

// Listeners
headerSearch.on('click', handleHeaderSearchClick)
searchInput.on('input', debounce(handleInput, 700))
orderButtons.on("click", (e) => handleOrderButtonClick(e, query, fetchProducts));
orderSelect.on('change', (e) => handleOrderSelectChange(e, query, fetchProducts))
productsItems.on("click", '.pagination__item, .load-more', (e) => handlePaginationClick(e, query, utils, fetchProducts));

$(document).ready(function () {
    const searchQuery = sessionStorage.getItem('searchQuery');
    if (searchQuery && is_search_page) {
        query.s = searchQuery;
        fetchProducts();

        searchInput.val(searchQuery);
    }

    if (is_search_page) {
        headerSearch.addClass('is-active');
    }
});