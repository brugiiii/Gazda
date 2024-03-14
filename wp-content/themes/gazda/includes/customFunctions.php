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

function custom_woocommerce_strings($translated_text, $text, $domain) {
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

function send_email_message($id, $data) {
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

function send_telegram_message($id, $data) {
    $telegram_bot_token = '6834342727:AAE8GVJwjHycxtqnxZzGXtvauRMxWuy_0Ro';
    $chat_id = '-4117221606';
    // Перевірка, чи є дані та чи вони масивом
    if (!empty($data) && is_array($data)) {
        $telegram_message = "Нове повідомлення з сайту:\n\n";

        if ($id === 'loyalty') {
            $telegram_message = "Сертифікат!\n\n";
        }

        // Додавання кожної пари назви та значення у повідомлення
        foreach ($data as $field) {
            // Додаємо назву та значення поля
            $telegram_message .= "<b>" . $field['name'] . ":</b> " . $field['value'] . "\n";
        }
    }

    // Відправлення повідомлення у Телеграм за допомогою cURL
    $url = "https://api.telegram.org/bot$telegram_bot_token/sendMessage";
    $data = array('chat_id' => $chat_id, 'text' => $telegram_message, 'parse_mode' => 'HTML');

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
}



