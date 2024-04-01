<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

<main id="home">
    <?php get_template_part('sections/home/heroSection'); ?>
    <?php get_template_part('sections/home/aboutSection'); ?>
    <?php get_template_part('sections/home/shopSection'); ?>
    <?php get_template_part('sections/home/reviewsSection'); ?>
    <?php get_template_part('sections/home/appSection'); ?>
    <?php get_template_part('sections/home/gallerySection'); ?>
    <?php get_template_part('sections/home/contactsSection'); ?>
</main>

<?php get_footer(); ?>

