<?php
$wishlist_count = YITH_WCWL()->count_products();
$wishlist_url = YITH_WCWL()->get_wishlist_url();
$current_lang = pll_current_language();
$post = pll_get_post(34, $current_lang);

$menu_items_hierarchy = process_menu_items_hierarchy();
?>
<section class="section menu overflow-visible">
    <?= get_template_part('sections/restaurant/navigation'); ?>
    <div class="container">
        <div class="breadcrumb d-none d-lg-block">
            <?= get_the_title($post); ?>
            <?= get_template_part('helpers/separator'); ?>
            <?= translate_and_output('menu'); ?>
            <?= get_template_part('helpers/separator'); ?>
            <span class="menu-item current"></span>
        </div>
        <div class="d-lg-flex align-items-lg-start menu-wrapper">
            <div class="navigation px-3 pb-3 d-none d-lg-block">
                <h1 class="navigation__title fw-semibold text-uppercase">
                    <?= translate_and_output('menu'); ?>
                </h1>
                <a class="wishlist-link align-items-center <?= $wishlist_count == 0 ? 'is-hidden' : ''; ?>"
                   href="<?php echo esc_url($wishlist_url); ?>">
                    <svg class="wishlist-link__icon" width="16" height="17">
                        <use href="<?php get_image('sprite.svg#icon-heart-full'); ?>"></use>
                    </svg>
                    <?= translate_and_output('wishlist'); ?>
                    (<span class="wishlist-link__count"><?= esc_html($wishlist_count); ?></span>)
                </a>
                <?php get_template_part('templates/restaurant/navigation'); ?>
            </div>
            <div class="menu-content flex-grow-1 px-3 pb-3">
                <?= get_template_part('templates/restaurant/productsList'); ?>
            </div>
        </div>
    </div>
</section>
