<?php
//Hooks
add_action('wp_enqueue_scripts', 'enqueue_scripts_and_styles');
add_action('after_setup_theme', 'theme_setup');

//Base
function enqueue_scripts_and_styles()
{
    // Deregister and register jQuery
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//code.jquery.com/jquery-1.11.0.min.js', array(), '1.11.0', false);

    // Register jQuery Migrate
    wp_register_script('jquery-migrate', '//code.jquery.com/jquery-migrate-1.2.1.min.js', array('jquery'), '1.2.1', false);

    // Enqueue main stylesheet
    wp_enqueue_style('main-style', get_template_directory_uri() . '/dist/css/main.bundle.css');

    // Enqueue main script
    wp_enqueue_script('main', get_template_directory_uri() . '/dist/js/main.bundle.js', array('jquery'), null, true);

    // Conditional scripts and styles
    if (is_shop() || is_page_template('woocommerce/archive-product.php') || is_page_template('pages/delivery.php') || is_page_template('pages/search.php') || is_singular('product')) {
        // Enqueue TweenMax for certain pages
        wp_enqueue_script('tween-max', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js', array('jquery'), '2.1.3', true);
    }

    // Home page scripts and styles
    if (is_page_template('pages/home.php')) {
        wp_enqueue_script('home-js', get_template_directory_uri() . '/dist/js/home.bundle.js', array('jquery'), null, true);
        wp_enqueue_style('home-style', get_template_directory_uri() . '/dist/css/home.bundle.css');
    }

    // Restaurant page scripts and styles
    if (is_page_template('pages/restaurant.php')) {
        wp_enqueue_script('restaurant-js', get_template_directory_uri() . '/dist/js/restaurant.bundle.js', array('jquery'), null, true);
        wp_enqueue_style('restaurant-style', get_template_directory_uri() . '/dist/css/restaurant.bundle.css');
    }

    // Shop page scripts and styles
    if (is_shop() || is_page_template('woocommerce/archive-product.php') || is_page_template('pages/delivery.php')) {
        wp_enqueue_style('shop-style', get_template_directory_uri() . '/dist/css/shop.bundle.css');
    }

    if (is_shop() || is_page_template('woocommerce/archive-product.php') || is_page_template('pages/delivery.php')){
        wp_enqueue_script('shop-js', get_template_directory_uri() . '/dist/js/shop.bundle.js', array('jquery'), null, true);
    }

    // Delivery page scripts and styles
    if (is_page_template('pages/delivery.php')) {
        wp_enqueue_script('delivery-js', get_template_directory_uri() . '/dist/js/delivery.bundle.js', array('jquery'), null, true);
        wp_enqueue_style('delivery-style', get_template_directory_uri() . '/dist/css/delivery.bundle.css');
    }

    if (is_page_template('pages/informational.php') || is_page_template('pages/faq.php')) {
        wp_enqueue_script('informational-js', get_template_directory_uri() . '/dist/js/informational.bundle.js', array('jquery'), null, true);
        wp_enqueue_style('informational-style', get_template_directory_uri() . '/dist/css/informational.bundle.css');
    }

    if (is_page_template('pages/event.php')) {
        wp_enqueue_script('event-js', get_template_directory_uri() . '/dist/js/event.bundle.js', array('jquery'), null, true);
        wp_enqueue_style('event-style', get_template_directory_uri() . '/dist/css/event.bundle.css');
    }

    if (is_404()) {
        wp_enqueue_style('error-style', get_template_directory_uri() . '/dist/css/error.bundle.css');
    }

    // Product page scripts and styles
    if (is_singular('product')) {
        wp_enqueue_script('product-js', get_template_directory_uri() . '/dist/js/product.bundle.js', array('jquery'), null, true);
        wp_enqueue_style('product-style', get_template_directory_uri() . '/dist/css/product.bundle.css');
    }

    if(is_page_template('pages/search.php')) {
        wp_enqueue_script('search-js', get_template_directory_uri() . '/dist/js/search.bundle.js', array('jquery'), null, true);
        wp_enqueue_style('search-style', get_template_directory_uri() . '/dist/css/search.bundle.css');
    }

    $current_lang = pll_current_language();

    // Localize main script
    $settings = array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'template_directory_url' => get_template_directory_uri(),
        'wishlist' => translate_and_output('wishlist'),
        'is_search_page' => is_page_template('pages/search.php') ? true : false,
        'is_delivery_page' => is_page_template('pages/delivery.php') ? true : false,
        'search_page_link' => $current_lang === 'uk' ? get_permalink(6613) : get_permalink(6615)
    );
    wp_localize_script('main', 'settings', $settings);
}

function theme_setup()
{
    // Theme setup actions
    show_admin_bar(false);
    register_nav_menu('menu-header', 'Main menu');
    register_nav_menu('menu-footer', 'Footer menu');
    register_nav_menu('menu-burger', 'Burger menu');
    register_nav_menu('menu-restaurant', 'Restaurant menu');
    register_nav_menu('menu-shop', 'Shop menu');
    register_nav_menu('menu-delivery', 'Delivery menu');

    add_theme_support('custom-logo');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

//Includes
require_once get_template_directory() . '/includes/ajaxQueries.php';

require_once get_template_directory() . '/includes/polylangSetup.php';

require_once get_template_directory() . '/includes/customFunctions.php';

require_once get_template_directory() . '/includes/uploadMimes.php';

require_once get_template_directory() . '/includes/changeWooTabs.php';