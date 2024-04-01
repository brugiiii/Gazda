<?php
$menu_locations = get_nav_menu_locations();
$menu_items = wp_get_nav_menu_items($menu_locations['menu-restaurant']);

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
                                class="nav-list__button<?= ($index === 0) ? ' active' : ''; ?>">
                            <?= esc_html($menu_item->title); ?>
                        </button>
                        <?php
                    } else {
                        $category_id = get_post_meta($menu_item->ID, '_menu_item_object_id', true);
                        $category = get_term($category_id, 'product_cat');
                        $category_slug = $category->slug;
                        ?>
                        <a href="#<?= $category_slug; ?>">
                            <?= esc_html($menu_item->title); ?>
                        </a>
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
                                    $child_category_slug = $child_category->slug;
                                    ?>
                                    <a class="sub-menu__link position-relative" href="#<?= $child_category_slug; ?>">
                                        <?= esc_html($child->title); ?>
                                    </a>
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
?>
