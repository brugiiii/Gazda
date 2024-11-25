<?php
/*
Template Name: Shop
*/
?>

<?= get_header(); ?>

<main id="shop">
    <?= get_template_part('sections/productsSection'); ?>
    <?= get_template_part('sections/infoSection'); ?>
    <?= get_template_part('sections/faqSection'); ?>
</main>

<?= get_footer(); ?>
