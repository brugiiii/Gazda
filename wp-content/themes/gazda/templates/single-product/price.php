<?php
$currency_symbol = get_woocommerce_currency_symbol();
$product_id = get_the_ID();

// For regular products, display the regular price
$price = get_post_meta($product_id, '_price', true);
$formatted_price = number_format($price, 2, '.', '');

echo esc_html($formatted_price . $currency_symbol);

