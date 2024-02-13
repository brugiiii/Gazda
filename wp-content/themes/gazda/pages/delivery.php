<?php
/*
Template Name: Delivery
*/
?>

<?php get_header(); ?>

<main id="delivery">
    <?= get_template_part('sections/productsSection', null, array('page' => 'delivery')); ?>
    <?= get_template_part('sections/infoSection'); ?>
    <?= get_template_part('sections/faqSection'); ?>
</main>

<?php get_footer(); ?>

