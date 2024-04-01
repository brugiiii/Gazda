<?php
$order_id = isset($_POST['order_id']) ? sanitize_text_field($_POST['order_id']) : '';
$order_obj = wc_get_order($order_id);
$current_lang = pll_current_language();

if ($order_obj && ($order_items = $order_obj->get_items())) {
    $delivery_items = $shop_items = [];
    $total_price = 0; // Ініціалізуємо загальну суму перед циклом

    foreach ($order_items as $item_id => $item) {
        $product = $item->get_product();
        $class_terms = get_the_terms($product->get_id(), 'class');

        if ($class_terms && !is_wp_error($class_terms)) {
            $class_slugs = wp_list_pluck($class_terms, 'slug');
            in_array('delivery', $class_slugs) ? $delivery_items[] = $item : $shop_items[] = $item;
        }
    }

    // Обчислюємо загальну суму товарів
    foreach ([$delivery_items, $shop_items] as $items) {
        foreach ($items as $item) {
            $product = $item->get_product();
            $product_price = $product->get_price();
            $product_quantity = $item->get_quantity();
            $total_price += $product_price * $product_quantity;
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
            <div class="products-wrapper mb-3">
                <h3 class="order-info__title fs-6 mb-2">
                    <?= get_the_title($items === $delivery_items ? pll_get_post(34, $current_lang) : ($current_lang === 'uk' ? wc_get_page_id('shop') : 6386)); ?>
                </h3>
                <ul class="products-list mb-2">
                    <?php
                    $subtotal = 0;

                    foreach ($items as $item) {
                        $product = $item->get_product();
                        $product_image = $product->get_image();
                        $product_name = $product->get_name();
                        $product_price = $product->get_price();
                        $product_quantity = $item->get_quantity();
                        $subtotal += $product_price * $product_quantity;

                        // Перевірка кількості товару
                        if ($product_quantity == 1) {
                            $price_display = number_format($product_price, 2, '.', '') . '₴';
                        } else {
                            $price_display = $product_quantity . ' x ' . number_format($product_price, 2, '.', '') . '₴' . ' = ' . number_format(($product_price * $product_quantity), 2, '.', '') . '₴';
                        }
                        ?>
                        <li class="products-list__item d-flex align-items-center gap-3 pb-3">
                            <div class="products-list__thumb mb-0 overflow-hidden"><?= $product_image; ?></div>
                            <div class="products-list__wrapper align-self-stretch d-flex flex-column flex-sm-row align-items-sm-center justify-content-between flex-grow-1">
                                <h4 class="products-list__title mb-0 overflow-hidden"><?= $product_name; ?></h4>
                                <span class="products-list__price ms-lg-auto"><?= $price_display; ?></span>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <p class="total-price mb-0 text-end">
                    <span class="total-price__item">
                        <?= translate_and_output('sum') . ':' ?>
                    </span>
                    <?= number_format($subtotal, 2, '.', '') . '₴'; ?>
                </p>
            </div>
            <?php
        }
    }
    ?>
    <div class="price-details p-3 text-end rounded-3">
        <p class="price-details__field mb-2">
            <span class="price-details__item">
                <?= translate_and_output('total_sum') ?>:
            </span>
            <?= number_format($total_price, 2, '.', '') ?>₴
        </p>
        <p class="price-details__field mb-2">
            <span class="price-details__item">
                <?= translate_and_output('discount') ?>:
            </span>
            -<?= $order_obj->get_discount_total() ?>₴
        </p>
        <p class="price-details__field mb-3">
            <span class="price-details__item">
                <?= translate_and_output('shipping') ?>:
            </span>
            +<?= $order_obj->get_shipping_total() ?>₴
        </p>
        <p class="price-details__field mb-0">
            <span class="price-details__item">
                <?= translate_and_output('amount_paid') ?>:
            </span>
            <?= $order_obj->get_total() ?>₴
        </p>
    </div>
    <?php
} else {
    echo 'Order not found or no items found in the order.';
}

wp_die();
?>
