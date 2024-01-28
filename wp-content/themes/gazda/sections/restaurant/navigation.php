<?php
$wishlist_count = YITH_WCWL()->count_products();
$wishlist_url = YITH_WCWL()->get_wishlist_url();
$current_lang = pll_current_language();
$post = pll_get_post(34, $current_lang);

$menu_items_hierarchy = process_menu_items_hierarchy();
?>

<div class="navigation-mob d-lg-none position-sticky top-0 mb-3">
    <div class="menu-breadcrumb px-3 d-lg-none">
        <?= get_the_title($post); ?>
        /
        <?= translate_and_output('menu'); ?>
        /
        <span class="menu-item"></span>
    </div>
    <div class="navigation-mob__wrapper d-flex align-items-end ps-3 pt-1">
        <a class="wishlist-link align-items-center py-2 me-3 flex-shrink-0 <?= $wishlist_count == 0 ? 'is-hidden' : ''; ?>"
           href="<?php echo esc_url($wishlist_url); ?>">
            <svg class="wishlist-link__icon me-1" width="20" height="20">
                <use href="<?php get_image('sprite.svg#icon-heart'); ?>"></use>
            </svg>
            <?= translate_and_output('wishlist') . ':'; ?>
            (<span class="wishlist-link__count"><?= esc_html($wishlist_count); ?></span>)
        </a>
        <div class="swiper parent-swiper">
            <ul class="swiper-wrapper">
                <?php foreach ($menu_items_hierarchy as $parent_category) : ?>
                    <?php $parent_menu_item = $parent_category['menu_item']; ?>
                    <?php $parent_category_term = get_term($parent_menu_item->object_id, 'product_cat'); ?>

                    <?php if (!empty($parent_category_term->name)) : ?>
                        <li class="swiper-slide" data-id="<?= $parent_category_term->term_id; ?>">
                            <div class="parent-swiper__wrapper text-uppercase p-2">
                                <?= $parent_category_term->name; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="swiper child-swiper py-2 px-3">
        <ul class="swiper-wrapper">
            <?php foreach ($menu_items_hierarchy as $parent_category) : ?>
                <?php foreach ($parent_category['children'] as $child_data) : ?>
                    <?php $child_category = $child_data['category']; ?>
                    <li class="swiper-slide" data-category-slug="<?= esc_attr($child_category->slug); ?>" data-parent-id="<?= esc_attr($child_category->parent); ?>">
                        <a href="#<?= esc_attr($child_category->slug); ?>" class="d-inline-block child-swiper__wrapper"">
                        <?= esc_html($child_category->name); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>