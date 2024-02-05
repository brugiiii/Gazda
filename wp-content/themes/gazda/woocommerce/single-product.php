<?= get_header(); ?>

<main id="single-product" data-product-id="<?= get_the_ID(); ?>">
    <?php
    get_template_part('sections/single-product/heroSection');
    get_template_part('sections/single-product/productInfo');
    get_template_part('sections/single-product/similarProducts');
    ?>
</main>

<?= get_footer(); ?>
