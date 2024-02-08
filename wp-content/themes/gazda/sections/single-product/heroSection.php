<?php
$product = wc_get_product(get_the_ID());
$is_in_stock = $product->is_in_stock();
$is_variable = $product->is_type('variable');
?>

<section class="section hero-section">
    <div class="container">
        <?= get_template_part('templates/single-product/breadcrumbs'); ?>

        <div id="product-<?php the_ID(); ?>" <?php wc_product_class('d-flex justify-content-between', $product); ?>>
            <div class="hero-gallery">
                <?php
                do_action('woocommerce_before_single_product');
                /**
                 * Hook: woocommerce_before_single_product_summary.
                 *
                 * @hooked woocommerce_show_product_sale_flash - 10
                 * @hooked woocommerce_show_product_images - 20
                 */
                do_action('woocommerce_before_single_product_summary');
                ?>
            </div>
            <div class="summary entry-summary">
                <?php
                woocommerce_template_single_title();

                get_template_part('templates/single-product/is-in-stock', null, array('is_in_stock' => $is_in_stock));

                woocommerce_template_single_excerpt();

                if (!$is_variable) {
                    woocommerce_template_single_price();
                } else {
                    ?>
                    <div class="price-wrapper">
                        <?php woocommerce_template_single_add_to_cart(); ?>
                    </div>
                    <?php
                    get_template_part('templates/single-product/attributes');
                }

                if ($is_in_stock) {
                    ?>
                    <div class="d-flex align-items-center gap-3">
                        <?php
                        get_template_part('templates/single-product/counter');

                        woocommerce_template_single_add_to_cart();
                        ?>
                    </div>
                <?php }
                get_template_part('templates/single-product/features');
                ?>
            </div>
        </div>
    </div>
</section>
