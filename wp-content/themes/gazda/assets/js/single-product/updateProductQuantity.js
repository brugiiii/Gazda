import {handleQuantity} from "../shop/productQuantity"


$(document).ready(function () {
    const quantityInput = $('.quantity input');
    const quantityValue = $('.quantity__value');

    quantityValue.text(quantityInput.val());

    const handleQuantityButtonClick = (e) => {
        const $this = $(e.currentTarget);
        const newValue = handleQuantity(e);

        if ($this.closest('.hero-section')) {
            quantityInput.val(newValue)
        } else {
            handleQuantity(e);
        }
    }

    $('.quantity__button').on('click', handleQuantityButtonClick);

    const price = $('.woocommerce-variation');
    const priceWrapper = $('.price-wrapper');

    priceWrapper.append(price);
})

