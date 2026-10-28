<?php
/**
 * The template for displaying all single posts
 *
 * Implements a modern, seamless, editorial reading layout without
 * the enclosed card/box container.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="cv-single-post-wrapper cv:bg-white cv:min-h-screen">
	<div class="cv-single-container cv:max-w-4xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:py-10 cv:sm:py-16">
		<?php
		while ( have_posts() ) :
			the_post();

			// Categorization & Reading Time
			$categories   = get_the_category();
			$primary_cat  = ! empty( $categories ) ? $categories[0] : null;
			$blog_page_id = (int) get_option( 'page_for_posts' );
			$blog_url     = $blog_page_id ? get_permalink( $blog_page_id ) : home_url( '/' );

			$post_content = get_post_field( 'post_content', get_the_ID() );
			$word_count   = str_word_count( strip_tags( (string) $post_content ) );
			$reading_time = max( 1, (int) ceil( $word_count / 200 ) );

			$author_id    = get_the_author_meta( 'ID' );
			$author_desc  = get_the_author_meta( 'description' );
			$author_name  = get_the_author_meta( 'display_name' );
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'cv-entry' ); ?>>
				<!-- Header Section -->
				<header class="cv-entry__header cv:mb-8 cv:sm:mb-10">
					<!-- Breadcrumb -->
					<nav class="cv-entry__breadcrumb cv:flex cv:items-center cv:gap-2 cv:text-xs cv:font-medium cv:text-gray-400 cv:mb-4 cv:overflow-x-auto cv:whitespace-nowrap" aria-label="Breadcrumb">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cv:hover:text-primary cv:transition-colors"><?php esc_html_e( 'Home', 'cartvai' ); ?></a>
						<span>/</span>
						<?php if ( $blog_page_id ) : ?>
							<a href="<?php echo esc_url( $blog_url ); ?>" class="cv:hover:text-primary cv:transition-colors"><?php echo esc_html( get_the_title( $blog_page_id ) ); ?></a>
							<span>/</span>
						<?php endif; ?>
						<?php if ( $primary_cat ) : ?>
							<a href="<?php echo esc_url( get_category_link( $primary_cat->term_id ) ); ?>" class="cv:hover:text-primary cv:transition-colors"><?php echo esc_html( $primary_cat->name ); ?></a>
							<span>/</span>
						<?php endif; ?>
						<span class="cv:text-gray-600 cv:truncate cv:max-w-xs"><?php the_title(); ?></span>
					</nav>

					<?php if ( $primary_cat ) : ?>
						<div class="cv-entry__category cv:mb-4">
							<a href="<?php echo esc_url( get_category_link( $primary_cat->term_id ) ); ?>" class="cv:inline-flex cv:items-center cv:gap-1.5 cv:px-3.5 cv:py-1 cv:rounded-full cv:text-xs cv:font-bold cv:bg-blue-50 cv:text-primary cv:hover:bg-primary cv:hover:text-white cv:transition-all">
								<span><?php echo esc_html( $primary_cat->name ); ?></span>
							</a>
						</div>
					<?php endif; ?>

					<h1 class="cv-entry__title cv:text-3xl cv:sm:text-4xl cv:md:text-5xl cv:font-black cv:text-gray-950 cv:tracking-tight cv:leading-[1.18] cv:mb-6">
						<?php the_title(); ?>
					</h1>

					<!-- Author & Meta Row -->
					<div class="cv-entry__meta-bar cv:flex cv:flex-wrap cv:items-center cv:justify-between cv:gap-4 cv:py-4 cv:border-y cv:border-gray-100">
						<div class="cv:flex cv:items-center cv:gap-3.5">
							<div class="cv:shrink-0">
								<?php echo get_avatar( $author_id, 48, '', '', array( 'class' => 'cv:w-11 cv:h-11 cv:rounded-full cv:object-cover cv:ring-2 cv:ring-gray-100' ) ); ?>
							</div>
							<div>
								<div class="cv:font-bold cv:text-gray-900 cv:text-sm cv:sm:text-base">
									<?php the_author(); ?>
								</div>
								<div class="cv:flex cv:items-center cv:gap-2 cv:text-xs cv:text-gray-500 cv:mt-0.5">
									<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
										<?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
									</time>
									<span>&bull;</span>
									<span><?php printf( esc_html__( '%d min read', 'cartvai' ), (int) $reading_time ); ?></span>
								</div>
							</div>
						</div>

						<div class="cv:flex cv:items-center cv:gap-2">
							<button type="button" class="cv-copy-link-btn cv:inline-flex cv:items-center cv:gap-2 cv:px-3.5 cv:py-2 cv:rounded-xl cv:border cv:border-gray-200 cv:bg-white cv:hover:bg-gray-50 cv:hover:border-gray-300 cv:text-xs cv:font-semibold cv:text-gray-700 cv:transition-all cv:shadow-xs cv:cursor-pointer" data-url="<?php echo esc_url( get_permalink() ); ?>" title="<?php esc_attr_e( 'Copy link to article', 'cartvai' ); ?>">
								<svg class="cv:w-4 cv:h-4 cv:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
								<span class="cv-copy-link-text"><?php esc_html_e( 'Share', 'cartvai' ); ?></span>
							</button>
						</div>
					</div>
				</header>

				<!-- Featured Image Hero -->
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="cv-entry__thumbnail cv:mb-10 cv:sm:mb-12 cv:rounded-2xl cv:overflow-hidden cv:bg-gray-50 cv:shadow-xs">
						<?php the_post_thumbnail( 'full', array( 'class' => 'cv:w-full cv:h-auto cv:max-h-[560px] cv:object-cover cv:object-center' ) ); ?>
						<?php
						$caption = get_the_post_thumbnail_caption();
						if ( $caption ) :
							?>
							<figcaption class="cv:text-center cv:text-xs cv:text-gray-500 cv:mt-3 cv:italic">
								<?php echo esc_html( $caption ); ?>
							</figcaption>
							<?php
						endif;
						?>
					</figure>
				<?php endif; ?>

				<!-- Prose Content -->
				<div class="cv-entry__content cv:prose cv:prose-lg cv:max-w-none cv:text-gray-700">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links cv:mt-8 cv:flex cv:gap-2">' . esc_html__( 'Pages:', 'cartvai' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>

				<!-- Article Footer (Tags) -->
				<?php
				$tags = get_the_tags();
				if ( $tags ) :
					?>
					<div class="cv-entry__tags-section cv:pt-8 cv:mt-12 cv:border-t cv:border-gray-100 cv:flex cv:flex-wrap cv:items-center cv:gap-2">
						<span class="cv:text-xs cv:font-bold cv:text-gray-400 cv:uppercase cv:tracking-wider cv:mr-1"><?php esc_html_e( 'Tags:', 'cartvai' ); ?></span>
						<?php foreach ( $tags as $tag ) : ?>
							<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="cv:inline-flex cv:items-center cv:px-3 cv:py-1.5 cv:rounded-xl cv:bg-gray-100 cv:hover:bg-gray-200 cv:text-gray-700 cv:text-xs cv:font-medium cv:transition-colors">
								#<?php echo esc_html( $tag->name ); ?>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<!-- Author Bio Card -->
				<div class="cv-entry__author-box cv:mt-10 cv:p-6 cv:sm:p-8 cv:rounded-2xl cv:bg-gray-50/80 cv:border cv:border-gray-100 cv:flex cv:flex-col cv:sm:flex-row cv:items-start cv:sm:items-center cv:gap-5">
					<div class="cv:shrink-0">
						<?php echo get_avatar( $author_id, 72, '', '', array( 'class' => 'cv:w-16 cv:h-16 cv:rounded-full cv:ring-4 cv:ring-white cv:shadow-xs cv:object-cover' ) ); ?>
					</div>
					<div class="cv:flex-1">
						<div class="cv:text-xs cv:font-bold cv:text-gray-400 cv:uppercase cv:tracking-wider cv:mb-1"><?php esc_html_e( 'Written by', 'cartvai' ); ?></div>
						<h4 class="cv:text-lg cv:font-bold cv:text-gray-900 cv:mb-1.5"><?php echo esc_html( $author_name ); ?></h4>
						<?php if ( ! empty( $author_desc ) ) : ?>
							<p class="cv:text-sm cv:text-gray-600 cv:leading-relaxed cv:m-0"><?php echo esc_html( $author_desc ); ?></p>
						<?php else : ?>
							<p class="cv:text-sm cv:text-gray-500 cv:leading-relaxed cv:m-0"><?php printf( esc_html__( 'Content creator and regular author at %s.', 'cartvai' ), esc_html( get_bloginfo( 'name' ) ) ); ?></p>
						<?php endif; ?>
					</div>
				</div>

				<!-- Previous & Next Article Navigation -->
				<?php
				$prev_post = get_previous_post();
				$next_post = get_next_post();
				if ( $prev_post || $next_post ) :
					?>
					<nav class="cv-entry__post-nav cv:mt-10 cv:pt-8 cv:border-t cv:border-gray-100 cv:grid cv:grid-cols-1 cv:sm:grid-cols-2 cv:gap-4" aria-label="<?php esc_attr_e( 'Post navigation', 'cartvai' ); ?>">
						<?php if ( $prev_post ) : ?>
							<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="cv:group cv:p-5 cv:rounded-2xl cv:border cv:border-gray-100 cv:hover:border-gray-200 cv:bg-gray-50/50 cv:hover:bg-gray-50 cv:transition-all cv:flex cv:flex-col cv:justify-between">
								<span class="cv:inline-flex cv:items-center cv:gap-1.5 cv:text-xs cv:font-semibold cv:text-gray-400 cv:group-hover:text-primary cv:transition-colors cv:mb-2">
									<svg class="cv:w-4 cv:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
									<span><?php esc_html_e( 'Previous Article', 'cartvai' ); ?></span>
								</span>
								<span class="cv:text-sm cv:font-bold cv:text-gray-900 cv:group-hover:text-primary cv:transition-colors cv:line-clamp-2">
									<?php echo esc_html( get_the_title( $prev_post->ID ) ); ?>
								</span>
							</a>
						<?php else : ?>
							<div></div>
						<?php endif; ?>

						<?php if ( $next_post ) : ?>
							<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="cv:group cv:p-5 cv:rounded-2xl cv:border cv:border-gray-100 cv:hover:border-gray-200 cv:bg-gray-50/50 cv:hover:bg-gray-50 cv:transition-all cv:flex cv:flex-col cv:justify-between cv:sm:text-right">
								<span class="cv:inline-flex cv:items-center cv:justify-end cv:gap-1.5 cv:text-xs cv:font-semibold cv:text-gray-400 cv:group-hover:text-primary cv:transition-colors cv:mb-2">
									<span><?php esc_html_e( 'Next Article', 'cartvai' ); ?></span>
									<svg class="cv:w-4 cv:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
								</span>
								<span class="cv:text-sm cv:font-bold cv:text-gray-900 cv:group-hover:text-primary cv:transition-colors cv:line-clamp-2">
									<?php echo esc_html( get_the_title( $next_post->ID ) ); ?>
								</span>
							</a>
						<?php endif; ?>
					</nav>
				<?php endif; ?>
			</article>

			<!-- Comments Section -->
			<?php
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
			<?php
		endwhile;
		?>
	</div>
</div>

<?php
get_footer();
