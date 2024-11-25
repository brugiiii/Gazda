<?php
/**
 * Plugin Name: Servio Integration
 * Description: Works with WooCommerce
 * Version: 1.6.0
 * Text Domain: servio_integration
 * Domain Path: /languages/
 * Requires at least: 6.4
 * Requires PHP: 7.4
 *
 * @package ServioIntegration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Hook for adding an option for servio when activating the plugin
function si_check_options() {
    add_option('si_perform_add', '0');
    add_option('si_perform_update', '0');
}
add_action('after_setup_theme', 'si_check_options');

// Check WooCommerce Active
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    // Check WooCommerce Version
    $woocommerce_version = get_option('woocommerce_version');
    if (version_compare($woocommerce_version, '8.4.0', '>=')) {

        // Admin
        require_once plugin_dir_path(__FILE__) . 'admin/integration-settings.php';
        require_once plugin_dir_path(__FILE__) . 'admin/servioid.php';

        // Readers
        require_once plugin_dir_path(__FILE__) . 'readers/authServio.php';
        require_once plugin_dir_path(__FILE__) . 'readers/getProducts.php';

        // Writers
        require_once plugin_dir_path(__FILE__) . 'writers/genProducts.php';

        // Controllers
        require_once plugin_dir_path(__FILE__) . 'controllers/products_sync.php';

    } else {
        add_action('admin_notices', 'si_notice');
        function si_notice() {
            ?>
            <div class="notice notice-error is-dismissible">
                <p><b><?php _e('Warning: Update WooCommerce! (SERVIO INTEGRATION).', 'servio_integration'); ?></b></p>
            </div>
            <?php
        }
    }

} else {
    add_action('admin_notices', 'si_notice');
    function si_notice() {
        ?>
        <div class="notice notice-error is-dismissible">
            <p><b><?php _e('Warning: WooCommerce must be installed and activated for SERVIO INTEGRATION to work correctly.', 'servio_integration'); ?></b></p>
        </div>
        <?php
    }
}

// update_option('servio_integration_token', '0');
// var_dump(si__get_tarif_items());
