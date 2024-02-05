const {ajax_url} = settings;
const product_id = $('main').data('product-id');
const getProductPrice = (e) => {
    const checkedVariations = $('.variations-list__input:checked');
    const variations = checkedVariations.map(function() {
        return $(this).val();
    }).get();

    const data = {
        action: 'get_product_price',
        variations,  // Переконайтеся, що це масив слагів варіацій
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
        error: function (error){
            console.log(error)
        }
    });
};

// Використання функції
$('.hero-info').on('change', '.variations-list__input', getProductPrice);
