<?php
$gradient = get_field('hero_gradient');
?>

<section class="hero position-relative d-flex flex-column d-lg-block">
    <?= get_template_part('templates/informational/breadcrumbs'); ?>
    <div class="container my-auto my-lg-0">
        <?= get_template_part('templates/informational/breadcrumbs'); ?>

        <h1 class="hero-title mb-lg-1">
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