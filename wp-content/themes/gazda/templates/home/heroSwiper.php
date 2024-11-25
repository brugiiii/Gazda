<?php
$swiper = get_field('swiper');
?>

<div class="hero-wrapper mx-auto position-relative h-100 w-100" style="max-width: none;">
    <div class="hero-swiper swiper h-100 w-100">
        <ul class="swiper-wrapper hero-list h-100 w-100">
            <?php
            foreach ($swiper as $slide){
                ?>
                <li class="swiper-slide hero-list__item text-center h-100 w-100">
                    <div class="swiper-slide__wraper h-100 d-flex justify-content-center align-items-center " style="background-image: url('<?php echo $slide['background_image']; ?>'); background-size: cover; background-position: center;">
                    <div class="contnent">
                        <h2 class="hero-list__title mb-0 ">
                            <?= $slide['title']; ?>
                        </h2>
                        <p class="hero-list__text m-0 w-100" style="padding: 0 3rem; box-sizing: border-box">
                            <?= $slide['text']; ?>
                        </p>



                        <a href="<?php echo $slide['hero-swiper_page_link']?>" <?php
                        if ($slide['target_taxonomy']) {
                            echo 'data-taxonomy="' . esc_attr($slide['target_taxonomy'][0]) . '"';
                        } ?>
                           class="hero-list__button button-primary border-0">
                            <span>

                            <?php
                            if (pll_current_language() === 'uk') {
                                echo 'Позерай';
                            } else {
                                echo translate_and_output('reserve');
                            }
                            ?>
                            </span>
                        </a>
                    </div>

                    </div>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>

    <?php get_template_part('templates/ctrls'); ?>
</div>

