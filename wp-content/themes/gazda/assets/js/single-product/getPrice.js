const {ajax_url} = settings;
const product_id = $('main').data('product-id');
const getProductPrice = (e) => {
    const checkedVariations = $('.variations-list__input:checked');
    const variations = checkedVariations.map(function() {
        return $(this).val();
    }).get();

    const data = {
        action: 'get_product_price',
        variations,
        product_id
    }

    // Виконання AJAX-запиту
    $.ajax({
        type: 'POST',
        url: ajax_url,
        data,
        success: function (response) {

            console.log(response)
        },
    });
};

// Використання функції
$('.hero-info').on('change', '.variations-list__input', getProductPrice);
