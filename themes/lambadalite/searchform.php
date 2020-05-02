<?php
/**
 * Template for displaying search forms in LambadaLite
 *
 * @package WordPress
 * @subpackage LambadaLite
 * @since 1.0
 * @version 1.0
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( lambadalite_unique_id( 'search-form-' ) ); ?>">
		<span class="screen-reader-text"><?php esc_html_x( 'Search for:', 'label', 'lambadalite' ); ?></span>
	</label>
	<input type="search" id="<?php echo esc_attr( lambadalite_unique_id( 'search-form-' ) ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'lambadalite' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><?php echo lambadalite_get_svg( array( 'icon' => 'search' ) ); ?><span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'lambadalite' ); ?></span></button>
</form>
