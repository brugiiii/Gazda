<?php
/**
 * Plugin Name: Gazda Bitrix
 * Description:
 * Version: 2.4
 * Text Domain: gazda_bitrix
 * Domain Path: /languages/
 * Requires at least: 6.4
 * Requires PHP: 7.4
 */
add_action('woocommerce_thankyou', 'bitrix_create_lead');
function bitrix_create_lead($order_id)
{
    $order = wc_get_order($order_id);
    $order_data = $order->get_data();

    $lead_id = create_bitrix_lead($order, $order_data);

    if ($lead_id) {
        add_bitrix_lead_products($order, $lead_id);
    }
}

function create_bitrix_lead($order, $order_data)
{
    $queryUrl = 'https://foodlove.bitrix24.eu/rest/13/5tp3hsjrzcwr7tz2/crm.lead.add.json';
    $queryData = http_build_query([
        'fields' => [
            'ASSIGNED_BY_ID' => 1308,
            'TITLE' => "Замовлення з сайту № {$order_data['id']}",
            'NAME' => $order_data['billing']['first_name'],
            'LAST_NAME' => $order_data['billing']['last_name'],
            'SOURCE_ID' => 'WEB',
            'PHONE' => [['VALUE' => $order->get_billing_phone(), 'VALUE_TYPE' => "WORK"]],
            'EMAIL' => [['VALUE' => $order->get_billing_email(), 'VALUE_TYPE' => "WORK"]],
            'COMMENTS' => "<hr>
                <strong>Загальна інформація про замовлення</strong><br>
                ID замовлення: {$order_data['id']}<br>
                Валюта замовлення: {$order_data['currency']}<br>
                Спосіб оплати: {$order_data['payment_method_title']}<br>
                Вартість доставки: {$order_data['shipping_total']}<br>
                Разом із доставкою: {$order_data['total']}<br>",
            'ADDRESS' => $order->get_billing_address_1(),
            'ADDRESS_2' => $order->get_billing_address_2(),
            'ADDRESS_CITY' => $order->get_billing_city(),
            'ADDRESS_PROVINCE' => $order->get_billing_state(),
            'ADDRESS_POSTAL_CODE' => $order->get_billing_postcode(),
            'ADDRESS_COUNTRY' => $order->get_billing_country(),
            'UF_CRM_1666609751' => '',
            'UF_CRM_1645686521' => $order->get_customer_note(),
        ],
        'params' => ['REGISTER_SONET_EVENT' => 'Y']
    ]);

    $lead_id = send_bitrix_request($queryUrl, $queryData);
    return $lead_id;
}

function add_bitrix_lead_products($order, $lead_id)
{
    $queryUrl = 'https://foodlove.bitrix24.eu/rest/13/5tp3hsjrzcwr7tz2/crm.lead.productrows.set';
    
    $products = [];
    foreach ($order->get_items() as $item_id => $item) {
        $product = $item->get_product();
        $products[] = [
            "PRODUCT_ID" => $product->sku, 
            "PRICE" => $product->get_price(),
            "QUANTITY" => $item->get_quantity(),
            'NAME' => $product->get_name(),
        ];
    }

    $queryData = http_build_query([
        'id' => $lead_id,
        'rows' => $products,
    ]);

    send_bitrix_request($queryUrl, $queryData);
}

function send_bitrix_request($url, $data)
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_POSTFIELDS => $data,
    ]);
    $result = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($result, true);
    return isset($result['result']) ? $result['result'] : null;
}
