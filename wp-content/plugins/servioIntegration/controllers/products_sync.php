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

    if (isset($_POST['si_run_integration']) && wp_verify_nonce($si_run_integration_nonce, 'si_run_integration_nonce')) {
        $products = si__process_products();

        foreach ($products as $key => $product) {
            if (!si__woocommerce_add_product($product['ID'], $product['Name'], $product['Price'], $product['Code'])) {

                si__woocommerce_update_product($product['ID'],  $product['Name'], $product['Price'], $product['Code']);
            }
        }
    }
}

add_action('init', 'si__init_runner_woo');
