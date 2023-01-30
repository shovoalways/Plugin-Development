<?php
/**
 * Uninstall procedure for the plugin.
 *
 * @package Scroll Top
 */

/* If uninstall not called from WordPress exit. */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

/* Delete plugin settings. */
delete_option( 'scroll_top_plugin_settings' );
