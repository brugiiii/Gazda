<?php
/*
Template Name: Mykhailov`s Team
*/
?>

<?php get_header(); ?>

<main id="team">
    <?=
    get_template_part('sections/team/heroSection');
    get_template_part('sections/team/vacanciesSection');
    get_template_part('sections/team/ctaSection');
    ?>
</main>

<?php get_footer(); ?>
