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

    if(is_page(7462) || is_page(7521)){
        get_template_part('sections/ctaSection');
    }else{
        ?>
        <section id="apps">
            <div class="container">
                <?php get_template_part('templates/appList');?>
            </div>
        </section>
        <?php
    }
    ?>
</main>

<?php get_footer(); ?>

