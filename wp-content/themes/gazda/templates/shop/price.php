<?php
$currency_symbol = get_woocommerce_currency_symbol();
$product_id = get_the_ID();
$product = wc_get_product($product_id);

if ($product->is_type('variable')) {
    // For variable products, get the variation prices
    $variation_prices = $product->get_variation_prices();

    if ($variation_prices) {
        $min_price = current($variation_prices['price']);
        $max_price = end($variation_prices['price']);

        // Format the prices with two decimal places
        $formatted_min_price = number_format($min_price, 2, '.', '');
        $formatted_max_price = number_format($max_price, 2, '.', '');

        // Output the price range
        if ($min_price !== $max_price) {
            echo esc_html($formatted_min_price . $currency_symbol . ' - ' . $formatted_max_price . $currency_symbol);
        } else {
            echo esc_html($formatted_min_price . $currency_symbol);
        }
    }
} else {
    // For regular products, display the regular price
    $price = get_post_meta($product_id, '_price', true);
    $formatted_price = number_format($price, 2, '.', '');

    echo esc_html($formatted_price . $currency_symbol);
}
?>
