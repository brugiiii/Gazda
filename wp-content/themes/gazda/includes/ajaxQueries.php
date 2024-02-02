<?php
add_action('wp_ajax_get_wishlist_count', 'get_wishlist_count_ajax');
add_action('wp_ajax_nopriv_get_wishlist_count', 'get_wishlist_count_ajax');
add_action('wp_ajax_fetch_products', 'fetch_products');
add_action('wp_ajax_nopriv_fetch_products', 'fetch_products');
add_action('wp_ajax_add_to_cart', 'add_to_cart_ajax');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart_ajax');
add_action('wp_ajax_get_cart_count', 'get_cart_count_ajax');
add_action('wp_ajax_nopriv_get_cart_count', 'get_cart_count_ajax');
add_action('wp_ajax_get_product_price', 'get_product_price_ajax');
add_action('wp_ajax_nopriv_get_product_price', 'get_product_price_ajax');

function fetch_products()
{
    get_template_part('templates/shop/fetchProducts');
}

function add_to_cart_ajax()
{
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($product_id > 0 && $quantity > 0) {
        WC()->cart->add_to_cart($product_id, $quantity);
        echo 'Product added to cart successfully!';
    }

    wp_die();
}

function get_cart_count_ajax()
{
    echo WC()->cart->get_cart_contents_count();
    wp_die();
}

function get_wishlist_count_ajax()
{
    $wishlist_count = YITH_WCWL()->count_products();
    echo json_encode(array('wishlist_count' => $wishlist_count));
    wp_die();
}

function get_product_price_ajax()
{
    get_template_part('templates/single-product/get-price');
}
