<?php
// Отримати поточну мову
$current_language = pll_current_language();

// Виберіть ім'я меню
$menu_name = $current_language === 'uk' ? 'menu-shop' : 'menu-shop-eng';

// Отримання обєкту меню
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object($locations[$menu_name]);

// Отримання елементів меню
$menu_items = wp_get_nav_menu_items($menu->term_id);
?>
<ul class="products-nav">
    <li class="products-nav__item">
        <button class="products-nav__button d-block bg-transparent p-0 w-100 border-0 text-start" data-category-id="-1">
            <?= translate_and_output('all_products'); ?>
        </button>
    </li>
    <?php
    foreach ($menu_items as $menu_item) {
        $category_id = get_post_meta($menu_item->ID, '_menu_item_object_id', true);

        ?>
        <li class="products-nav__item">
            <button class="products-nav__button d-block bg-transparent p-0 w-100 border-0 text-start" data-category-id="<?php echo esc_attr($category_id); ?>">
                <?= get_term($category_id)->name; ?>
            </button>
        </li>
        <?php
    }
    ?>
</ul>
