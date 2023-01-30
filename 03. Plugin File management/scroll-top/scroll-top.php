<?php
/**
 * Plugin Name:       Scroll To Top
 * Plugin URI:        https://github.com/gasatrya/scroll-top
 * Description:       Adds a flexible Back to Top button to any post/page of your WordPress website.
 * Version:           1.5
 * Requires at least: 5.6
 * Requires PHP:      7.2
 * Author:            Ga Satrya
 * Author URI:        https://gasatrya.dev/
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       scroll-top
 * Domain Path:       /languages
 *
 * @package Scroll Top
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ST_VERSION', '1.5' );
define( 'ST_INCLUDES', trailingslashit( plugin_dir_path( __FILE__ ) ) . trailingslashit( 'inc' ) );
define( 'ST_ADMIN', trailingslashit( plugin_dir_path( __FILE__ ) ) . trailingslashit( 'admin' ) );
define( 'ST_ASSETS', trailingslashit( plugin_dir_url( __FILE__ ) ) . trailingslashit( 'assets' ) );

// Loads plugin files.
require_once ST_INCLUDES . 'functions.php';
if ( is_admin() ) {
	require_once ST_ADMIN . 'admin.php';
}

/**
 * Load language.
 */
function scroll_top_i18n() {
	load_plugin_textdomain( 'scroll-top', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'scroll_top_i18n' );
