<?php get_header();
$product = wc_get_product(get_the_ID());
?>

<main id="single-product">
    <?php get_template_part('sections/single-product/heroSection'); ?>
</main>

<?php get_footer(); ?>
