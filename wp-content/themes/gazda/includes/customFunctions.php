<?php
function process_menu_items_hierarchy()
{
    $menu_locations = get_nav_menu_locations();
    $menu_id = $menu_locations['menu-restaurant'];
    $menu_items = wp_get_nav_menu_items($menu_id, array('order' => 'ASC'));

    $menu_items_hierarchy = array();

    foreach ($menu_items as $menu_item) {
        $category_id = get_post_meta($menu_item->ID, '_menu_item_object_id', true);
        $category = get_term($category_id, 'product_cat');

        if ($category->parent == 0) {
            $menu_items_hierarchy[$category->term_id] = array(
                'menu_item' => $menu_item,
                'children' => array(),
            );
        } else {
            $parent_id = $category->parent;
            if (!isset($menu_items_hierarchy[$parent_id])) {
                $menu_items_hierarchy[$parent_id] = array(
                    'menu_item' => null,
                    'children' => array(),
                );
            }

            $menu_items_hierarchy[$parent_id]['children'][] = array(
                'menu_item' => $menu_item,
                'category' => $category,
            );
        }
    }

    uasort($menu_items_hierarchy, function ($a, $b) {
        return $a['menu_item']->menu_order - $b['menu_item']->menu_order;
    });

    return $menu_items_hierarchy;
}

function get_image($name)
{
    echo get_template_directory_uri() . "/assets/images/" . $name;
}