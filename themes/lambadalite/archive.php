<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage LambadaLite
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">

	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
			if ( have_posts() ) : ?>

				<div class="mas-grid">

				<?php while ( have_posts() ) : ?>
				
					<?php the_post(); ?>
					
						<?php get_template_part( 'template-parts/post/content', 'excerpt'); ?>
					
				<?php endwhile; ?>

				</div>

				<?php the_posts_pagination(
					array(
						'prev_text'          => lambadalite_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'lambadalite' ) . '</span>',
						'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'lambadalite' ) . '</span>' . lambadalite_get_svg( array( 'icon' => 'arrow-right' ) ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'lambadalite' ) . ' </span>',
					)
				);

			else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php
get_footer();
