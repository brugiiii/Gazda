<div class="backdrop is-hidden" id="cart-backdrop">
    <div id="cart-modal" class="cart-modal rounded-start-4 overflow-hidden position-relative">
        <div class="d-flex justify-content-between">
            <h2 class="cart-title fs-5 mb-0">
                <?= translate_and_output("basket"); ?>
            </h2>
            <button class="cart-button unset hide-cart-button-js" type="button">
                <svg class="cart-button__icon" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-close'); ?>"></use>
                </svg>
            </button>
        </div>

        <div class="cart-wrapper position-relative">
            <div id="cart-content">
                <?= get_template_part('templates/cart/content'); ?>
            </div>

            <?= get_template_part('templates/loader'); ?>
        </div>

        <div class="cart-overlay position-absolute top-0 start-0 end-0 bottom-0">
        </div>
    </div>
</div>
