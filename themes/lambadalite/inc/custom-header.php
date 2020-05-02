<?php
/**
 * Custom header implementation
 *
 * @link https://codex.wordpress.org/Custom_Headers
 *
 * @package WordPress
 * @subpackage LambadaLite
 * @since 1.0
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses lambadalite_header_style()
 */
function lambadalite_custom_header_setup() {

	/**
	 * Filter LambadaLite custom-header support arguments.
	 *
	 * @since LambadaLite 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-image          Default image of the header.
	 *     @type int    $width                  Width in pixels of the custom header image. Default 954.
	 *     @type int    $height                 Height in pixels of the custom header image. Default 1300.
	 *     @type string $flex-height            Flex support for height of header.
	 *     @type string $wp-head-callback       Callback function used to styles the header image and text
	 *                                          displayed on the blog.
	 * }
	 */
	add_theme_support(
		'custom-header',
		apply_filters(
			'lambadalite_custom_header_args',
			array(
				'default-image'    => get_parent_theme_file_uri( '/assets/images/header.jpg' ),
				'width'            => 1920,
				'height'           => 249,
				'flex-height'      => false,
				'wp-head-callback' => 'lambadalite_header_style',
			)
		)
	);

	register_default_headers(
		array(
			'default-image' => array(
				'url'           => '%s/assets/images/header.jpg',
				'thumbnail_url' => '%s/assets/images/header.jpg',
				'description'   => __( 'Default Header Image', 'lambadalite' ),
			),
		)
	);
}
add_action( 'after_setup_theme', 'lambadalite_custom_header_setup' );

if ( ! function_exists( 'lambadalite_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see lambadalite_custom_header_setup().
	 */
	function lambadalite_header_style() {
		$header_text_color = get_header_textcolor();

		// If no custom options for text are set, let's bail.
		// get_header_textcolor() options: add_theme_support( 'custom-header' ) is default, hide text (returns 'blank') or any hex value.
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style id="lambadalite-custom-header-styles" type="text/css">
		<?php
		// Has the text been hidden?
		if ( 'blank' === $header_text_color ) :
			?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
		.site-title a,
		.colors-dark .site-title a,
		.colors-custom .site-title a,
		body.has-header-image .site-title a,
		body.has-header-image.colors-dark .site-title a,
		body.has-header-image.colors-custom .site-title a,
		.site-description,
		.colors-dark .site-description,
		.colors-custom .site-description,
		body.has-header-image .site-description,
		body.has-header-image.colors-dark .site-description,
		body.has-header-image.colors-custom .site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
		<?php
	}
endif;

