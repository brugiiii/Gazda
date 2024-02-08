<?php get_header();
$product = wc_get_product(get_the_ID());
?>

<main id="single-product">
    <?php get_template_part('sections/single-product/heroSection'); ?>
    <?php get_template_part('sections/single-product/productInfo'); ?>
    <?php get_template_part('sections/single-product/similarProducts'); ?>

    <div class="sticky-wrapper position-sticky bottom-0 start-0 z-1 d-flex justify-content-center gap-3 d-lg-none px-3">
        <?php
        get_template_part('templates/single-product/counter');

        woocommerce_template_single_add_to_cart();
        ?>
    </div>
</main>

<?php get_footer(); ?>
