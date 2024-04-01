<?php
/*
Template Name: Event
*/
?>

<?php get_header(); ?>

<main id="event">
    <?= get_template_part('sections/event/heroSection'); ?>
    <?= get_template_part('sections/event/aboutSection'); ?>
    <?= get_template_part('sections/event/benefitsSection'); ?>
    <?= get_template_part('sections/ctaSection'); ?>
</main>

<?php get_footer(); ?>

