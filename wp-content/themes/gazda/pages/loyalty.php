<?php
/*
Template Name: Loyalty
*/
?>

<?php get_header(); ?>

<main id="loyalty">
    <?=
    get_template_part('sections/about/heroSection');
    get_template_part('sections/loyalty/stepsSection');
    get_template_part('sections/ctaSection');
    ?>
</main>

<?php get_footer(); ?>

