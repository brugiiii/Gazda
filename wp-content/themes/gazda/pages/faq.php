<?php
/*
Template Name: FAQ
*/
?>

<?php get_header(); ?>

<main>
    <section class="section">
        <div class="container">
            <?= get_template_part('templates/informational/breadcrumbs'); ?>
        </div>
        <div class="container">
            <h1 class="mb-3 text-uppercase">
                <?= the_title(); ?>
            </h1>
            <?= get_template_part('templates/shop/faqList'); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>

