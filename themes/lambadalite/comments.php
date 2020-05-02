<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage LambadaLite
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h4 class="comments-title">
			<?php
			$lambadalite_comments_number = get_comments_number();
			if ( '1' === $lambadalite_comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'lambadalite' ), get_the_title() );
			} else {
				echo esc_html(
					sprintf(
						/* translators: %s: post title */
					   _nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$lambadalite_comments_number,
						'comments title',
						'lambadalite'
					),
					number_format_i18n( $lambadalite_comments_number ),
					get_the_title()
					)
				);
			}
			?>
		</h4>

		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'avatar_size' => 100,
						'style'       => 'ol',
						'short_ping'  => true,
						'reply_text'  => lambadalite_get_svg( array( 'icon' => 'mail-reply' ) ) . __( 'Reply', 'lambadalite' ),
					)
				);
			?>
		</ol>

		<?php
		the_comments_pagination(
			array(
				'prev_text' => lambadalite_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous', 'lambadalite' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'lambadalite' ) . '</span>' . lambadalite_get_svg( array( 'icon' => 'arrow-right' ) ),
			)
		);

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'lambadalite' ); ?></p>
		<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
