<?php
$products_count = WC()->cart->get_cart_contents_count();
$is_logged_in =  is_user_logged_in();
?>

<div class="toolbar d-flex align-items-center gap-2 gap-xl-3">
    <div class="toolbar__item d-none d-sm-block">
        <button type="button" class="toolbar__button header-search unset">
            <svg class="header-icon" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon-search'); ?>"></use>
            </svg>
        </button>
    </div>
    <div class="toolbar__item d-none d-sm-block">
        <?= $is_logged_in ? '<a href="' . get_permalink(pll_get_post(6840, pll_current_language())) . '" class="toolbar__button d-inline-block">' : '<button type="button" class="toolbar__button d-inline-block border-0 bg-transparent auth-button-js">'; ?>
        <svg class="header-icon" width="24" height="24">
            <use href="<?php get_image('sprite.svg#icon-user'); ?>"></use>
        </svg>
        <?= $is_logged_in ? '</a>' : '</button>'; ?>

    </div>
    <div class="toolbar__item position-relative" id="cart">
        <?= do_shortcode('[xoo_wsc_cart]'); ?>
    </div>
    <div class="toolbar__item d-none d-sm-block">
        <button class="toolbar__switcher d-flex align-items-center gap-2 unset">
            <?php get_template_part('templates/languageSwitcher'); ?>
            <svg class="header-icon" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon-caret-down'); ?>"></use>
            </svg>
        </button>
    </div>
</div>