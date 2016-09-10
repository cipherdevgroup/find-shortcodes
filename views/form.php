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
