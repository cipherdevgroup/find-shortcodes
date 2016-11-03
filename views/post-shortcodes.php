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
<div id="found-shortcodes-post-content" class="found-shortcodes-post-content scfsc-one-half postbox">

	<h3 class="scfsc-title">
		Posts With the <code><?php echo esc_attr( $shortcode ); ?></code> Shortcode in the Post Content
	</h3>

	<table class="widefat fixed striped posts">
		<thead>
			<tr>
				<th scope="col" id="title" class="manage-column column-title column-primary scfsc-post-id">
					<span>ID</span>
				</th>

				<th scope="col" id="title" class="manage-column column-title column-primary">
					<span>Title</span>
				</th>
			</tr>
		</thead>

		<tbody id="the-list">

			<?php foreach ( $posts as $post_id ) : ?>

				<tr>
					<td class="scfsc-post-id">
						<code><?php echo $post_id; ?></code>
					</td>

					<td class="scfsc-post-link">
						<a target="_blank" href="<?php echo get_edit_post_link( $post_id ); ?>">
							<?php echo get_the_title( $post_id ); ?>
						</a>
					</td>

				</tr>

			<?php endforeach; ?>

		</tbody>
	</table>

</div><!-- #found-shortcodes-post-content -->
