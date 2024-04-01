import {flyToCart} from "../shop/flyToCard";

const cartIcon = $('#cart')

$(document).ready(function () {
    $('.buy-button').on('click', function () {
        const $this = $(this);

        $this.removeClass('added');
        
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
