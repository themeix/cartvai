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

$commenter     = wp_get_current_commenter();
$user          = wp_get_current_user();
$user_identity = $user->exists() ? $user->display_name : '';
$comment_count = (int) get_comments_number();
?>

<div id="comments" class="cv-comments-area cv:mt-16 cv:pt-12 cv:border-t cv:border-gray-100">
	<?php if ( have_comments() ) : ?>
		<div class="cv-comments-header cv:flex cv:items-center cv:justify-between cv:gap-4 cv:mb-8">
			<h2 class="cv-comments-title cv:text-xl cv:sm:text-2xl cv:font-black cv:text-gray-950 cv:tracking-tight cv:flex cv:items-center cv:gap-3">
				<span><?php esc_html_e( 'Discussion', 'cartvai' ); ?></span>
				<span class="cv:inline-flex cv:items-center cv:justify-center cv:px-3 cv:py-0.5 cv:rounded-full cv:text-xs cv:font-extrabold cv:bg-blue-50 cv:text-primary">
					<?php echo number_format_i18n( $comment_count ); ?>
				</span>
			</h2>
		</div>

		<?php the_comments_navigation(); ?>

		<ol class="cv-comment-list cv:space-y-6 cv:mb-12 cv:list-none cv:p-0">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 44,
					'callback'    => function_exists( 'cartvai_comment_callback' ) ? 'cartvai_comment_callback' : null,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation();

		if ( ! comments_open() ) :
			?>
			<p class="cv-no-comments cv:text-sm cv:text-gray-500 cv:italic cv:mt-4">
				<?php esc_html_e( 'Comments are closed for this article.', 'cartvai' ); ?>
			</p>
			<?php
		endif;
	endif; // have_comments()

	$fields = array(
		'author'  => '<div class="cv:grid cv:grid-cols-1 cv:sm:grid-cols-3 cv:gap-4 cv:mb-4">' .
			'<div class="cv-form-group cv:space-y-1.5">' .
			'<label for="author" class="cv:block cv:text-xs cv:font-bold cv:text-gray-700 cv:uppercase cv:tracking-wider">' . esc_html__( 'Name', 'cartvai' ) . ' <span class="cv:text-red-500">*</span></label>' .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245" required class="cv-input cv:w-full cv:px-3.5 cv:py-2.5 cv:rounded-xl cv:border cv:border-gray-200 cv:bg-white cv:text-sm cv:text-gray-900 cv:placeholder:text-gray-400 cv:focus:outline-none cv:focus:border-primary cv:focus:ring-2 cv:focus:ring-primary/20 cv:transition-all" placeholder="' . esc_attr__( 'Your name', 'cartvai' ) . '">' .
			'</div>',
		'email'   => '<div class="cv-form-group cv:space-y-1.5">' .
			'<label for="email" class="cv:block cv:text-xs cv:font-bold cv:text-gray-700 cv:uppercase cv:tracking-wider">' . esc_html__( 'Email', 'cartvai' ) . ' <span class="cv:text-red-500">*</span></label>' .
			'<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" required class="cv-input cv:w-full cv:px-3.5 cv:py-2.5 cv:rounded-xl cv:border cv:border-gray-200 cv:bg-white cv:text-sm cv:text-gray-900 cv:placeholder:text-gray-400 cv:focus:outline-none cv:focus:border-primary cv:focus:ring-2 cv:focus:ring-primary/20 cv:transition-all" placeholder="' . esc_attr__( 'your@email.com', 'cartvai' ) . '">' .
			'</div>',
		'url'     => '<div class="cv-form-group cv:space-y-1.5">' .
			'<label for="url" class="cv:block cv:text-xs cv:font-bold cv:text-gray-700 cv:uppercase cv:tracking-wider">' . esc_html__( 'Website', 'cartvai' ) . '</label>' .
			'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" class="cv-input cv:w-full cv:px-3.5 cv:py-2.5 cv:rounded-xl cv:border cv:border-gray-200 cv:bg-white cv:text-sm cv:text-gray-900 cv:placeholder:text-gray-400 cv:focus:outline-none cv:focus:border-primary cv:focus:ring-2 cv:focus:ring-primary/20 cv:transition-all" placeholder="https://example.com">' .
			'</div></div>',
		'cookies' => '<div class="cv-cookies-consent cv:flex cv:items-start cv:gap-2.5 cv:text-xs cv:text-gray-600 cv:cursor-pointer cv:my-3">' .
			'<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" class="cv:w-4 cv:h-4 cv:mt-0.5 cv:rounded cv:border-gray-300 cv:text-primary cv:focus:ring-primary">' .
			'<label for="wp-comment-cookies-consent" class="cv:cursor-pointer">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'cartvai' ) . '</label>' .
			'</div>',
	);

	comment_form(
		array(
			'title_reply_before'   => '<div class="cv-respond-header cv:mb-6"><h3 id="reply-title" class="cv:text-xl cv:font-bold cv:text-gray-900 cv:tracking-tight">',
			'title_reply_after'    => '</h3>',
			'cancel_reply_before'  => ' <span class="cv:inline-block cv:ml-3">',
			'cancel_reply_after'   => '</span></div>',
			'cancel_reply_link'    => esc_html__( 'Cancel reply', 'cartvai' ),
			'comment_notes_before' => '<p class="cv:text-xs cv:text-gray-500 cv:mb-6">' . esc_html__( 'Your email address will not be published. Required fields are marked *', 'cartvai' ) . '</p>',
			'comment_notes_after'  => '',
			'class_container'      => 'cv-comment-respond cv:mt-12 cv:p-6 cv:sm:p-8 cv:rounded-2xl cv:bg-gray-50/70 cv:border cv:border-gray-100',
			'class_form'           => 'cv-comment-form cv:space-y-4',
			'comment_field'        => '<div class="cv-comment-field cv:space-y-1.5 cv:mb-4">' .
				'<label for="comment" class="cv:block cv:text-xs cv:font-bold cv:text-gray-700 cv:uppercase cv:tracking-wider">' . esc_html__( 'Comment', 'cartvai' ) . ' <span class="cv:text-red-500">*</span></label>' .
				'<textarea id="comment" name="comment" cols="45" rows="5" maxlength="65525" required class="cv-textarea cv:w-full cv:px-4 cv:py-3 cv:rounded-xl cv:border cv:border-gray-200 cv:bg-white cv:text-sm cv:text-gray-900 cv:placeholder:text-gray-400 cv:focus:outline-none cv:focus:border-primary cv:focus:ring-2 cv:focus:ring-primary/20 cv:transition-all cv:resize-y cv:min-h-[120px]" placeholder="' . esc_attr__( 'Write your comment or review here...', 'cartvai' ) . '"></textarea>' .
				'</div>',
			'fields'               => $fields,
			'submit_button'        => '<button type="submit" name="%1$s" id="%2$s" class="%3$s">%4$s</button>',
			'class_submit'         => 'cv-btn cv-btn-primary cv:inline-flex cv:items-center cv:justify-center cv:gap-2 cv:px-6 cv:py-3 cv:rounded-xl cv:text-sm cv:font-bold cv:bg-primary cv:text-white cv:hover:bg-primary-hover cv:transition-all cv:shadow-sm cv:hover:shadow-md cv:hover:-translate-y-0.5 cv:cursor-pointer',
			'submit_field'         => '<div class="form-submit cv:pt-2">%1$s %2$s</div>',
		)
	);
	?>
</div>

