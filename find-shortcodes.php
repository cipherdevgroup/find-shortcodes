<?php
/**
 * Plugin Name: Find Shortcodes
 * Plugin URI:  https://www.wpsitecare.com
 * Description: Find shortcodes in the WordPress post content.
 * Version:     0.1.0
 * Author:      Robert Neu
 * Author URI:  http://robneu.com
 * License:     MIT
 * License URI: http://wpsitecare.mit-license.org/
 *
 * @package   FindShortcodes
 * @copyright Copyright (c) 2016, WP Site Care, LLC
 * @license   MIT
 * @since     0.1.0
 */

/**
 * The absolute path to the plugin's root directory with a trailing slash.
 *
 * @since 0.1.0
 * @uses  plugin_dir_path()
 */
define( 'SITECARE_FSC_DIR', plugin_dir_path( __FILE__ ) );

add_action( 'plugins_loaded', 'sitecare_fsc_load_plugin', 99 );
/**
 * Load the plugin.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function sitecare_fsc_load_plugin() {
	if ( is_admin() ) {
		require_once SITECARE_FSC_DIR . 'inc/template.php';
		require_once SITECARE_FSC_DIR . 'inc/utility.php';
		require_once SITECARE_FSC_DIR . 'inc/init.php';
	}
}
