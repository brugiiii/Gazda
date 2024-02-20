import debounce from "lodash.debounce";
import refs from "./refs";
import {
    handleOrderButtonClick,
    handleOrderSelectChange,
    handlePaginationClick,
    handleProductsFetchSuccess
} from "../shop/productFunctions";
import {productsSkeleton} from "../helpers/productsSkeleton";

const {headerSearch, searchForm, searchInput, orderButtons, orderSelect, productsList, productsItems} = refs;
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
    }
}

const handleInput = (e) => {
    const s = $(e.currentTarget).val();
    sessionStorage.setItem('searchQuery', s);

    if (!is_search_page) {
        window.location.href = search_page_link;
    } else {
        query.s = s;
        fetchProducts();
    }
}

const fetchProducts = (useSkeleton = true) => {
    if (query.s) {
        const skeletonCount = window.innerWidth >= 992 ? window.innerWidth >= 1440 ? 10 : 8 : 6;
        const skeleton = productsSkeleton(skeletonCount);

        if(useSkeleton){
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
