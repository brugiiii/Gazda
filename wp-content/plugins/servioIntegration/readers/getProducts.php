<?php

if (!defined('ABSPATH')) {
    exit;
}

/* Якщо передати параметр $groupMenuID результатом функції
будуть позиції номенклатури за значенням ІД групи, якщо нічого
не передавати результатом буде вся номенклатура меню */
function si__get_products($groupMenuID = null)
{
    global $base_url;

    $url = $base_url . '/POSExternal/Get_TarifItem';

    $data = $groupMenuID ? json_encode(["GroupMenuID" => $groupMenuID]) : json_encode((object)[]);

    $args = array(
        'body' => $data,
    );

    $response = wp_remote_post($url, $args);

    if (is_wp_error($response)) {
        error_log('POST Request Error: ' . $response->get_error_message());
        return false;
    }

    $json_response = json_decode(wp_remote_retrieve_body($response), true);

    if (isset($json_response['Item']) && is_array($json_response['Item'])) {
        return $json_response['Item'];
    } else {
        error_log('Invalid response format. Item key not found or not an array.');
        return false;
    }
}

function si__get_products_ext()
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

        foreach ($json_response['Groups'] as $group) {
            if (isset($group['Items']) && is_array($group['Items'])) {
                $all_objects = array_merge($all_objects, $group['Items']);
            }
        }

        return $all_objects;
    }

    return false;
}

function si__process_products($groupMenuID = null)
{
    $products = si__get_products($groupMenuID);
    $products_ext = si__get_products_ext();

    if (empty($products) || empty($products_ext)) {
        return false;
    }

    $allProducts = array_merge($products, $products_ext);

    $uniqueProducts = [];

    foreach ($allProducts as $product) {
        $uniqueProducts[$product['ID']] = [
            'ID' => trim($product['ID']),
            'Name' => trim($product['Name']),
            'Price' => trim($product['Price']),
            'Code' => trim($product['Code']),
            'SaleStatus' => trim($product['SaleStatus'])
        ];
    }

    return $uniqueProducts;
}