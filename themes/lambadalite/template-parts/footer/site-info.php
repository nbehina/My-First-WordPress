<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage LambadaLite
 * @since 1.0
 * @version 1.0
 */

?>
<div class="site-info">
	<?php
	if ( function_exists( 'the_privacy_policy_link' ) ) {
		the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
	}
	?>	
    <?php $lambadalite_blog_info = get_bloginfo( 'name' ); ?>
    <?php if ( ! empty( $lambadalite_blog_info ) ) : ?>
    <?php esc_html_e('Copyright &copy ', 'lambadalite'); ?> <?php echo date_i18n( esc_html( "Y", 'lambadalite' ), strtotime( get_the_date() ) ); ?>
      <a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
    <?php endif; ?>  
   
	<div class="alignright">     
      <a href="<?php echo esc_url('https://www.wowthemes.net/premium-themes-templates?utm_source=wporg', 'lambadalite'); ?>" class="imprint">
      <?php
      /* translators: %s: WordPress. */
      printf( __( 'Lambada Theme by %s.', 'lambadalite' ), 'Wow Themes' );
      ?>
      </a>      
	</div>
		
</div><!-- .site-info -->
