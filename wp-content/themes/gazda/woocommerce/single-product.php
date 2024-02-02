<?= get_header(); ?>

<main id="single-product" data-product-id="<?= get_the_ID(); ?>">
    <?= get_template_part('sections/single-product/heroSection'); ?>
</main>

<?= get_footer(); ?>
