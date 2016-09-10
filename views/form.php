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
				<th scope="row"><label for="scfsc_shortcode">Shortcode</label></th>
				<td><input name="scfsc_shortcode" id="scfsc_shortcode" value="<?php echo esc_attr( $shortcode ); ?>" class="regular-text" type="text"></td>
			</tr>
		</tbody>
	</table>

	<p class="submit">
		<button type="submit" name="scfsc_submit" id="submit" class="button button-primary" >
			<?php esc_html_e( 'Search for Shortcode' ); ?>
		</button>
	</p>

	<?php wp_nonce_field( 'find_shortcode', 'scfsc_submit_form' ); ?>
</form>
