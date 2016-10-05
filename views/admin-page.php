<?php
/**
 * Template part for displaying all theme and plugin slugs.
 *
 * @package   FindShortcodes\Admin\Views
 * @copyright Copyright (c) 2016, WP Site Care, LLC
 * @license   MIT
 * @since     0.1.0
 */

?>
<style>
@media only screen and (min-width: 810px) {
	.scfsc-one-half {
		width: 47.3684210526%;
		float: left;
		margin-right: 5.2631578947%;
	}

	.scfsc-last {
		float: right;
		margin-right: 0;
	}
}
</style>

<div id="sc-find-shortcodes" class="wrap sc-find-shortcodes">

	<h1>Find Shortcodes</h1>

	<?php require_once SCFSC_DIR . 'views/form.php'; ?>

	<?php if ( ! empty( $shortcode ) ) : ?>

		<section id="found-shortcodes-container" class="found-shortcodes-container">

			<?php if ( $posts = scfsc_get_content_shortcodes_ids( esc_attr( $shortcode ) ) ) : ?>

				<?php require_once SCFSC_DIR . 'views/post-shortcodes.php'; ?>

			<?php endif; ?>

			<?php if ( $meta = scfsc_get_meta_shortcodes_ids( esc_attr( $shortcode ) ) ) : ?>

				<?php require_once SCFSC_DIR . 'views/meta-shortcodes.php'; ?>

			<?php endif; ?>

			<?php if ( ! $posts && ! $meta ) : ?>

				<h2>No posts with the <?php echo esc_attr( $shortcode ); ?> shortcode could be found.</h2>

			<?php endif; ?>

		</section><!-- #found-shortcodes-container -->

	<?php endif; ?>


</div><!-- #sc-find-shortcodes -->
