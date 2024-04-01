import {flyToCart} from "./flyToCard";

const cartIcon = $('#cart')

$(document).ready(function () {
    $('.products-items').on('click', '.add_to_cart_button.product_type_simple', function () {
        const $this = $(this);

        // Відслідковування зміни класів
        const observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                if (mutation.attributeName === "class") {
                    const classList = mutation.target.classList;
                    if (classList.contains('added')) {

                        cartIcon.addClass('animate');

                        setTimeout(function () {
                            cartIcon.removeClass('animate');
                        }, 700);

                        observer.disconnect();
                    }
                }
            });
        });

        observer.observe($this[0], {attributes: true});

        flyToCart($this);
    });
});
