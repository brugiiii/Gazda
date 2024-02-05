const cartIcon = $('#cart')
const cartQuantity = $('.card-quantity')
const {ajax_url} = settings;

export const updateCartCount = () => {
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