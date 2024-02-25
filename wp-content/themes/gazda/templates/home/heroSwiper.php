<?php
$swiper = get_field('swiper');
?>

<div class="hero-wrapper mx-auto position-relative">
    <div class="hero-swiper swiper">
        <ul class="swiper-wrapper hero-list">
            <?php
            foreach ($swiper as $slide){
                ?>
                <li class="swiper-slide hero-list__item text-center">
                    <h2 class="hero-list__title mb-0 ">
                        <?= $slide['title']; ?>
                    </h2>
                    <p class="hero-list__text ">
                        <?= $slide['text']; ?>
                    </p>
                    <button class="hero-list__button button-primary border-0">
                        <?= translate_and_output('reserve'); ?>
                    </button>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
    <?php get_template_part('templates/ctrls'); ?>
</div>