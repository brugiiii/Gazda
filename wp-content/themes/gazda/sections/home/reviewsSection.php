<section class="reviews">
    <div class="container">
        <h2 class="section-title reviews-title text-center">
            <?php the_field('reviews_title'); ?>
        </h2>
        <?php do_action('wprev_tripadvisor_plugin_action', 1); ?>
        <div class="swiper-pagination position-relative d-lg-none"></div>
    </div>
</section>