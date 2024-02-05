<?php
$product_id = get_the_ID();
$product = wc_get_product($product_id);

// Отримати ідентифікатори суміжних товарів
$related_product_ids = wc_get_related_products($product_id, -1);

// Отримати суміжні товари
$related_products = array_map('wc_get_product', $related_product_ids);
?>

<div class="swiper similar-products-swiper">
    <ul class="swiper-wrapper">
        <?php
        foreach ($related_products as $related_product) {
            // Встановлюємо глобальні дані $post для використання в шаблоні
            global $post;
            $post = $related_product->get_id();
            setup_postdata($post);

            // Тепер ви можете використовувати the_title(), the_price(), тощо
            get_template_part('templates/shop/productCard', null, array('is_swiper' => true));

            // Скидаємо глобальні дані $post
            wp_reset_postdata();
        }
        ?>
    </ul>
</div>
