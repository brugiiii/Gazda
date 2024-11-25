<?php

if (!defined('ABSPATH')) {
    exit;
}

// Constants for keys and settings
define('CARD_CODE', 'card_code');
define('TERM_ID', 'term_id');
define('SETTINGS_SECTION', 'settings_section');

// Displaying entry fields
function card_code_callback() {
    $card_code = esc_attr(get_option('card_code'));
    echo "<input type='text' name='card_code' value='$card_code' />";
}

function term_id_callback() {
    $term_id = esc_attr(get_option('term_id'));
    echo "<input type='text' name='term_id' value='$term_id' />";
}

function settings_page() {
    ?>
    <div class="wrap">
        <h1>Servio - WooCommerce Integration Settings</h1>
        <div class="card">
            <form method="post" action="options.php">
                <?php
                settings_fields(CARD_CODE);
                do_settings_sections(CARD_CODE);
                wp_nonce_field('si_run_integration_nonce', 'si_run_integration_nonce');
                ?>
                <button type="submit" name="si_run_integration" class="button button-primary">Run Integration</button>
            </form>
        </div>
    </div>
    <?php
}

// Initialization setup 
function settings_init() {
    add_settings_section(SETTINGS_SECTION, 'API Settings', 'settings_section_callback', CARD_CODE);
    add_settings_field('card_code_field', 'Card Code', 'card_code_callback', CARD_CODE, SETTINGS_SECTION);
    add_settings_field('term_id_field', 'Term ID', 'term_id_callback', CARD_CODE, SETTINGS_SECTION);
    register_setting(CARD_CODE, 'card_code');
    register_setting(CARD_CODE, 'term_id');
}

// Adding a page to the WooCommerce submenu
function add_settings_page_to_woocommerce() {
    add_submenu_page(
        'woocommerce',
        __('Servio Integration'),
        __('Servio Integration'),
        'manage_options',
        'si_settings_page',
        'settings_page'
    );
}

// Adding hooks for click functions
add_action('admin_menu', 'add_settings_page_to_woocommerce', 70);
add_action('admin_init', 'settings_init');
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'add_settings_link');

function add_settings_link($links) {
    array_unshift($links, '<a href="admin.php?page=si_settings_page">Settings</a>');
    return $links;
}

function settings_section_callback() {
    return null;
}