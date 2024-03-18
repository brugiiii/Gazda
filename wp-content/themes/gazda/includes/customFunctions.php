<?php
add_filter('gettext', 'custom_woocommerce_strings', 20, 3);

function process_menu_items_hierarchy()
{
    $menu_locations = get_nav_menu_locations();
    $menu_id = $menu_locations['menu-restaurant'];
    $menu_items = wp_get_nav_menu_items($menu_id, array('order' => 'ASC'));

    $menu_items_hierarchy = array();

    foreach ($menu_items as $menu_item) {
        $category_id = get_post_meta($menu_item->ID, '_menu_item_object_id', true);
        $category = get_term($category_id, 'product_cat');

        if ($category->parent == 0) {
            $menu_items_hierarchy[$category->term_id] = array(
                'menu_item' => $menu_item,
                'children' => array(),
            );
        } else {
            $parent_id = $category->parent;
            if (!isset($menu_items_hierarchy[$parent_id])) {
                $menu_items_hierarchy[$parent_id] = array(
                    'menu_item' => null,
                    'children' => array(),
                );
            }

            $menu_items_hierarchy[$parent_id]['children'][] = array(
                'menu_item' => $menu_item,
                'category' => $category,
            );
        }
    }

    uasort($menu_items_hierarchy, function ($a, $b) {
        return $a['menu_item']->menu_order - $b['menu_item']->menu_order;
    });

    return $menu_items_hierarchy;
}

function get_image($name)
{
    echo get_template_directory_uri() . "/assets/images/" . $name;
}

function custom_woocommerce_strings($translated_text, $text, $domain)
{
    switch ($text) {
        case 'Add to cart':
            $translated_text = translate_and_output('buy');
            break;
        case 'Choose options':
            $translated_text = translate_and_output('choose_options');
            break;
    }
    return $translated_text;
}

function send_email_message($id, $data)
{
    $to = get_option('admin_email');
    $subject = 'Form Submission';

    // Styling for email message
    $message = '<html><body>';
    $message .= '</body></html>';

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: webmaster@example.com',
        'Reply-To: webmaster@example.com',
        'X-Mailer: PHP/' . phpversion()
    );

    // Sending HTML email
    wp_mail($to, $subject, $message, $headers);
}

function send_telegram_message($form_title, $data)
{
    $telegram_bot_token = '6834342727:AAE8GVJwjHycxtqnxZzGXtvauRMxWuy_0Ro';
    $chat_id = '-4117221606';

    if (!empty($data) && is_array($data)) {
        $telegram_message = "<b>$form_title:\n\n</b>";

        foreach ($data as $field) {
            $value = $field['value'];

            if (!$value) continue;

            $telegram_message .= "<b>" . $field['name'] . ":</b> " . $value . ";" . "\n";
        }
    }

    $url = "https://api.telegram.org/bot$telegram_bot_token/sendMessage";
    $data = array('chat_id' => $chat_id, 'text' => $telegram_message, 'parse_mode' => 'HTML');

    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ),
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $data = json_decode($result);

    return $data;
}

function send_bitrix24_message($form_title, $data)
{
    // Установка заголовка для доступу CORS
    header('Access-Control-Allow-Origin: *');

    // Формування логів заповнення форми
    $log_text = "Сайт: " . $_SERVER['SERVER_NAME']
        . "\r\nКонтактне лице: " . $data['NAME']
        . "\r\nТелефон: " . $data['PHONE_MOBILE']
        . "\r\nТариф: " . ($data['UF_CRM_1563785863'] ?? "-")
        . "\r\nКоментарій: " . $data['COMMENTS']
        . "\r\nМені потрібен спецрахунок для госторгів: " . ($data['UF_CRM_1562309647'] ?? "-")
        . "\r\n";

    // Запис логів
    $fp = fopen("./logs/" . date("m-Y") . ".log", "a+t");
    $to_write = date("Y-m-d") . "\t" . date("H:i:s") . "\n" . $log_text . "\r\n";
    if (!fwrite($fp, $to_write)) {
        fclose($fp);
        return "Помилка при відправці. Неможливо записати файл журналу. Зверніться в підтримку сайту.";
    }

    // Формування URL для вебхуку
    $queryUrl = defined('BITRIX24_API_URL') ? BITRIX24_API_URL . "crm.lead.add.json" : "";

    // Формування даних для створення ліда
    $queryData = http_build_query(array(
        'fields' => array(
            "STATUS_ID" => "NEW",
            "OPENED" => "Y",
            'TITLE' => $form_title,
            'ASSIGNED_BY_ID' => 'ИДЕНТИФІКАТОР_ВІДПОВІДАЛЬНОГО',
            'NAME' => $data['NAME'],
            'PHONE' => isset($data['PHONE_MOBILE']) ? array(array('VALUE' => $data['PHONE_MOBILE'], 'VALUE_TYPE' => 'MOBILE')) : array(),
            'COMMENTS' => $data['COMMENTS'],
            'UF_CRM_1563785863' => $data['UF_CRM_1563785863'] ?? array(),
            'UF_CRM_1562309647' => $data['UF_CRM_1562309647'] ?? array()
        ),
        'params' => array("REGISTER_SONET_EVENT" => "Y")
    ));

    // Запит до Bitrix24 через curl
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $queryUrl,
        CURLOPT_POSTFIELDS => $queryData,
    ));
    $result = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($result, 1);

    // Формування відповіді
    if (array_key_exists('error', $result)) {
        return "Помилка: " . $result['error_description'];
    } else {
        return "Дякуємо!<br/>Ваша заявка прийнята";
    }
}




