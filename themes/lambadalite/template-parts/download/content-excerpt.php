<?php
/**
 * Template part for displaying posts with excerpts
 *
 * Used in Search Results and for Recent Posts in Front Page panels.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage LambadaLite
 * @since 1.0
 * @version 1.0
 */

?>
<div class="col-4 mas-item">
<article id="post-<?php the_ID(); ?>" <?php post_class('excerpt-box excerpt-download p-0 mb-30'); ?>>

	<?php if ( '' !== get_the_post_thumbnail() ) : ?>
		<div class="post-thumbnail mb-0">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'lambadalite-featured-image' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="p-30-20">

	<header class="entry-header">

		<?php
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		?>
	</header><!-- .entry-header -->


	<?php if(function_exists('edd_price')) { ?>
		<div class="product-price">
			<?php 
				if(edd_has_variable_prices(get_the_ID())) {
					// if the download has variable prices, show the first one as a starting price
					_e( 'Starting at: ', 'lambadalite' ); edd_price(get_the_ID());
				} else {
					edd_price(get_the_ID()); 
				}
			?>
		</div><!--end .product-price-->
	<?php } ?>

	<?php if(function_exists('edd_price')) { ?>
		<div class="product-buttons">
			<?php if(!edd_has_variable_prices(get_the_ID())) { ?>
				<?php echo edd_get_purchase_link(get_the_ID()); ?>
			<?php } else { ?>
			<a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e('View Details', 'lambadalite');?></a>
		</div><!--end .product-buttons-->
	<?php } } ?>

	</div>

</article><!-- #post-## -->
</div>