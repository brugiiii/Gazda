<?php
$current_lang = pll_current_language();
$home_post = pll_get_post(16, $current_lang);
$gallery = get_field('gallery_list', $home_post);
?>

<section class="gallery">
    <div class="container">
        <h2 class="gallery-title section-title">
            <?php the_field('gallery_title', $home_post); ?>
        </h2>
    </div>
    <div class="swiper gallery-swiper">
        <ul class="swiper-wrapper">
            <?php
            foreach ($gallery as $image_id) {
                ?>
                <li class="swiper-slide">
                    <?= wp_get_attachment_image($image_id, 'full', false, array('class' => '')); ?>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
    <div class="container">
        <div class="swiper-pagination text-center text-lg-start position-relative text-start"></div>
    </div>
</section>