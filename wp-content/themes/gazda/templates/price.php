<?php
$currency_symbol = get_woocommerce_currency_symbol();
$price = get_post_meta(get_the_ID(), '_price', true);

// Форматування ціни з двома знаками після коми
$formatted_price = number_format($price, 2, '.', '');

echo esc_html($formatted_price . $currency_symbol);
?>