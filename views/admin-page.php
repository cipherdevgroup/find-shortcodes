<?php
/**
 * Template part for displaying all theme and plugin slugs.
 *
 * @package   FindShortcodes\Admin\Views
 * @copyright Copyright (c) 2016, WP Site Care, LLC
 * @license   MIT
 * @since     0.1.0
 */

$shortcode = empty( $data['sitecare_fsc_shortcode'] ) ? '' : $data['sitecare_fsc_shortcode'];
?>
<div id="sc-find-shortcodes" class="wrap sc-find-shortcodes">
	<h1>Find Shortcodes</h1>

	<form method="post" class="shortcode-search-form">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="sitecare_fsc_shortcode">Shortcode</label></th>
					<td><input name="sitecare_fsc_shortcode" id="sitecare_fsc_shortcode" value="<?php echo esc_attr( $shortcode ); ?>" class="regular-text" type="text"></td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<button type="submit" name="sitecare_fsc_submit" id="submit" class="button button-primary" >
				<?php esc_html_e( 'Search for Shortcode' ); ?>
			</button>
		</p>

		<?php wp_nonce_field( 'find_shortcode', 'sitecare_fsc_submit_form' ); ?>
	</form>

	<?php if ( ! empty( $shortcode ) ) : ?>

		<section id="found-shortcodes-content" class="found-shortcodes-content">

			<?php if ( $posts = sitecare_fsc_get_posts_with_shortcode( esc_attr( $shortcode ) ) ) : ?>

				<h2>Posts with the <code><?php echo esc_attr( $shortcode ); ?></code> Shortcode</h2>

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

			<?php else : ?>

				<h2>No posts with the <?php echo esc_attr( $shortcode ); ?> Shortcode could be found.</h2>

			<?php endif; ?>

		</section><!-- #found-shortcodes-content -->

	<?php endif; ?>

</div><!-- #sc-find-shortcodes -->
