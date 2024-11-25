<?php
/**
 * Controller Name
 * 
 * @package ServioIntegration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function si__init_runner_woo() {

    $si_run_integration_nonce = isset($_POST['si_run_integration_nonce']) ? sanitize_text_field($_POST['si_run_integration_nonce']) : '';

    if (isset($_POST['si_run_integration']) && wp_verify_nonce($si_run_integration_nonce, 'si_run_integration_nonce') ||
    (defined('DOING_CRON') && DOING_CRON)
    ) {
        $products = si__process_products();

        foreach ($products as $key => $product) {

            $product['SaleStatus'] = ($product['SaleStatus']) ? $product['SaleStatus'] : '1';

            if (!si__woocommerce_add_product($product['ID'], $product['Name'], $product['Price'], $product['Code'], $product['SaleStatus'], $product['Category'])) {

                si__woocommerce_update_product($product['ID'],  $product['Name'], $product['Price'], $product['Code'], $product['SaleStatus'], $product['Category']);
            }
        }
    }
}

add_action('init', 'si__init_runner_woo');

// Add a hook for cron execution
add_action('si_cron_hook', 'si__init_runner_woo');

// Register a cron task to call our function once a day
if (!wp_next_scheduled('si_cron_hook')) {
    
    // Set the cron task to run every day at 10:30
    wp_schedule_event(strtotime('10:30'), 'daily', 'si_cron_hook');
}