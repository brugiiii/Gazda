<?php
add_action('wp_enqueue_scripts', 'enqueue_scripts_and_styles');
add_action('after_setup_theme', 'theme_setup');
add_filter('upload_mimes', 'svg_upload_allow');
add_action('wpcf7_before_send_mail', 'send_message_to_telegram');
add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5);
add_action('wp_ajax_get_wishlist_count', 'get_wishlist_count_ajax');
add_action('wp_ajax_nopriv_get_wishlist_count', 'get_wishlist_count_ajax');

function enqueue_scripts_and_styles() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//code.jquery.com/jquery-1.11.0.min.js');
    wp_register_script('jquery-migrate', '//code.jquery.com/jquery-migrate-1.2.1.min.js');

    wp_enqueue_style('main-style', get_template_directory_uri() . '/dist/css/main.bundle.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('main-js', get_template_directory_uri() . '/dist/js/main.bundle.js', array('jquery'), null, true);

    $current_lang = pll_current_language();

    if (is_page(16) || is_page(23)) {
        wp_enqueue_script('home-js', get_template_directory_uri() . '/dist/js/home.bundle.js', array('jquery'), null, true);
        wp_enqueue_style('home-style', get_template_directory_uri() . '/dist/css/home.bundle.css');
    }

    if (is_page(34) || is_page(6339)) {
        wp_enqueue_script('restaurant-js', get_template_directory_uri() . '/dist/js/restaurant.bundle.js', array('jquery'), null, true);
        wp_enqueue_style('restaurant-style', get_template_directory_uri() . '/dist/css/restaurant.bundle.css');
    }

    if (is_shop() || is_page(6357)) {
        wp_enqueue_script('shop-js', get_template_directory_uri() . '/dist/js/shop.bundle.js', array('jquery'), null, true);
        wp_enqueue_style('shop-style', get_template_directory_uri() . '/dist/css/shop.bundle.css');
    }

    $settings = array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'template_directory_url' => get_template_directory_uri(),
        'wishlist' => translate_and_output('wishlist')
    );

    wp_localize_script('main-js', 'settings', $settings);
}

function theme_setup()
{
    show_admin_bar(false);
    register_nav_menu('menu-header', 'Main menu');
    register_nav_menu('menu-footer', 'Footer menu');
    register_nav_menu('menu-burger', 'Burger menu');
    register_nav_menu('menu-restaurant', 'Restaurant menu');
    register_nav_menu('menu-shop', 'Shop menu');

    add_theme_support('custom-logo');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

function get_image($name)
{
    echo get_template_directory_uri() . "/assets/images/" . $name;
}

function translate_and_output($string_key, $group = 'Main Page')
{
    global $strings_to_translate;

    if (function_exists('pll__')) {
        return pll__($strings_to_translate[$string_key], $group);
    } else {
        return $strings_to_translate[$string_key];
    }
}

$strings_to_translate = array(
    'reserve' => 'Резерв столу',
    'signin' => 'Увійти',
    'go_over' => "Перейти",
    'view_products' => 'Переглянути товари',
    'copyright' => '&#169;2022',
    'address' => 'Адреса',
    'number' => 'Телефон',
    'policy' => 'Політика сайту',
    'cookies' => 'Cookies',
    'socials' => 'Ми в соц. мережах:',
    'app' => 'Спробуйте наш додаток',
    'ingredients' => 'Інгрідієнти',
    'allergens' => 'Алергени',
    'garlic' => 'часник',
    'nuts' => 'горіхи',
    'gluten' => 'глютен',
    'lactose' => 'лактоза',
    'menu' => 'Меню',
    'wishlist' => 'Обране',
    'categories' => 'Категорії',
    'all_products' => 'Усі товари',
    'filter' => 'Фільтр',
    'low_to_high' => 'Від дешевих до дорогих',
    'high_to_low' => 'Від дорогих до дешевих'
);

if (function_exists('pll_register_string')) {
    foreach ($strings_to_translate as $string_key => $string_value) {
        pll_register_string($string_key, $string_value, 'Main Page');
    }
}

function get_wishlist_count_ajax()
{
    $wishlist_count = YITH_WCWL()->count_products();
    echo json_encode(array('wishlist_count' => $wishlist_count));
    wp_die();
}

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

function send_message_to_telegram($contact_form)
{
    $form_id = $contact_form->id();
    $telegram_token = '';
    $chat_id = '';
    $message = '';

    if ($form_id === 'formId') {

        $submission = WPCF7_Submission::get_instance();
        if ($submission) {
            $posted_data = $submission->get_posted_data();
            $message .= '<b>Контактные данные клиента:</b>' . PHP_EOL;
            $message .= PHP_EOL;
            $message .= '<b>Номер телфона:</b> ' . $posted_data['number'] . PHP_EOL;
            $message .= PHP_EOL;
        }
    } elseif ($form_id === 'formId') {

        $submission = WPCF7_Submission::get_instance();
        if ($submission) {
            $posted_data = $submission->get_posted_data();
            $message .= '<b>Контактные данные клиента:</b>' . PHP_EOL;
            $message .= PHP_EOL;
            $message .= '<b>Номер телфона:</b> ' . $posted_data['number'] . PHP_EOL;
            $message .= PHP_EOL;
        }
    }

    if (!empty($telegram_token) && !empty($chat_id) && !empty($message)) {
        $url = 'https://api.telegram.org/bot' . $telegram_token . '/sendMessage';
        $params = array(
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'HTML'
        );

        $query_string = http_build_query($params);
        $request_url = $url . '?' . $query_string;
        wp_remote_get($request_url);
    }
}

function svg_upload_allow($mimes)
{
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}

function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = '')
{

    if (version_compare($GLOBALS['wp_version'], '5.1.0', '>=')) {
        $dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
    } else {
        $dosvg = ('.svg' === strtolower(substr($filename, -4)));
    }

    if ($dosvg) {

        if (current_user_can('manage_options')) {

            $data['ext'] = 'svg';
            $data['type'] = 'image/svg+xml';
        } else {
            $data['ext'] = false;
            $data['type'] = false;
        }
    }

    return $data;
}


