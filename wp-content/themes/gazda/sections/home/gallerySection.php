<section class="gallery">
    <div class="container">
        <h2 class="gallery-title section-title">
            <?php the_field('gallery_title'); ?>
        </h2>
    </div>
    <div class="swiper gallery-swiper">
        <?php the_field('gallery_list'); ?>
    </div>
    <div class="container">
        <div class="swiper-pagination text-center text-lg-start position-relative text-start"></div>
    </div>
</section>