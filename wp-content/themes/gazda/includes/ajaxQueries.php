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

function register_user_ajax() {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Перевірка наявності користувача з такою ж адресою електронної пошти
    $email_exists = email_exists($email);
    $username_exists = username_exists($login);

    if($email_exists) {
        wp_send_json_error("Обліковий запис з такою адресою електронної пошти вже зареєстрований. Будь ласка, увійдіть");
    } else if($username_exists) {
        wp_send_json_error("Обліковий запис з цим логіном вже зареєстрований. Будь ласка, обріть інший");
    } else {
        $user_id = wc_create_new_customer($email, $login, $password);

        if (is_wp_error($user_id)) {
            // Обробка помилки, якщо створення користувача не вдалося
            wp_send_json_error($user_id->get_error_message());
        } else {
            // Автентифікація користувача після успішної реєстрації
            $creds = array(
                'user_login'    => $login,
                'user_password' => $password,
                'remember'      => true
            );

            $user = wp_signon($creds, false);

            if (is_wp_error($user)) {
                // Відправляємо помилку автентифікації користувача
                wp_send_json_error($user->get_error_message());
            } else {
                // Відправляємо успішну відповідь з ID користувача
                wp_send_json_success("Користувач успішно створений з ID: $user_id");
            }
        }
    }

    // Важливо завершити AJAX запит
    wp_die();
}

function login_user_ajax() {
    $login_or_email = $_POST['login_or_email'];
    $password = $_POST['password'];

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

        wp_send_json_success("Успішний вхід. Користувач: $user->user_login");
    } else {
        // Відправлення помилки
        wp_send_json_error('Неправильний логін або пароль');
    }

    // Важливо завершити AJAX запит
    wp_die();
}