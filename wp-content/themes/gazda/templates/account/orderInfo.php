<?php
$order_id = isset($_POST['order_id']) ? sanitize_text_field($_POST['order_id']) : '';
$order_obj = wc_get_order($order_id);
$current_lang = pll_current_language();

if ($order_obj && ($order_items = $order_obj->get_items())) {
    $delivery_items = $shop_items = [];

    foreach ($order_items as $item_id => $item) {
        $product = $item->get_product();
        $class_terms = get_the_terms($product->get_id(), 'class');

        if ($class_terms && !is_wp_error($class_terms)) {
            $class_slugs = wp_list_pluck($class_terms, 'slug');
            in_array('delivery', $class_slugs) ? $delivery_items[] = $item : $shop_items[] = $item;
        }
    }
    ?>
    <h2 class="mb-3 text-uppercase">
        <?= translate_and_output('order') . ' №' . $order_id; ?>
    </h2>
        <?php

    foreach ([$delivery_items, $shop_items] as $items) {
        if (!empty($items)) {
            ?>
            <div class="products-wrapper">
                <h3 class="order-info__title fs-6 mb-2">
                    <?= get_the_title($items === $delivery_items ? pll_get_post(34, $current_lang) : ($current_lang === 'uk' ? wc_get_page_id('shop') : 6386)); ?>
                </h3>
                <ul class="products-list">
                    <?php
                    foreach ($items as $item) {
                        $product = $item->get_product();
                        $product_image = $product->get_image();
                        $product_name = $product->get_name();
                        $product_price = $product->get_price();
                        ?>
                        <li class="products-list__item d-flex align-items-center gap-3 pb-3">
                            <div class="products-list__thumb mb-0 overflow-hidden"><?= $product_image; ?></div>
                            <div class="products-list__wrapper align-self-stretch d-flex flex-column flex-sm-row align-items-sm-center justify-content-between flex-grow-1">
                                <h4 class="products-list__title mb-0 overflow-hidden"><?= $product_name; ?></h4>
                                <span class="products-list__price ms-lg-auto"><?= $product_price . '₴'; ?></span>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
        }
    }

} else {
    echo 'Order not found or no items found in the order.';
}

wp_die();
?>