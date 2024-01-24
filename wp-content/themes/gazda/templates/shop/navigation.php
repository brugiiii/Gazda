<?php
$current_language = pll_current_language();
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

<ul class="products-nav">
    <li class="products-nav__item">
        <button class="products-nav__button d-block bg-transparent p-0 w-100 border-0 text-start" data-categories-ids="<?= implode(' ', $category_ids); ?>">
            <?= translate_and_output('all_products'); ?>
        </button>
    </li>
    <?php
    if (isset($category_ids) && isset($category_names)) {
        foreach (array_combine($category_ids, $category_names) as $category_id => $category_name) {
            ?>
            <li class="products-nav__item">
                <button class="products-nav__button d-block bg-transparent p-0 w-100 border-0 text-start" data-category-id="<?= esc_attr($category_id); ?>">
                    <?= esc_html($category_name); ?>
                </button>
            </li>
            <?php
        }
    }
    ?>
</ul>