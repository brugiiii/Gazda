<?php
/**
 * ---
 *
 */

 if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$base_url = 'http://185.179.215.235:29030';

$authentication_data = array(
    'CardCode' => esc_attr(get_option('card_code')), // 08122023
    'TermID'   => esc_attr(get_option('term_id')),  // 0503833054
);
// $authentication_data = array(
//     'CardCode' => '08122023',
//     'TermID'   => '0503833054',
// );

/**
 * Function called when the plugin is activated
 *
 * @return  string  [return description]
 */
function si__authenticate_and_get_token() {
    global $base_url, $authentication_data;

    $url = $base_url . '/POSExternal/Authenticate';
    $data = json_encode($authentication_data);

    $args = array(
        'body'    => $data,
        'headers' => array(
            'Content-Type' => 'application/json',
            'AccessToken' => '',
        ),
    );

    // Executing a POST request
    $response = wp_remote_post($url, $args);

    // Check if received a valid response
    if (is_wp_error($response)) {
        error_log('API Authentication Error: ' . $response->get_error_message());
        return false;
    }

    // Parsing the response and getting servio token
    $body = wp_remote_retrieve_body($response);
    $json_response = json_decode($body, true);
    $token = isset($json_response['Token']) ? $json_response['Token'] : '';

    // Store the token in an option in the database
    update_option('servio_integration_token', $token);

    return $token;
}

/**
 * Function that adds a token to all HTTP requests
 *
 */
function si__add_access_token_to_http_requests(array $args, string $url) {
    global $base_url;

    // Check if the URL starts with the base URL
    if (strpos($url, $base_url) === 0) {
        // Get the token saved in the option
        $token = get_option('servio_integration_token');

        // Check if there is a token
        if ($token) {
            // Add a token to the HTTP request headers
            $args['headers']['AccessToken'] = $token;
        }
    }

    return $args;
}

function si__handle_unauthorized_response($response, $args, $url) {
    global $base_url;

    if (isset($response['response']['code']) && $response['response']['code'] === 401 && strpos($url, $base_url) === 0) {

        $new_token = si__authenticate_and_get_token();

        if ($new_token) {
            $args['headers']['AccessToken'] = $new_token;

            $retry_response = wp_remote_request($url, $args);

            return $retry_response;
        }
    }

    return $response;
}

// Calling the function when the plugin is activated
register_activation_hook(__FILE__, 'si__authenticate_and_get_token');

// Add a filter for http_request_args
add_filter('http_request_args', 'si__add_access_token_to_http_requests', 10, 2);

add_filter('http_response', 'si__handle_unauthorized_response', 10, 3);