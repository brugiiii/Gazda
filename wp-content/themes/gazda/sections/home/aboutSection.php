<?php
$image_id = get_field('about_image');
?>

<section class="about">
    <div class="container">
        <div class="about-wrapper d-flex flex-column flex-lg-row">
            <div class="about-thumb overflow-hidden flex-lg-shrink-0">
                <?php echo wp_get_attachment_image($image_id, 'full', false, array('class' => 'about-thumb__image')); ?>
            </div>
            <div class="about-content align-self-lg-center">
                <h2 class="about-title section-title mb-lg-2 mb-3">
                    <?php the_field('about_title'); ?>
                </h2>
                <?php the_field('about_text'); ?>
                <a href="" class="d-flex gap-2 align-items-center justify-content-center button-secondary about-button">
                    <?= translate_and_output('go_over'); ?>
                    <svg class="about-button__icon" width="24" height="24">
                        <use href="<?php get_image('sprite.svg#icon-caret-right'); ?>"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
