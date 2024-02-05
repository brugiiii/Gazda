import {flyToCart} from "./flyToCard";
import {updateCartCount} from "./updateCardQuantity";

$(document).ready(function () {
    $('.products-items').on('click', '.add_to_cart_button.product_type_simple', function () {
        const $this = $(this);

        // Відслідковування зміни класів
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === "class") {
                    const classList = mutation.target.classList;
                    if (classList.contains('added')) {
                        updateCartCount();
                        // Зняття слухача події після виклику updateCartCount
                        observer.disconnect();
                    }
                }
            });
        });

        // Спостерігання за змінами класів у елементі $this
        observer.observe($this[0], { attributes: true });

        flyToCart($this);
    });
});
