<?php
$cart_items = WC()->cart->get_cart();

$product_ids = array();

foreach ($cart_items as $cart_item_key => $cart_item) {
    $product_ids[] = $cart_item['product_id'];
}

$distinct_product_count = count(array_unique($product_ids));
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
        <a class="toolbar__button d-inline-block" href="">
            <svg class="header-icon" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon-user'); ?>"></use>
            </svg>
        </a>
    </div>
    <div class="toolbar__item position-relative">

        <button class="toolbar__button header-card unset">
            <svg class="header-icon" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon-shopping-cart'); ?>"></use>
            </svg>
        </button>

        <?php
        if ($distinct_product_count) {
            ?>
            <span class="card-quantity position-absolute top-0 start-0 text-danger">
                <?= esc_html($distinct_product_count); ?>
            </span>
            <?php
        }
        ?>

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