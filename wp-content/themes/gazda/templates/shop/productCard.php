<?php
$is_swiper = $args['is_swiper'] ?? false;

$product = wc_get_product(get_the_ID());
?>

<li <?php wc_product_class(array('position-relative', $is_swiper ? 'swiper-slide' : ''), $product); ?>>
    <div class="product-list__wrapper bg-white rounded-3 overflow-hidden h-100">
        <?php
        /**
         * Hook: woocommerce_before_shop_loop_item.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action('woocommerce_before_shop_loop_item');

        /**
         * Hook: woocommerce_before_shop_loop_item_title.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action('woocommerce_before_shop_loop_item_title');

        ?>
        <div class="px-2 px-lg-3 pt-2">
            <?php
            /**
             * Hook: woocommerce_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action('woocommerce_shop_loop_item_title');

            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action('woocommerce_after_shop_loop_item_title');
            ?>
        </div>
        <?php
        /**
         * Hook: woocommerce_after_shop_loop_item.
         *
         * @hooked woocommerce_template_loop_product_link_close - 5
         * @hooked woocommerce_template_loop_add_to_cart - 10
         */
        do_action('woocommerce_after_shop_loop_item');
        ?>

    </div>
    <div class="quantity rounded-bottom-3 bg-white px-3 pb-3 position-absolute w-100 start-0 z-1">
        <div class="quantity-wrapper d-flex align-items-center justify-content-center">
            <button class="quantity__button bg-transparent border-0 p-0 decrement">
                <svg class="quantity__icon" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-minus'); ?>"></use>
                </svg>
            </button>
            <span class="quantity__value d-flex align-items-center justify-content-center rounded-3 bg-white">1</span>
            <button class="quantity__button bg-transparent border-0 p-0 increment">
                <svg class="quantity__icon" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-plus'); ?>"></use>
                </svg>
            </button>
        </div>
    </div>
</li>