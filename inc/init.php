<?php
/**
 * Kick off all actions, filters, and other functionality initialization.
 *
 * @package   FindShortcodes\Init
 * @copyright Copyright (c) 2016, WP Site Care, LLC
 * @license   MIT
 * @since     0.1.0
 */

defined( 'WPINC' ) || die;

add_action( 'admin_menu', 'scfsc_admin_page', 20 );
