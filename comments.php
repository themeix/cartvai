<?php
/**
 * The template for displaying comments
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="cv-comments-area cv:mt-16 cv:pt-12 cv:border-t cv:border-gray-100">
	<?php if ( have_comments() ) : ?>
		<h2 class="cv-comments-title cv:text-xl cv:sm:text-2xl cv:font-bold cv:text-gray-900 cv:mb-8 cv:tracking-tight">
			<?php
			$cartvai_comment_count = get_comments_number();
			if ( '1' === $cartvai_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'cartvai' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $cartvai_comment_count, 'comments title', 'cartvai' ) ),
					number_format_i18n( $cartvai_comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="cv-comment-list cv:space-y-6 cv:mb-10 cv:list-none cv:p-0">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, leave a little note.
		if ( ! comments_open() ) :
			?>
			<p class="cv-no-comments cv:text-sm cv:text-gray-500 cv:italic cv:mt-4">
				<?php esc_html_e( 'Comments are closed.', 'cartvai' ); ?>
			</p>
			<?php
		endif;

	endif; // have_comments()

	comment_form(
		array(
			'class_form'         => 'cv-comment-form cv:space-y-4',
			'title_reply_before' => '<h3 id="reply-title" class="cv:text-xl cv:font-bold cv:text-gray-900 cv:mb-2 cv:tracking-tight">',
			'title_reply_after'  => '</h3>',
			'class_submit'       => 'cv-btn cv-btn-primary cv:inline-flex cv:items-center cv:justify-center cv:px-6 cv:py-2.5 cv:rounded-xl cv:text-sm cv:font-bold cv:bg-primary cv:text-white hover:cv:bg-primary-hover cv:transition-colors cv:shadow-sm cv:cursor-pointer',
		)
	);
	?>
</div>
