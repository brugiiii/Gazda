import {handleQuantity} from "../shop/productQuantity";
import {flyToCart} from "../shop/flyToCard";
import {updateCartCount} from "../shop/updateCardQuantity"

const {ajax_url} = settings;
const buyButton = $('.buy-button');

const addToCard = (e) => {
    const $this = $(e.currentTarget);
    const product_id = $this.data('product-id');

    $this.attr('disabled', true);

    $.ajax({
        type: 'POST',
        url: ajax_url,
        data: {
            action: 'add_to_cart',
            product_id,
        },
        success: function (response) {
            $this.attr('disabled', false);

            updateCartCount();
        },
        error: function (error) {
            console.log(error)
        }
    });

    flyToCart($this);
}

buyButton.on('click', addToCard)
$('.quantity__button').on('click', (e) => handleQuantity(e));