<?php
add_action('wp_ajax_get_wishlist_count', 'get_wishlist_count_ajax');
add_action('wp_ajax_nopriv_get_wishlist_count', 'get_wishlist_count_ajax');
add_action('wp_ajax_fetch_products', 'fetch_products');
add_action('wp_ajax_nopriv_fetch_products', 'fetch_products');
add_action('wp_ajax_search_products', 'search_products_ajax');
add_action('wp_ajax_nopriv_search_products', 'search_products_ajax');
add_action('wp_ajax_register_user', 'register_user_ajax');
add_action('wp_ajax_nopriv_register_user', 'register_user_ajax');
add_action('wp_ajax_login_user', 'login_user_ajax');
add_action('wp_ajax_nopriv_login_user', 'login_user_ajax');
add_action('wp_ajax_update_personal_data', 'update_personal_data_ajax');
add_action('wp_ajax_nopriv_update_personal_data', 'update_personal_data_ajax');
add_action('wp_ajax_change_password', 'change_password_ajax');
add_action('wp_ajax_nopriv_change_password', 'change_password_ajax');
add_action('wp_ajax_get_order_info', 'get_order_info_ajax');
add_action('wp_ajax_nopriv_get_order_info', 'get_order_info_ajax');
add_action('wp_ajax_send_mail', 'send_mail_ajax');
add_action('wp_ajax_nopriv_send_mail', 'send_mail_ajax');
add_action('wp_ajax_update_product_quantity', 'update_product_quantity_ajax');
add_action('wp_ajax_nopriv_update_product_quantity', 'update_product_quantity_ajax');
add_action('wp_ajax_remove_product', 'remove_product_ajax');
add_action('wp_ajax_nopriv_remove_product', 'remove_product_ajax');


function fetch_products()
{
    get_template_part('templates/shop/fetchProducts');
}

function get_wishlist_count_ajax()
{
    $wishlist_count = YITH_WCWL()->count_products();
    echo json_encode(array('wishlist_count' => $wishlist_count));
    wp_die();
}

function search_products_ajax()
{
    get_template_part('templates/search/fetchProducts');
}

function register_user_ajax()
{
    $login = isset($_POST['login']) ? $_POST['login'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Перевірка наявності користувача з такою ж адресою електронної пошти
    $email_exists = email_exists($email);
    $username_exists = username_exists($login);

    if ($email_exists) {
        wp_send_json_error("Обліковий запис з такою адресою електронної пошти вже зареєстрований. Будь ласка, увійдіть");
    } else if ($username_exists) {
        wp_send_json_error("Обліковий запис з цим логіном вже зареєстрований. Будь ласка, оберіть інший");
    } else {
        $user_id = wc_create_new_customer($email, $login, $password);

        if (is_wp_error($user_id)) {
            // Обробка помилки, якщо створення користувача не вдалося
            wp_send_json_error($user_id->get_error_message());
        } else {

            $user_data = array(
                'ID' => $user_id,
                'first_name' => $login, // Встановлюємо ім'я користувача
            );
            wp_update_user($user_data);

            // Автентифікація користувача після успішної реєстрації
            $creds = array(
                'user_login' => $login,
                'user_password' => $password,
                'remember' => true
            );

            $user = wp_signon($creds, false);

            if (is_wp_error($user)) {
                // Відправляємо помилку автентифікації користувача
                wp_send_json_error($user->get_error_message());
            } else {
                // Відправляємо успішну відповідь з ID користувача
                wp_send_json_success("Користувач успішно створений");
            }
        }
    }

    // Важливо завершити AJAX запит
    wp_die();
}

function login_user_ajax()
{
    $login_or_email = isset($_POST['login_or_email']) ? $_POST['login_or_email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Перевірка, чи є користувач з таким логіном або електронною поштою
    if (filter_var($login_or_email, FILTER_VALIDATE_EMAIL)) {
        // Якщо введено електронну пошту
        $user = get_user_by('email', $login_or_email);
    } else {
        // Якщо введено логін
        $user = get_user_by('login', $login_or_email);
    }

    // Перевірка, чи користувач існує та вірний пароль
    if ($user && wp_check_password($password, $user->data->user_pass, $user->ID)) {
        // Автентифікація користувача
        wp_set_current_user($user->ID, $user->user_login);
        wp_set_auth_cookie($user->ID);

        wp_send_json_success("Успішний вхід");
    } else {
        // Відправлення помилки
        wp_send_json_error('Неправильний логін або пароль');
    }

    // Важливо завершити AJAX запит
    wp_die();
}

function update_personal_data_ajax()
{
    $user_id = get_current_user_id(); // Отримуємо ID поточного користувача
    $current_wc_user = new WC_Customer($user_id);

    // Перевірка, чи користувач авторизований
    if ($user_id !== 0) {
        // Отримуємо дані з POST
        $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $surname = isset($_POST['surname']) ? sanitize_text_field($_POST['surname']) : '';
        $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
        $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';

        // Отримуємо поточні дані користувача
        $current_name = $current_wc_user->get_first_name();
        $current_surname = $current_wc_user->get_last_name();
        $current_email = $current_wc_user->get_email();
        $current_phone = $current_wc_user->get_billing_phone();

        // Перевіряємо, чи всі передані значення збігаються з поточними
        if ($name === $current_name && $surname === $current_surname && $email === $current_email && $phone === $current_phone) {
            wp_send_json_error('Немає потреби оновлювати дані.');
        }

        // Оновлюємо дані користувача
        if (!empty($name) && $name !== $current_name) {
            $current_wc_user->set_first_name($name);
            $current_wc_user->set_display_name($name);
        }
        if (!empty($surname) && $surname !== $current_surname) {
            $current_wc_user->set_last_name($surname);
        }
        if (!empty($email) && $email !== $current_email) {
            $current_wc_user->set_email($email);
        }
        if (!empty($phone) && $phone !== $current_phone) {
            $current_wc_user->set_billing_phone($phone);
        }

        $current_wc_user->save();

        // Відповідь на AJAX-запит
        wp_send_json_success('Дані оновлено успішно.');
    } else {
        wp_send_json_error('Користувач не авторизований.');
    }

    wp_die();
}

function change_password_ajax()
{
    $user_id = get_current_user_id(); // Отримуємо ID поточного користувача

    if ($user_id !== 0) {
        $current_user = wp_get_current_user();

        $old_password = isset($_POST['old_password']) ? sanitize_text_field($_POST['old_password']) : '';
        $new_password = isset($_POST['new_password']) ? sanitize_text_field($_POST['new_password']) : '';

        // Перевірка чи введений старий пароль правильний
        if (empty($old_password) || !wp_check_password($old_password, $current_user->user_pass, $current_user->ID)) {
            wp_send_json_error('Старий пароль введено невірно.');
        }

        // Оновлення паролю користувача
        wp_set_password($new_password, $user_id);

        // Автоматичний вхід користувача за допомогою нового пароля
        $credentials = [
            'user_login' => $current_user->user_login,
            'user_password' => $new_password,
            'remember' => true
        ];
        $user = wp_signon($credentials, false);

        if (is_wp_error($user)) {
            wp_send_json_error('Помилка входу!');
        }

        // Відповідь на AJAX-запит
        wp_send_json_success('Пароль успішно оновлено!');
    } else {
        wp_send_json_error('Користувач не авторизований.');
    }

    wp_die();
}

function get_order_info_ajax()
{
    get_template_part('templates/account/orderInfo');
}

function send_mail_ajax()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $form_title = sanitize_text_field($_POST['formTitle']);
        $data = $_POST['formData'];

        if (is_array($data)) {
            foreach ($data as &$field) {
                foreach ($field as &$value) {
                    $value = wp_kses_post($value);
                }
            }
        }

        $telegram_response = send_telegram_message($form_title, $data);

        if($telegram_response->ok === true){
            wp_send_json_success(translate_and_output('thank_you_letter'));
        } else {
            wp_send_json_error('Server error');
        }
    }

    wp_die();
}

function update_product_quantity_ajax()
{
    $product_id = isset($_POST["productId"]) ? intval($_POST["productId"]) : 0;
    $quantity = isset($_POST["quantity"]) ? intval($_POST["quantity"]) : 0;

    if (!$product_id) {
        wp_send_json_error("Error: Product ID is missing.");
    }

    $cart = WC()->cart;

    $product_cart_id = $cart->generate_cart_id($product_id);
    $cart_item_key = $cart->find_product_in_cart($product_cart_id);

    if ($cart_item_key) {
       $cart->set_quantity($cart_item_key, $quantity);
    } else {
       $cart->add_to_cart($product_id, $quantity);
    }

    ob_start();
    get_template_part('templates/cart/content');
    $cart_markup = ob_get_clean();

    $response = array(
        "cartMarkup" => $cart_markup,
    );

    wp_send_json_success($response);

    wp_die();
}

function remove_product_ajax()
{
    $product_id = isset($_POST["productId"]) ? intval($_POST["productId"]) : 0;

    $product_cart_id = WC()->cart->generate_cart_id($product_id);
    $cart_item_key = WC()->cart->find_product_in_cart($product_cart_id);

    if ($cart_item_key) {
        WC()->cart->remove_cart_item($cart_item_key);
    }

    ob_start();
    get_template_part('templates/cart/content');
    $cart_markup = ob_get_clean();

    $response = array(
        "cartMarkup" => $cart_markup,
    );

    wp_send_json_success($response);

    wp_die();
}

