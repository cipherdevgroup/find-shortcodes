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
<div id="found-shortcodes-post-content" class="found-shortcodes-post-content scfsc-one-half">

	<h2>Posts with the <code><?php echo esc_attr( $shortcode ); ?></code> shortcode in the post content</h2>

	<ul>
		<?php foreach ( $posts as $post_id ) : ?>

			<li>
				<p>
					<code><?php echo $post_id; ?></code> -
					<a target="_blank" href="<?php echo get_permalink( $post_id ); ?>">
						<?php echo get_the_title( $post_id ); ?>
					</a>
				</p>
			</li>

		<?php endforeach; ?>
	</ul>

</div><!-- #found-shortcodes-post-content -->
