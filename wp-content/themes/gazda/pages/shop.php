<?php
/*
Template Name: Shop
*/
?>

<?= get_header(); ?>

<main id="shop">
    <?= get_template_part('sections/shop/productsSection'); ?>
    <?= get_template_part('sections/shop/infoSection'); ?>
    <?= get_template_part('sections/shop/faqSection'); ?>
</main>

<?= get_footer(); ?>
