<?php
/**
 * Functions for initializing and loading templates.
 *
 * @package   FindShortcodes\Functions
 * @copyright Copyright (c) 2016, WP Site Care, LLC
 * @license   MIT
 * @since     0.1.0
 */

/**
 * Add a menu item to the tools page.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function sitecare_fsc_admin_page() {
	add_management_page(
		'Shortcodes',
		'Shortcodes',
		'manage_options',
		'sc-find-shortcodes-admin',
		'sitecare_fsc_admin_page_template'
	);
}

/**
 * Load the template for the admin page.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function sitecare_fsc_admin_page_template() {
	$data = false;

	if ( ! empty( $_POST ) && check_admin_referer( 'find_shortcode', 'sitecare_fsc_submit_form' ) ) {
		$data = wp_unslash( $_POST );
	}

	$shortcode = empty( $data['sitecare_fsc_shortcode'] ) ? '' : $data['sitecare_fsc_shortcode'];

	require_once SITECARE_FSC_DIR . 'views/admin-page.php';
}
