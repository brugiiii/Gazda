<?php
add_filter('woocommerce_product_tabs', 'remove_additional_information_tab', 98);
add_filter('woocommerce_product_tabs', 'exchanges_and_returns_tab');
add_filter('woocommerce_product_description_heading', 'custom_product_description_heading');
add_filter('woocommerce_product_reviews_tab_title', 'custom_reviews_tab_title');
add_filter( 'woocommerce_product_description_tab_title', 'custom_product_description_tab_title' );

function remove_additional_information_tab($tabs)
{
    unset($tabs['additional_information']); // Приховуємо вкладку з додатковою інформацією
    return $tabs;
}

function exchanges_and_returns_tab($tabs)
{
    // Додаємо вкладку з іменем "Моя вкладка"
    $tabs['exchanges_and_returns'] = array(
        'title' => __(translate_and_output('return'), 'woocommerce'),
        'priority' => 50,
        'callback' => 'exchanges_and_returns_content'
    );

    return $tabs;
}

function exchanges_and_returns_content()
{
    return the_field('exchanges_and_returns');
}

function custom_product_description_heading()
{
    return null;
}

function custom_reviews_tab_title($title)
{
    return __(translate_and_output('reviews'), 'woocommerce');
}

function custom_product_description_tab_title( $title ) {
    return __( translate_and_output('description'), 'woocommerce' );
}

