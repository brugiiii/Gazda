<?php
$product = wc_get_product(get_the_ID());
$is_in_stock = $product->is_in_stock();
$short_description = $product->get_short_description();
$price = $product->get_price();
?>

<section class="section">
    <div class="container">
        <?= get_template_part('templates/single-product/breadcrumbs'); ?>
        <div class="d-lg-flex justify-content-between">
            <div class="hero-gallery">
                <?= get_template_part('templates/single-product/gallery'); ?>
            </div>
            <div class="hero-info">
                <h1 class="hero-title mb-2">
                    <?= the_title(); ?>
                </h1>

                <?= get_template_part('templates/single-product/is-in-stock', null, array('is_in_stock' => $is_in_stock)); ?>

                <div class="hero-description">
                    <?= wpautop($short_description); ?>
                </div>

                <span class="hero-price d-block">
                   <?= get_template_part('templates/single-product/price'); ?>
                </span>

                <?= get_template_part('templates/single-product/attributes'); ?>

                <?= get_template_part('templates/single-product/buy'); ?>

                <?= get_template_part('templates/single-product/features'); ?>
            </div>
        </div>
    </div>
</section>
