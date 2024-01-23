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

function si__get_product_categories()
{
    global $base_url;

    $url = $base_url . '/POSExternal/Get_TarifItems';

    $args = array(
        'body' => json_encode((object)[]),
    );

    $response = wp_remote_post($url, $args);

    if (is_wp_error($response)) {
        error_log('POST Request Error: ' . $response->get_error_message());
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $json_response = json_decode($body, true);

    if (isset($json_response['Items']) && is_array($json_response['Items'])) {
        $result = array();

        foreach ($json_response['Items'] as $item) {
            $result[$item['ID']] = $item['Name'];
        }

        return $result;
    } else {
        error_log('Invalid response format. Items key not found or not an array.');
        return false;
    }
}

function si__process_products($groupMenuID = null)
{
    $products = si__get_products($groupMenuID);

    if (!$products) {
        return false;
    }

    $processedProducts = [];

    foreach ($products as $product) {
        $processedProducts[] = [
            'ID' => $product['ID'],
            'Name' => $product['Name'],
            'Price' => $product['Price'],
            'Code' => $product['Code']
        ];
    }

    return $processedProducts;
}