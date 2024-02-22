<?php
$gradient = get_field('hero_gradient');
?>

<section class="hero">
    <div class="container">
        <?= get_template_part('templates/informational/breadcrumbs'); ?>

        <h1 class="hero-title mb-lg-1 text-uppercase">
            <?= the_field('hero_title'); ?>
        </h1>
        <p class="hero-text">
            <?= the_field('hero_text'); ?>
        </p>
        <a class="button-secondary text-center d-inline-block" href="#cta">
            <?= the_field('hero_button'); ?>
        </a>
    </div>
</section>

<style>
    .hero {
        background-image: <?= $gradient ? 'linear-gradient(0deg, rgba(0, 0, 0, 0.65) 0%, rgba(0, 0, 0, 0.65) 100%), ' : ''; ?> url(<?php the_field('hero_bg'); ?>);
    }
</style>