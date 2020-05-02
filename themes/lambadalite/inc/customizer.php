<?php
/**
 * LambadaLite: Customizer
 *
 * @package WordPress
 * @subpackage LambadaLite
 * @since 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lambadalite_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.site-title a',
			'render_callback' => 'lambadalite_customize_partial_blogname',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.site-description',
			'render_callback' => 'lambadalite_customize_partial_blogdescription',
		)
	);
}


function lambadalite_customize_partial_blogname() {
	bloginfo( 'name' );
}

function lambadalite_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function lambadalite_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

function lambadalite_is_view_with_layout_option() {
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

function lambadalite_customize_preview_js() {
	wp_enqueue_script( 'lambadalite-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'lambadalite_customize_preview_js' );

function lambadalite_panels_js() {
	wp_enqueue_script( 'lambadalite-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'lambadalite_panels_js' );

// Upgrade to Pro
function lambadalite_customize_pro_register( $wp_customize ) {	
	require_once trailingslashit( get_template_directory() ) . '/inc/upgrade-to-pro/control.php';
	$wp_customize->register_section_type( 'lambadalite_Customize_Section_Upsell' );
	$wp_customize->add_section(
		new lambadalite_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Curious?', 'lambadalite' ),
				'pro_text' => esc_html__( 'View Lambada Pro', 'lambadalite' ),
				'pro_url'  => 'http://bit.ly/2ufM5eI',
				'priority' => 1,
			)
		)
	);
}
add_action( 'customize_register', 'lambadalite_customize_pro_register' );
function lambadalite_customizer_control_scripts() {
	wp_enqueue_script( 'lambadalite-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/customize-controls.js', array('customize-controls'), '20151215', true );
	wp_enqueue_style( 'lambadalite-customizer', get_template_directory_uri() . '/inc/upgrade-to-pro/customize-controls.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'lambadalite_customizer_control_scripts', 0 );