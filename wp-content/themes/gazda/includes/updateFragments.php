<?php
add_filter('woocommerce_add_to_cart_fragments', 'custom_cart_fragments');

function custom_cart_fragments()
{
    ob_start();
    get_template_part('templates/cart/content');
    $cart_markup = ob_get_clean();

    $cart_count = WC()->cart->get_cart_contents_count();

    $response = array(
        'cartMarkup' => $cart_markup,
        'cartCount' => $cart_count
    );

    return $response;
}


