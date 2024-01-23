<div class="hero-wrapper mx-auto position-relative">
    <div class="hero-swiper swiper">
        <ul class="swiper-wrapper hero-list">
            <li class="swiper-slide hero-list__item text-center">
                <h2 class="hero-list__title mb-0 ">
                    <?php the_field('hero_swiper_slide1_title'); ?>
                </h2>
                <p class="hero-list__text ">
                    <?php the_field('hero_swiper_slide1_text'); ?>
                </p>
                <button class="hero-list__button button-primary border-0">
                    <?= translate_and_output('reserve'); ?>
                </button>
            </li>
            <li class="swiper-slide hero-list__item text-center">
                <h2 class="hero-list__title mb-0 ">
                    <?php the_field('hero_swiper_slide2_title'); ?>
                </h2>
                <p class="hero-list__text ">
                    <?php the_field('hero_swiper_slide2_text'); ?>
                </p>
                <button class="hero-list__button button-primary border-0">
                    <?= translate_and_output('reserve'); ?>
                </button>
            </li>
            <li class="swiper-slide hero-list__item text-center">
                <h2 class="hero-list__title mb-0 ">
                    <?php the_field('hero_swiper_slide3_title'); ?>
                </h2>
                <p class="hero-list__text ">
                    <?php the_field('hero_swiper_slide3_text'); ?>
                </p>
                <button class="hero-list__button button-primary border-0">
                    <?= translate_and_output('reserve'); ?>
                </button>
            </li>
        </ul>
    </div>
    <?php get_template_part('templates/ctrls.php'); ?>
</div>