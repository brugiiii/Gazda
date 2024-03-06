<section class="position-relative app overflow-visible">
    <div class="container">
        <div class="app-wrapper d-flex">
            <div class="app-content align-self-lg-center">
                <h2 class="app-title section-title">
                    <?php the_field('app_title'); ?>
                </h2>
                <?php the_field('app_text'); ?>
                <?php get_template_part('templates/appList'); ?>
            </div>
        </div>
    </div>
    <img class="vertical d-none d-lg-block" src="<?php get_image('vertical.webp'); ?>" alt="">
</section>

<style>
    .app-wrapper {
        background-image: url(<?php the_field('app_mockup_front'); ?>), url(<?php the_field('app_mockup_back'); ?>);
    }
</style>