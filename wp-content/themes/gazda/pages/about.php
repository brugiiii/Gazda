<?php
/*
Template Name: About
*/
?>

<?php get_header(); ?>

<main id="about">
    <?=
    get_template_part('sections/about/heroSection');
    get_template_part('sections/about/aboutSection');
    get_template_part('sections/about/teamSection');
    get_template_part('sections/home/gallerySection');
    ?>
</main>

<?php get_footer(); ?>

