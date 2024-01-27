<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function si__woocommerce_product_exists($servio_product_id) {
    // Check if the product with the given servio_product_id exists
    $existing_product = get_posts(array(
        'post_type' => 'product',
        'meta_key' => 'servio_product_id',
        'meta_value' => $servio_product_id,
        'post_status' => 'any',
        'numberposts' => 1,
    ));

    return !empty($existing_product) ? $existing_product[0] : false;
}

function si__woocommerce_add_product($servio_product_id, $product_title, $product_price, $product_sku, $product_status) {
    // Check if the product already exists
    $existing_product = si__woocommerce_product_exists($servio_product_id);

    if (!$existing_product) {

        $product_ob_arr = array(
            'post_title'   => $product_title,
            'post_content' => '',
            'post_status'  => 'draft',
            'post_type'    => 'product',
        );

        switch ($product_status) {
            case '1':
            case '2':
                $stock = 1;
                $stock_status = 'instock';
                $visibility = true;
                $product_ob_arr['post_status'] = 'publish';
                break;
        
            case '3':
                $stock = 0;
                $stock_status = 'outofstock';
                $visibility = false;
                $product_ob_arr['post_status'] = 'publish';
                break;

            case '0':
            default:
                $stock = 0;
                $stock_status = 'outofstock';
                $visibility = false;
                $product_ob_arr['post_status'] = 'draft';
                break;
        }

        // Product does not exist, create a new one
        $product_id = wp_insert_post($product_ob_arr);
        
        update_post_meta($product_id, '_stock', $stock);
        update_post_meta($product_id, '_stock_status', wc_clean($stock_status));
        wp_set_post_terms($product_id, 'outofstock', 'product_visibility', $visibility);
        wc_delete_product_transients($product_id);

        // Update product metadata
        update_post_meta($product_id, '_price', $product_price);
        update_post_meta($product_id, '_regular_price', $product_price);
        update_post_meta($product_id, '_sale_price', $product_price);
        update_post_meta($product_id, '_sku', $product_sku);

        // Servio ID for the product
        update_post_meta($product_id, 'servio_product_id', $servio_product_id);
        
        return true;
    } else {
        return false;
    }
}

function si__woocommerce_update_product($servio_product_id, $new_product_title, $new_product_price, $new_product_sku, $new_product_status) {
    // Check if the product with the given servio_product_id exists
    $existing_product = si__woocommerce_product_exists($servio_product_id);

    if ($existing_product) {
        // The product exists, update its details
        $product_id = $existing_product->ID;

        $product_ob_arr = array(
            'ID'           => $product_id,
            'post_title'   => $new_product_title,
            'post_content' => '',
        );

        switch ($new_product_status) {
            case '1':
            case '2':
                $stock = 1;
                $stock_status = 'instock';
                $visibility = true;
                $product_ob_arr['post_status'] = 'publish';
                break;
        
            case '3':
                $stock = 0;
                $stock_status = 'outofstock';
                $visibility = false;
                $product_ob_arr['post_status'] = 'publish';
                break;

            case '0':
            default:
                $stock = 0;
                $stock_status = 'outofstock';
                $visibility = false;
                $product_ob_arr['post_status'] = 'draft';
                break;
        }

        wp_update_post($product_ob_arr);
        
        update_post_meta($product_id, '_stock', $stock);
        update_post_meta($product_id, '_stock_status', wc_clean($stock_status));
        wp_set_post_terms($product_id, 'outofstock', 'product_visibility', $visibility);
        wc_delete_product_transients($product_id);

        update_post_meta($product_id, '_price', $new_product_price);
        update_post_meta($product_id, '_regular_price', $new_product_price);
        update_post_meta($product_id, '_sale_price', $new_product_price);
        update_post_meta($product_id, '_sku', $new_product_sku);
    }
}
