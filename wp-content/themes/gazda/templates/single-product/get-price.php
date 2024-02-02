<?php
$product_id = isset($_POST['product_id']) ? sanitize_text_field($_POST['product_id']) : null;
$variations = isset($_POST['variations']) ? array_map('sanitize_text_field', $_POST['variations']) : array();

// Перевірка, чи WooCommerce активовано
if (class_exists('WooCommerce')) {
    // Отримати об'єкт товару за ідентифікатором
    $product = wc_get_product($product_id);

    if ($product) {
        // Отримати ціну для обраних варіацій
        $variation_price = $product->get_variation_price($variations);

        // Вивести ціну або використати її далі
        echo $variation_price;
    }
}
?>
