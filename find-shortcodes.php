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

if ( is_admin() ) {
	/**
	 * Get all public posts once per page load.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return array
	 */
	function sitecare_fsc_get_posts() {
		static $posts;

		if ( null === $posts ) {
			$types = get_post_types(
				array(
					'public'   => true,
					'_builtin' => true,
				),
				'names'
		 	);

			$posts = get_posts( array(
				'post_type'   => $types,
				'post_status' => 'any',
				'numberposts' => -1,
				'fields'      => 'ids',
			) );
		}

		return empty( $posts ) ? false : $posts;
	}

	/**
	 * Get all posts which contain a given shortcode in the post content.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  string $shortcode The shortcode to check for.
	 * @return array
	 */
	function sitecare_fsc_get_posts_with_shortcode( $shortcode ) {
		if ( ! $posts = sitecare_fsc_get_posts() ) {
			return false;
		}

		$ids_with_shortcodes = array();

		foreach ( $posts as $post_id ) {
			$content = wp_strip_all_tags( get_post_field( 'post_content', $post_id ) );

			if ( has_shortcode( $content, $shortcode ) ) {
				$ids_with_shortcodes[] = $post_id;
			}
		}

		return empty( $ids_with_shortcodes ) ? false : $ids_with_shortcodes;
	}

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

		require_once 'views/shortcodes.php';
	}

	add_action( 'admin_menu', 'sitecare_fsc_admin_page', 20 );
}
