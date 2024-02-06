<?php
//Hooks
add_action('wp_enqueue_scripts', 'enqueue_scripts_and_styles');
add_action('after_setup_theme', 'theme_setup');

//Base
function enqueue_scripts_and_styles() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//code.jquery.com/jquery-1.11.0.min.js');
    wp_register_script('jquery-migrate', '//code.jquery.com/jquery-migrate-1.2.1.min.js');

    wp_enqueue_style('main-style', get_template_directory_uri() . '/dist/css/main.bundle.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('main', get_template_directory_uri() . '/dist/js/main.bundle.js', array('jquery'), null, true);

    if (is_page_template('pages/home.php')) {
        wp_enqueue_script('home-js', get_template_directory_uri() . '/dist/js/home.bundle.js', array('jquery'), null, true);
        wp_enqueue_style('home-style', get_template_directory_uri() . '/dist/css/home.bundle.css');
    }

    if (is_page_template('pages/restaurant.php')) {
        wp_enqueue_script('restaurant-js', get_template_directory_uri() . '/dist/js/restaurant.bundle.js', array('jquery'), null, true);
        wp_enqueue_style('restaurant-style', get_template_directory_uri() . '/dist/css/restaurant.bundle.css');
    }

    if (is_shop() || is_page_template('woocommerce/archive-product.php')) {
        wp_enqueue_script('shop-js', get_template_directory_uri() . '/dist/js/shop.bundle.js', array('jquery'), null, true);
        wp_enqueue_style('shop-style', get_template_directory_uri() . '/dist/css/shop.bundle.css');
        wp_enqueue_script('tween-max', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js', array('jquery'), null, true);
    }

    if (is_singular('product')) {
        wp_enqueue_script('product-js', get_template_directory_uri() . '/dist/js/product.bundle.js', array('jquery'), null, true);
        wp_enqueue_style('product-style', get_template_directory_uri() . '/dist/css/product.bundle.css');
        wp_enqueue_script('tween-max', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js', array('jquery'), null, true);
    }

    $settings = array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'template_directory_url' => get_template_directory_uri(),
        'wishlist' => translate_and_output('wishlist')
    );

    wp_localize_script('main', 'settings', $settings);
}

function theme_setup() {
    // Theme setup actions
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

//Includes
require_once get_template_directory() . '/includes/ajaxQueries.php';

require_once get_template_directory() . '/includes/polylangSetup.php';

require_once get_template_directory() . '/includes/customFunctions.php';

require_once get_template_directory() . '/includes/uploadMimes.php';

function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );