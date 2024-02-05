const {ajax_url} = settings;
const product_id = $('main').data('product-id');
const contentWrapper = $('.content-wrapper');
const buttonsList = $('.buttons-list');

const getProductDescription = () => {
    $.ajax({
        type: 'POST',
        url: ajax_url,
        data: {
            action: 'get_product_description',
            product_id,
        },
        success: function (response) {
            contentWrapper.html(`<div class="description">${response}</div>`);
        },
        error: function (error) {
            console.log(error)
        }
    });
}

const getProductReviews = () => {
    $.ajax({
        type: 'POST',
        url: ajax_url,
        data: {
            action: 'get_product_reviews',
            product_id,
        },
        success: function (response) {
            contentWrapper.html(`<div class="reviews">${response}</div>`);
        },
        error: function (error) {
            console.log(error)
        }
    });
}

const getProductExchangeAndReturn = () => {

}

const handleInfoButtonClick = (e) => {
    const $this = $(e.target);

    if($this.hasClass('is-active')){
        return;
    }

    const data = $(e.target).data('info');
    const siblingButtons = $this.closest('.buttons-list__item').siblings().find('.buttons-list__button')

    $this.addClass('is-active');
    siblingButtons.removeClass('is-active');

    switch (data) {
        case 'description':
            getProductDescription();
            break;
        case 'reviews':
            getProductReviews();
            break;
        case 'exchange and return':
            getProductExchangeAndReturn();
            break;
    }
}

buttonsList.on("click", '.buttons-list__button', handleInfoButtonClick)