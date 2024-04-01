<?php
$is_gradient_visible = get_field('gradient');
?>

<section class="hero text-white position-relative">
    <?= get_template_part('templates/breadcrumbs'); ?>
    <div class="container d-flex align-items-center">
        <?= get_template_part('templates/breadcrumbs'); ?>
        <div>
            <h1 class="hero-title title mb-1">
                <?= the_field('hero_title'); ?>
            </h1>
            <p class="hero-text mb-0">
                <?= the_field('hero_text'); ?>
            </p>
        </div>
    </div>
</section>

<style>
    .hero {
        background-image: <?= $is_gradient_visible ? 'linear-gradient(to bottom, rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)),' : ''; ?> url(<?= get_field('hero_bg'); ?>);
    }
</style>