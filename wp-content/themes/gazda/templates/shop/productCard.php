<?php
$thumbnail_id = $args['thumbnail_id'] ?? null;
?>

<li class="products-list__item position-relative">
    <div class="product-list__wrapper bg-white position-absolute top-0 start-0 rounded-3 overflow-hidden d-flex flex-column w-100">
        <div class="products-list__thumb">
            <?= $thumbnail_id ? wp_get_attachment_image($thumbnail_id, 'full', false, array('class' => '')) : wc_placeholder_img(array('class' => '')); ?>
        </div>
        <div class="product-list__details px-3 pb-3 pt-2 flex-grow-1">
            <h3 class="product-list__title mb-2">
                <?php the_title(); ?>
            </h3>
            <span class="product-list__price mb-1 d-block">
                                <?= get_template_part('templates/price'); ?>
                            </span>
            <button class="product-list__button button-primary w-100 border-0 d-flex align-items-center justify-content-center gap-2"
                    data-product-id="<?= get_the_ID(); ?>">
                <svg class="product-list__icon" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-shopping-cart'); ?>"></use>
                </svg>
                <?= translate_and_output('buy'); ?>
            </button>
            <div class="quantity align-items-center justify-content-center mt-2">
                <button class="quantity__button bg-transparent border-0 p-0 decrement">
                    <svg class="quantity__icon" width="24" height="24">
                        <use href="<?php get_image('sprite.svg#icon-minus'); ?>"></use>
                    </svg>
                </button>
                <span class="quantity__value d-flex align-items-center justify-content-center rounded-3 bg-white">1</span>
                <button class="quantity__button bg-transparent border-0 p-0 increment">
                    <svg class="quantity__icon" width="24" height="24">
                        <use href="<?php get_image('sprite.svg#icon-plus'); ?>"></use>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</li>