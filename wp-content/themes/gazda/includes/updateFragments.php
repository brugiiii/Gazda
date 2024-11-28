<?php
add_filter('woocommerce_add_to_cart_fragments', 'custom_cart_fragments');

function custom_cart_fragments() {
    ob_start();
    get_template_part('templates/cart/content');
    $response['cartMarkup'] = ob_get_clean();

    return $response;
}
