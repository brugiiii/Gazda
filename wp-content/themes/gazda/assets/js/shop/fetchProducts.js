const {ajax_url} = settings;

let page = 1;
let categories = [422];

export const loadPosts = () => {
    $.ajax({
        url: ajax_url,
        type: 'post',
        data: {action: 'fetch_products', page, categories},
        success: (response) => {
            $('.products-items').html(response);
        }, error: (error) => {
            console.log(error)
        }
    });
};

const handleCategoryClick = (e) => {
    const $this = $(e.currentTarget);
    const categoriesIds = $this.data('categoriesIds');
    const navItem = $this.closest('.products-nav__item');
    const siblingButtons = navItem.siblings().find('.products-nav__button');

    $this.addClass('is-active');
    siblingButtons.removeClass('is-active');

    if (categoriesIds) {
        const idsArray = categoriesIds.split(' ');
        categories = idsArray;
    } else {
        const categoryId = $this.data('categoryId');
        categories = [categoryId];
    }

    loadPosts();
}

$('.products-nav').on("click", '.products-nav__button', handleCategoryClick)

$(document).ready(function (){
    $('.products-nav__button:first').trigger("click")
})

