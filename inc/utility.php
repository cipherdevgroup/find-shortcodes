<?php
/**
 * Functions for searching the database for shortcodes.
 *
 * @package   FindShortcodes\Functions
 * @copyright Copyright (c) 2016, WP Site Care, LLC
 * @license   MIT
 * @since     0.1.0
 */

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
				'_builtin' => true,
				'public'   => true,
			),
			'names'
		);

		$custom_types = get_post_types(
			array(
				'_builtin' => false,
			),
			'names'
		);

		$posts = get_posts( array(
			'post_type'   => array_merge( $types, $custom_types ),
			'post_status' => 'any',
			'numberposts' => -1,
			'fields'      => 'ids',
		) );
	}

	return empty( $posts ) ? false : $posts;
}

/**
 * Similar to WP's get_shortcode_regex(), but matches for anything that looks
 * like a shortcode.
 *
 * @since  0.1.0
 * @return string The regexp for finding shortcodes in a text
 */
function sitecare_fsc_shortcode_regex() {
	$tagregexp = '[a-zA-Z_\-][0-9a-zA-Z_\-\+]{2,}';

	// WARNING! Do not change this regex without changing do_shortcode_tag()
	return '(?!<.*)'                         // Non-capturing check that text within HTML tags are skipped
		. '\\['                              // Opening bracket
		. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
		. "($tagregexp)"                     // 2: Shortcode name
		. '(?![\\w-])'                       // Not followed by word character or hyphen
		. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
		.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
		.     '(?:'
		.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
		.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
		.     ')*?'
		. ')'
		. '(?:'
		.     '(\\/)'                        // 4: Self closing tag ...
		.     '\\]'                          // ... and closing bracket
		. '|'
		.     '\\]'                          // Closing bracket
		.     '(?:'
		.         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
		.             '[^\\[]*+'             // Not an opening bracket
		.             '(?:'
		.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
		.                 '[^\\[]*+'         // Not an opening bracket
		.             ')*+'
		.         ')'
		.         '\\[\\/\\2\\]'             // Closing shortcode tag
		.     ')?'
		. ')'
		. '(\\]?)'                           // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
		. '(?![^<>]*>)';                     // Non-capturing check that text within HTML tags are skipped
}

/**
 * Whether the passed content contains the specified shortcode. Similar to Core's
 * has_shortcode, but doesn't care if the shortcode is registered.
 *
 * @since  0.1.0
 *
 * @global array $shortcode_tags
 *
 * @param string $content Content to search for shortcodes.
 * @param string $tag     Shortcode tag to check.
 * @return bool Whether the passed content contains the given shortcode.
 */
function sitecare_fsc_has_shortcode( $content, $tag ) {
	if ( false === strpos( $content, '[' ) ) {
		return false;
	}

	preg_match_all( '/' . sitecare_fsc_shortcode_regex() . '/', $content, $matches, PREG_SET_ORDER );

	if ( empty( $matches ) ) {
		return false;
	}

	foreach ( $matches as $shortcode ) {
		if ( $tag === $shortcode[2] ) {
			return true;
		} elseif ( ! empty( $shortcode[5] ) && sitecare_fsc_has_shortcode( $shortcode[5], $tag ) ) {
			return true;
		}
	}

	return false;
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

		if ( sitecare_fsc_has_shortcode( $content, $shortcode ) ) {
			$ids_with_shortcodes[] = $post_id;
		}
	}

	return empty( $ids_with_shortcodes ) ? false : $ids_with_shortcodes;
}
