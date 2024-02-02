<div class="buy-wrapper d-flex align-items-stretch gap-3">
    <div class="quantity bg-white d-flex align-items-center">
        <div class="quantity-wrapper d-flex align-items-center justify-content-center">
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

    <button class="buy-button button-primary border-0 position-relative" data-product-id="<?= get_the_ID(); ?>">
        <span class="d-flex align-items-center justify-content-center gap-2">
            <svg class="product-list__icon" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon-shopping-cart'); ?>"></use>
            </svg>
            <?= translate_and_output('buy'); ?>
        </span>
        <span class="loader-container position-absolute top-50 start-50 translate-middle">
            <div class="loader">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
            </div>
        </span>
    </button>
</div>
