<?php
$is_swiper = $args['is_swiper'] ?? false;
$page = $args['page'] ?? 'shop';

$current_language = pll_current_language();

if ($page === 'shop') {
    $menu_name = ($current_language === 'uk') ? 'menu-shop' : 'menu-shop-eng';

    $locations = get_nav_menu_locations();
    $menu_id = $locations[$menu_name] ?? null;

    if ($menu_id) {
        $menu = wp_get_nav_menu_object($menu_id);
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $category_ids = array_map(function ($menu_item) {
            return get_post_meta($menu_item->ID, '_menu_item_object_id', true);
        }, $menu_items);

        $category_names = array_map(function ($category_id) {
            return get_term($category_id)->name;
        }, $category_ids);
    }
    ?>

    <ul class="products-nav <?= $is_swiper ? 'swiper-wrapper' : ''; ?>">
        <li class="products-nav__item <?= $is_swiper ? 'swiper-slide' : ''; ?>">
            <button class="products-nav__button d-block border-0"
                    data-categories-ids="<?= implode(' ', $category_ids); ?>">
                <?= translate_and_output('all_products'); ?>
            </button>
        </li>
        <?php
        if (isset($category_ids) && isset($category_names)) {
            foreach (array_combine($category_ids, $category_names) as $category_id => $category_name) {
                ?>
                <li class="products-nav__item <?= $is_swiper ? 'swiper-slide' : ''; ?>">
                    <button class="products-nav__button d-block border-0"
                            data-category-id="<?= esc_attr($category_id); ?>">
                        <?= esc_html($category_name); ?>
                    </button>
                </li>
                <?php
            }
        }
        ?>
    </ul>
    <?php
} else {
    $menu_locations = get_nav_menu_locations();

    $menu_name = ($current_language === 'uk') ? 'menu-delivery' : 'menu-delivery-eng';
    $menu_items = wp_get_nav_menu_items($menu_locations[$menu_name]);

    if ($menu_items) {
        ?>
        <ul class="nav-list">
            <?php
            $current_parent = 0;

            foreach ($menu_items as $index => $menu_item) {
                if ($menu_item->menu_item_parent == $current_parent) {
                    ?>
                    <li class="nav-list__item">
                        <?php
                        $children = array_filter($menu_items, function ($item) use ($menu_item) {
                            return $item->menu_item_parent == $menu_item->ID;
                        });

                        if (!empty($children)) {
                            ?>
                            <button type="button"
                                    class="nav-list__button bg-transparent border-0 p-0 w-100 text-start <?= ($index === 0) ? ' is-active' : ''; ?>"
                                    data-category-id="<?= esc_attr($menu_item->object_id); ?>">
                                <?= esc_html($menu_item->title); ?>
                            </button>
                            <?php
                        }

                        if (!empty($children)) {
                            ?>
                            <ul class="sub-menu">
                                <?php foreach ($children as $childIndex => $child) { ?>
                                    <li class="sub-menu__item">
                                        <?php
                                        $child_category_id = get_post_meta($child->ID, '_menu_item_object_id', true);
                                        $child_category = get_term($child_category_id, 'product_cat');
                                        ?>
                                        <button class="sub-menu__button bg-transparent border-0 position-relative pe-0 w-100 text-start"
                                                type="button" data-category-id="<?= $child_category_id; ?>" data-parent-category-id="<?= esc_attr($menu_item->object_id); ?>">
                                            <?= esc_html($child->title); ?>
                                        </button>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <?php
    }
}
