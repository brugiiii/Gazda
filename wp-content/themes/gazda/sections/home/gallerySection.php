<?php
$gallery = get_field('gallery_list');
?>

<section class="gallery">
    <div class="container">
        <h2 class="gallery-title section-title">
            <?php the_field('gallery_title'); ?>
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