$(document).ready(function () {
    $('.products-items').on('click', '.product-list__button', function () {
        const $this = $(this);

        const productId = $this.data('product-id');
        const quantity = $this.next('.quantity').find('.quantity__value').text();

        $.ajax({
            type: 'POST',
            url: settings.ajax_url,
            data: {
                action: 'add_to_cart',
                product_id: productId,
                quantity: quantity,
            },
            success: function (response) {
                console.log(response);
            },
        });
    });
});
