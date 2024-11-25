<?php
$is_swiper = $args['is_swiper'] ?? false;
$page = $args['page'] ?? 'shop';
$current_language = pll_current_language();
$menu_name = ($page === 'shop' ? 'menu-shop' : 'menu-delivery');
$menu_items = wp_get_nav_menu_items(get_nav_menu_locations()[$menu_name] ?? null);

if ($page === 'shop') {
    $category_ids = $category_names = [];
    if ($menu_items) {
        foreach ($menu_items as $menu_item) {
            $category_ids[] = get_post_meta($menu_item->ID, '_menu_item_object_id', true);
            $category_names[] = get_term($menu_item->object_id)->name;
        }
    }
    ?>
    <ul class="products-nav <?= $is_swiper ? 'd-flex pe-3 overflow-x-auto' : ''; ?>">
        <li class="products-nav__item">
            <button class="products-nav__button category-button d-block border-0 <?= $is_swiper ? 'h-100 swiper-button-js' : ''; ?>"
                    data-category-id="<?= implode(', ', $category_ids); ?>">
                <?= translate_and_output('all_products'); ?>
            </button>
        </li>
        <?php if (!empty($category_ids) && !empty($category_names)) {
            foreach (array_combine($category_ids, $category_names) as $category_id => $category_name) { ?>
                <li class="products-nav__item">
                    <?php

                    ?>
                    <button class="products-nav__button category-button d-block border-0  <?= $is_swiper ? 'h-100 swiper-button-js' : ''; ?>"
                            data-category-id="<?= esc_attr($category_id); ?>">
                        <?= esc_html($category_name); ?>
                    </button>
                </li>
            <?php }
        } ?>
    </ul>
<?php } else {
    if ($is_swiper && $menu_items) { ?>
        <div class="ps-3">
            <ul class="parent-swiper d-flex gap-2 pe-3 overflow-x-auto">
                <?php foreach ($menu_items as $menu_item) {
                    $children = array_filter($menu_items, function ($item) use ($menu_item) {
                        return $item->menu_item_parent == $menu_item->ID;
                    });
                    if (!empty($children)) { ?>
                        <li class="parent-swiper__item">
                            <button type="button"
                                    class="parent-swiper__button category-button pt-2 px-2 border-top-0 border-end-0 border-start-0 text-uppercase bg-transparent"
                                    data-parent-category-id="<?= esc_attr($menu_item->object_id); ?>">
                                <?= esc_html($menu_item->title); ?>
                            </button>
                        </li>
                    <?php }
                } ?>
            </ul>
        </div>
        <div class="d-flex ps-3">
            <button type="button" class="categories-button p-2 border-0 rounded-3">
                <svg class="categories-button__icon" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-category'); ?>"></use>
                </svg>
            </button>
            <?php
            $is_first = true;
            foreach ($menu_items as $menu_item) {

                $has_children = false;
                foreach ($menu_items as $child_item) {
                    if ($child_item->menu_item_parent == $menu_item->ID) {
                        $has_children = true;
                        break;
                    }
                }

                if ($has_children) { ?>
                    <ul class="child-swiper <?= $is_first ? 'visible' : 'hidden'; ?> pe-3 overflow-x-auto">
                        <?php
                        foreach ($menu_items as $child_item) {
                            if ($child_item->menu_item_parent == $menu_item->ID) { ?>
                                <li class="child-swiper__item">
                                    <button type="button" class="child-swiper__button category-button h-100 border-0"
                                            data-category-id="<?= esc_attr($child_item->object_id); ?>"
                                            data-parent-category-id="<?= esc_attr($menu_item->object_id); ?>">
                                        <?= esc_html($child_item->title); ?>
                                    </button>
                                </li>
                            <?php }
                        }
                        ?>
                    </ul>
                    <?php
                    $is_first = false;
                }
            }
            ?>
        </div>

    <?php } else {
        if ($menu_items) { ?>
            <ul class="nav-list">
                <?php $current_parent = 0;
                foreach ($menu_items as $index => $menu_item) {
                    if ($menu_item->menu_item_parent == $current_parent) { ?>
                        <li class="nav-list__item">
                            <?php $children = array_filter($menu_items, function ($item) use ($menu_item) {
                                return $item->menu_item_parent == $menu_item->ID;
                            });
                            if (!empty($children)) { ?>
                                <button type="button"
                                        class="nav-list__button bg-transparent border-0 p-0 w-100 text-start <?= ($index === 0) ? ' is-active' : ''; ?>">
                                    <?= esc_html($menu_item->title); ?>
                                </button>
                            <?php }
                            if (!empty($children)) { ?>
                                <ul class="sub-menu">
                                    <?php foreach ($children as $childIndex => $child) { ?>
                                        <li class="sub-menu__item">
                                            <?php $child_category_id = get_post_meta($child->ID, '_menu_item_object_id', true);
                                            $child_category = get_term($child_category_id, 'product_cat'); ?>
                                            <button class="sub-menu__button category-button d-flex align-items-center gap-1 px-0 border-0 text-start bg-transparent"
                                                    type="button" data-category-id="<?= $child_category_id; ?>"
                                                    data-parent-category-id="<?= $menu_item->object_id; ?>">
                                                <?= esc_html($child->title); ?>
                                            </button>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php }
                } ?>
            </ul>
        <?php }
    }
} ?>