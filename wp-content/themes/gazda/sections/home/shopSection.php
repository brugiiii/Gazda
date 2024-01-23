<?php
$image = get_field('shop_image');
?>

<section class="mx-auto position-relative shop">
    <div class="container d-flex flex-column flex-md-row">
        <div class="shop-thumb d-md-none">
            <?php echo wp_get_attachment_image($image['id'], 'full', false, array('class' => 'shop-thumb__image')); ?>
        </div>
        <div class="shop-content align-self-md-center mx-auto mx-md-0 p-lg-0">
            <div class="shop-thumb mx-lg-auto">
                <img src="<?php get_image('sprout.webp'); ?>" alt="Росток в руці">
            </div>
            <h2 class="shop-title section-title">
                <?php the_field('shop_title'); ?>
            </h2>
            <p class="shop-text">
                <?php the_field('shop_text'); ?>
            </p>
            <a href="" class="shop-button button-secondary d-flex align-items-center justify-content-center gap-2">
                <?= translate_and_output('view_products'); ?>
                <svg class="shop-button__icon" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-shopping-cart'); ?>"></use>
                </svg>
            </a>
        </div>
    </div>
</section>

<style>
    .shop::after {
        background-image: url(<?php echo $image['url']; ?>);
    }
</style>
