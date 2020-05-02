<?php
/**
* Template Name: Free Style
*
 * @package WordPress
 * @subpackage LambadaLite
 * @since 1.0
 * @version 1.0
*/

get_header(); ?>

<div class="wrap">

	<div class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
			if ( have_posts() ) : ?>				

				<?php while ( have_posts() ) : ?>
				
					<?php the_post(); ?>
					
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="entry-content">
                            <?php
                                the_content();
                                ?>
                        </div><!-- .entry-content -->
                    </div><!-- #post-## -->
					
				<?php endwhile; ?>				

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
</div><!-- .wrap -->

<?php
get_footer();
