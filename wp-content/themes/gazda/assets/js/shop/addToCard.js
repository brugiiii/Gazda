import {flyToCart} from "./flyToCard"
import {updateCartCount} from "./updateCardQuantity"

const {ajax_url} = settings;

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

    updateCartCount();
});
