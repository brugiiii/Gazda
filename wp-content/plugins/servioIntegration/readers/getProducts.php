<?php

if (!defined('ABSPATH')) {
    exit;
}

function si__get_products_and_categories()
{
    global $base_url;

    $url = $base_url . '/POSExternal/Get_TarifItemExt';

    $args = array(
        'body' => json_encode((object)[]),
    );

    $response = wp_remote_post($url, $args);

    if (is_wp_error($response)) {
        error_log('POST Request Error: ' . $response->get_error_message());
        return false;
    }

    $json_response = json_decode(wp_remote_retrieve_body($response), true);

    if (isset($json_response['Groups']) && is_array($json_response['Groups'])) {
        $all_objects = array();
        $categories = array();

        foreach ($json_response['Groups'] as $group) {
            if (isset($group['Items']) && is_array($group['Items'])) {
                $all_objects = array_merge($all_objects, $group['Items']);
            }

            $categories[$group['ID']] = $group['Name'];
        }

        return array('items' => $all_objects, 'categories' => $categories);
    }

    return false;
}

function si__process_products($groupMenuID = null)
{
    ['items' => $items, 'categories' => $categories] = si__get_products_and_categories();

    if (empty($items) || empty($categories)) {
        return false;
    }

    foreach ($items as &$product) {
        $categoryName = isset($categories[$product['ParentID']]) ? $categories[$product['ParentID']] : 'Uncategorized';

        $product['Category'] = $categoryName;
    }

    return $items;
}