<?php
add_action('wp_ajax_get_wishlist_count', 'get_wishlist_count_ajax');
add_action('wp_ajax_nopriv_get_wishlist_count', 'get_wishlist_count_ajax');
add_action('wp_ajax_fetch_products', 'fetch_products');
add_action('wp_ajax_nopriv_fetch_products', 'fetch_products');
add_action('wp_ajax_get_cart_count', 'get_cart_count_ajax');
add_action('wp_ajax_nopriv_get_cart_count', 'get_cart_count_ajax');
add_action('wp_ajax_get_product_price', 'get_product_price_ajax');
add_action('wp_ajax_nopriv_get_product_price', 'get_product_price_ajax');
add_action('wp_ajax_get_product_description', 'get_product_description_ajax');
add_action('wp_ajax_nopriv_get_product_description', 'get_product_description_ajax');
add_action('wp_ajax_get_product_reviews', 'get_product_reviews_ajax');
add_action('wp_ajax_nopriv_get_product_reviews', 'get_product_reviews_ajax');

function fetch_products()
{
    get_template_part('templates/shop/fetchProducts');
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
    $product_id = $_POST['product_id'];
    $variations = $_POST['variations'];
}

function get_product_description_ajax()
{
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $product = wc_get_product($product_id);

    echo wpautop($product->get_description());

    wp_die();
}

function get_product_reviews_ajax()
{
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $product = wc_get_product($product_id);

  echo 'reviews';

    wp_die();
}



