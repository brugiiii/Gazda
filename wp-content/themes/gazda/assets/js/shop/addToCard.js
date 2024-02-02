import {flyToCart} from "./flyToCard"

const {ajax_url} = settings;

const cartIcon = $('#cart')
const cartQuantity = $('.card-quantity')

$(document).ready(function () {
    $('.products-items').on('click', '.product-list__button', function () {
        const $this = $(this);

        $this.attr('disabled', true)

        flyToCart($this);

        const productId = $this.data('product-id');
        const quantity = $this.closest('.products-list__item').find('.quantity__value').text();

        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                action: 'add_to_cart',
                product_id: productId,
                quantity: quantity,
            },
            success: function (response) {
                updateCartCount();

                $this.attr('disabled', false);
            },
        });
    });

    function updateCartCount() {
        // Здійснюємо AJAX-запит, щоб отримати оновлену кількість унікальних товарів у кошику
        $.ajax({
            type: 'GET',
            url: ajax_url,
            data: {
                action: 'get_cart_count', // Оновлене ім'я дії
            },
            success: function (response) {
                cartIcon.addClass('animate');
                cartQuantity.text(response);
                setTimeout(function () {
                    cartIcon.removeClass('animate');
                }, 700);
            },
        });
    }
});
