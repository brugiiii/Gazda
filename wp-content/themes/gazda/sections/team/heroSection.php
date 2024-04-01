<?php
$logo_id = get_field('hero_logo');
$image_id = get_field('hero_image');
?>

<section class="section hero position-relative">
    <div class="container">
        <h1 class="visually-hidden">
            <?php the_title(); ?>
        </h1>
        <div class="hero-wrapper d-lg-flex">
            <div class="hero-logo">
                <?= wp_get_attachment_image($logo_id, 'full', false, array('class' => 'hero-logo__image')); ?>
            </div>
            <div class="hero-thumb-wrapper position-relative">
                <div class="hero-thumb">
                    <?= wp_get_attachment_image($image_id, 'full', false, array('class' => '')); ?>
                </div>
                <p class="hero-text bg-white mb-0 fw-semibold">
                    <?= the_field('hero_text'); ?>
                </p>
            </div>
        </div>
    </div>
    <img class="hero-bg position-absolute d-none d-xl-block" src="<?= get_image('arrow-zig-zag.svg'); ?>" alt="arrow">
</section>