<?php

function translate_and_output($string_key, $group = 'Main Page')
{
    global $strings_to_translate;

    if (function_exists('pll__')) {
        return pll__($strings_to_translate[$string_key], $group);
    } else {
        return $strings_to_translate[$string_key];
    }
}

$strings_to_translate = array(
    'reserve' => 'Резерв столу',
    'signin' => 'Увійти',
    'go_over' => "Перейти",
    'view_products' => 'Переглянути товари',
    'copyright' => '&#169;2022',
    'address' => 'Адреса',
    'number' => 'Телефон',
    'policy' => 'Політика сайту',
    'cookies' => 'Cookies',
    'socials' => 'Ми в соц. мережах:',
    'app' => 'Спробуйте наш додаток',
    'ingredients' => 'Інгрідієнти',
    'allergens' => 'Алергени',
    'garlic' => 'часник',
    'nuts' => 'горіхи',
    'gluten' => 'глютен',
    'lactose' => 'лактоза',
    'menu' => 'Меню',
    'wishlist' => 'Обране',
    'categories' => 'Категорії',
    'all_products' => 'Усі товари',
    'filter' => 'Фільтр',
    'low_to_high' => 'Від дешевих до дорогих',
    'high_to_low' => 'Від дорогих до дешевих',
    'no_products' => 'Немає товарів',
    'buy' => 'Купити',
    'load_more' => 'Показати ще',
    'own' => 'Власне виробництво',
    'kitchen' => 'Закарпатська кухня',
    'recommended' => 'Ґазда рекомендує',
    'new' => 'Шось нове',
    'read_more' => 'Читати далі',
    'hide' => 'Приховати',
    'in_stock' => 'Є в наявності',
    'out_of_stock' => 'Немає в наявності',
    'size' => 'Розмір',
    'amount' => 'кількість',
    'description' => 'ОПИС',
    'reviews' => 'ВІДГУКИ',
    'return' => 'ОБМІН ТА ПОВЕРНЕННЯ',
    'features_bag_text' => 'фасуємо в день замовлення',
    'features_camera_text' => 'фото з реальних зразків',
    'features_truck_text' => 'безкоштовна доставка від 500 грн',
    'similar_products' => 'СУМІЖНІ ТОВАРИ',
    'choose_options' => 'Оберіть опції',
    'you\'r_review' => 'Ваш відгук',
    'rating' => 'Оцінка',
    'no_reviews' => 'Відгуків немає, поки що.',
    'leave_review' => 'НАПИСАТИ ВІДГУК',
    'write_review' => 'Напишіть відгук',
    'send_review' => 'Надіслати відгук',
    'name' => 'Ім’я',
    'write_your_name' => 'Напишіть своє ім’я',
    'write_your_mail' => 'Напишіть свою пошту',
    'write_company_name' => 'Напишіть назву компанії',
    'write_date_and_time' => 'Напишіть дату та час візиту',
    'write_quests_count' => 'Вкажіть кількість гостей',
    'write_your_message' => 'Напишіть своє повідомлення',
    'choose_event' => 'Оберіть подію',
    'from' => 'Від',
    'search' => 'Пошук',
    'search_results' => 'Результати пошуку: ',
    'no_results' => 'Товарів, відповідних вашому запиту, не знайдено.',
    'not_found' => 'Сторінку не знайдено',
    'to_main' => 'На головну',
    'cost' => 'Вартість',
    'send' => 'Надіслати',
    'company_name' => 'Назва компанії',
    'date_and_time' => 'Дата та час візиту',
    'guests_count' => 'Кількість гостей',
    'message' => 'Ваше повідомлення',
);

if (function_exists('pll_register_string')) {
    foreach ($strings_to_translate as $string_key => $string_value) {
        pll_register_string($string_key, $string_value, 'Main Page');
    }
}