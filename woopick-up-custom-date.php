<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://bestwpdeveloper.com
 * @since             1.0
 * @package           WooPick Up Custom Date
 *
 * @wordpress-plugin
 * Plugin Name:       WooPick Up Custom Date
 * Plugin URI:        https://bestwpdeveloper.com/woopick-up-custom-date/
 * Description:       Choose your delivery date at checkout for a personalized shopping experience!
 * Version:           1.0
 * Author:            Best WP Developer
 * Author URI:        https://bestwpdeveloper.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woopick-up-custom-date
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
function add_custom_action_links($links) {
	$custom_links = array(
			'<a href="' . admin_url('options-general.php?page=get-woopick-up-custom-date') . '">'.esc_html__('Settings', 'woopick-up-custom-date').'</a>',
	);
	return array_merge($custom_links, $links);
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'add_custom_action_links');
require_once ( plugin_dir_path(__FILE__) ) . '/inc/requires-check.php';
final class FinalWPUCDShop{
	const VERSION = '1.0';
	const MINIMUM_PHP_VERSION = '7.0';
	public function __construct() {
		// Load translation
		add_action( 'wpucd_init', array( $this, 'wpucd_loaded_textdomain' ) );
		// wpucd_init Plugin
		add_action( 'plugins_loaded', array( $this, 'wpucd_init' ) );
		// For woocommerce install check
		if ( ! did_action( 'woocommerce/loaded' ) ) {
			add_action( 'admin_notices', 'wpucd_WooCommerce_register_required_plugins' );
			return;
		}
	}

	public function wpucd_loaded_textdomain() {
		load_plugin_textdomain( 'woopick-up-custom-date', false, basename(dirname(__FILE__)).'/languages' );
	}

	public function wpucd_init() {
		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'wpucd_admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'load-functions.php' );
	}

	public function wpucd_admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'woopick-up-custom-date' ),
			'<strong>' . esc_html__( 'WooPick Up Custom Date', 'woopick-up-custom-date' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'woopick-up-custom-date' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'woopick-up-custom-date') . '</p></div>', $message );
	}
}

new FinalWPUCDShop();
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );