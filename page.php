<?php
/**
 * The template for displaying all pages
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php
$is_shop_page     = false;
$is_cart_page     = false;
$is_checkout_page = false;

$shop_page_id     = function_exists( 'CARTVAI_Settings::get' ) ? (int) CARTVAI_Settings::get( 'shop_page_id', 0 ) : 0;
$cart_page_id     = function_exists( 'CARTVAI_Settings::get' ) ? (int) CARTVAI_Settings::get( 'cart_page_id', 0 ) : 0;
$checkout_page_id = function_exists( 'CARTVAI_Settings::get' ) ? (int) CARTVAI_Settings::get( 'checkout_page_id', 0 ) : 0;

$post_content = get_post() ? (string) get_post()->post_content : '';
$post_name    = get_post() ? (string) get_post()->post_name : '';

if ( ( $shop_page_id && is_page( $shop_page_id ) ) || has_shortcode( $post_content, 'cartvai_shop' ) || is_page( 'shop' ) || 'shop' === $post_name ) {
	$is_shop_page = true;
} elseif ( ( $cart_page_id && is_page( $cart_page_id ) ) || has_shortcode( $post_content, 'cartvai_cart' ) || is_page( 'cart' ) || 'cart' === $post_name ) {
	$is_cart_page = true;
} elseif ( ( $checkout_page_id && is_page( $checkout_page_id ) ) || has_shortcode( $post_content, 'cartvai_checkout' ) || is_page( 'checkout' ) || 'checkout' === $post_name ) {
	$is_checkout_page = true;
}
?>

<?php if ( $is_shop_page ) : ?>
	<?php
	$total_products = class_exists( 'CARTVAI_Products' ) ? CARTVAI_Products::count( array( 'status' => 1, 'exclude_hidden' => true ) ) : 0;
	?>
	<!-- Modern Shop Page Hero Header -->
	<div class="cv-shop-hero cv:bg-white cv:border-b cv:border-gray-200/80 cv:py-8 cv:sm:py-10 cv:mb-8">
		<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8">
			<div class="cv:flex cv:flex-col cv:md:flex-row cv:md:items-center cv:md:justify-between cv:gap-4">
				<div>
					<nav class="cv:flex cv:items-center cv:gap-2 cv:text-xs cv:font-medium cv:text-slate-600 cv:mb-2" aria-label="Breadcrumb">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:cv:text-primary cv:transition-colors"><?php esc_html_e( 'Home', 'cartvai' ); ?></a>
						<span class="cv:text-slate-400">/</span>
						<span class="cv:text-slate-900 cv:font-semibold"><?php the_title(); ?></span>
					</nav>
					<h1 class="cv:text-2xl cv:sm:text-3xl cv:font-black cv:text-gray-950 cv:tracking-tight cv:leading-tight">
						<?php the_title(); ?>
					</h1>
					<p class="cv:text-xs cv:sm:text-sm cv:text-gray-500 cv:mt-1.5 cv:flex cv:items-center cv:gap-2">
						<span><?php printf( esc_html__( 'Showing all %d products', 'cartvai' ), (int) $total_products ); ?></span>
						<span class="cv:inline-block cv:w-1 cv:h-1 cv:rounded-full cv:bg-gray-300"></span>
						<span class="cv:text-emerald-700 cv:font-medium"><?php esc_html_e( '100% Genuine & In Stock', 'cartvai' ); ?></span>
					</p>
				</div>
				<div class="cv:flex cv:items-center cv:gap-3">
					<div class="cv:inline-flex cv:items-center cv:gap-2 cv:px-3.5 cv:py-2 cv:rounded-xl cv:bg-gray-50 cv:border cv:border-gray-200 cv:text-xs cv:font-semibold cv:text-gray-700">
						<svg class="cv:w-4 cv:h-4 cv:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
						<span><?php esc_html_e( 'Fast Nationwide Delivery', 'cartvai' ); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="cv-shop-container cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:pb-16">
		<h2 class="cv:sr-only"><?php esc_html_e( 'Products List', 'cartvai' ); ?></h2>
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>

<?php elseif ( $is_cart_page ) : ?>

	<!-- Modern Cart Page Hero Header -->
	<div class="cv-cart-hero cv:bg-white cv:border-b cv:border-gray-200/80 cv:py-8 cv:sm:py-10 cv:mb-8">
		<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8">
			<div class="cv:flex cv:flex-col cv:md:flex-row cv:md:items-center cv:md:justify-between cv:gap-4">
				<div>
					<nav class="cv:flex cv:items-center cv:gap-2 cv:text-xs cv:font-medium cv:text-slate-600 cv:mb-2" aria-label="Breadcrumb">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:cv:text-primary cv:transition-colors"><?php esc_html_e( 'Home', 'cartvai' ); ?></a>
						<span class="cv:text-slate-400">/</span>
						<a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="hover:cv:text-primary cv:transition-colors"><?php esc_html_e( 'Shop', 'cartvai' ); ?></a>
						<span class="cv:text-slate-400">/</span>
						<span class="cv:text-slate-900 cv:font-semibold"><?php the_title(); ?></span>
					</nav>
					<h1 class="cv:text-2xl cv:sm:text-3xl cv:font-black cv:text-gray-950 cv:tracking-tight cv:leading-tight">
						<?php the_title(); ?>
					</h1>
					<p class="cv:text-xs cv:sm:text-sm cv:text-gray-500 cv:mt-1.5 cv:flex cv:items-center cv:gap-2">
						<span><?php esc_html_e( 'Review and manage your selected items before checkout', 'cartvai' ); ?></span>
						<span class="cv:inline-block cv:w-1 cv:h-1 cv:rounded-full cv:bg-gray-300"></span>
						<span class="cv:text-emerald-700 cv:font-medium"><?php esc_html_e( 'Free Delivery On Eligible Orders', 'cartvai' ); ?></span>
					</p>
				</div>
				<div class="cv:flex cv:items-center cv:gap-3">
					<div class="cv:inline-flex cv:items-center cv:gap-2 cv:px-3.5 cv:py-2 cv:rounded-xl cv:bg-gray-50 cv:border cv:border-gray-200 cv:text-xs cv:font-semibold cv:text-gray-700">
						<svg class="cv:w-4 cv:h-4 cv:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
						<span><?php esc_html_e( 'Guaranteed Safe & Secure Checkout', 'cartvai' ); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="cv-cart-container cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:pb-16">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>

<?php elseif ( $is_checkout_page ) : ?>

	<!-- Modern Checkout Page Hero Header -->
	<div class="cv-checkout-hero cv:bg-white cv:border-b cv:border-gray-200/80 cv:py-8 cv:sm:py-10 cv:mb-8">
		<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8">
			<div class="cv:flex cv:flex-col cv:md:flex-row cv:md:items-center cv:md:justify-between cv:gap-4">
				<div>
					<nav class="cv:flex cv:items-center cv:gap-2 cv:text-xs cv:font-medium cv:text-slate-600 cv:mb-2" aria-label="Breadcrumb">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:cv:text-primary cv:transition-colors"><?php esc_html_e( 'Home', 'cartvai' ); ?></a>
						<span class="cv:text-slate-400">/</span>
						<a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="hover:cv:text-primary cv:transition-colors"><?php esc_html_e( 'Shop', 'cartvai' ); ?></a>
						<span class="cv:text-slate-400">/</span>
						<span class="cv:text-slate-900 cv:font-semibold"><?php the_title(); ?></span>
					</nav>
					<h1 class="cv:text-2xl cv:sm:text-3xl cv:font-black cv:text-gray-950 cv:tracking-tight cv:leading-tight">
						<?php the_title(); ?>
					</h1>
					<p class="cv:text-xs cv:sm:text-sm cv:text-gray-500 cv:mt-1.5 cv:flex cv:items-center cv:gap-2">
						<svg class="cv:w-4 cv:h-4 cv:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
						<span><?php esc_html_e( '256-Bit SSL Encrypted & Fast Checkout', 'cartvai' ); ?></span>
						<span class="cv:inline-block cv:w-1 cv:h-1 cv:rounded-full cv:bg-gray-300"></span>
						<span class="cv:text-emerald-700 cv:font-medium"><?php esc_html_e( '100% Money-Back Guarantee', 'cartvai' ); ?></span>
					</p>
				</div>
				<div class="cv:flex cv:items-center cv:gap-3">
					<div class="cv:inline-flex cv:items-center cv:gap-2 cv:px-3.5 cv:py-2 cv:rounded-xl cv:bg-emerald-50 cv:border cv:border-emerald-200/80 cv:text-xs cv:font-semibold cv:text-emerald-800">
						<svg class="cv:w-4 cv:h-4 cv:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
						<span><?php esc_html_e( 'Bank-Grade SSL Security', 'cartvai' ); ?></span>
					</div>
					<div class="cv:hidden cv:sm:inline-flex cv:items-center cv:gap-2 cv:px-3.5 cv:py-2 cv:rounded-xl cv:bg-gray-50 cv:border cv:border-gray-200 cv:text-xs cv:font-semibold cv:text-gray-700">
						<svg class="cv:w-4 cv:h-4 cv:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
						<span><?php esc_html_e( 'Fast Nationwide Delivery', 'cartvai' ); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="cv-checkout-container cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:pb-16">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>


<?php else : ?>

	<div class="cv-page-wrapper cv:bg-white cv:min-h-screen">
		<div class="cv-page-container cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:py-10 cv:sm:py-14">
			<?php
			while ( have_posts() ) :
				the_post();

				$has_thumb = has_post_thumbnail();
				$ancestors = get_post_ancestors( get_the_ID() );
				$page_desc = has_excerpt() ? get_the_excerpt() : '';
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cv-entry' ); ?>>
					<!-- Breadcrumb Navigation -->
					<nav class="cv-entry__breadcrumb cv:flex cv:items-center cv:gap-2 cv:text-xs cv:font-medium cv:text-slate-500 cv:mb-3 cv:flex-wrap" aria-label="<?php esc_attr_e( 'Breadcrumb', 'cartvai' ); ?>">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:cv:text-primary cv:transition-colors"><?php esc_html_e( 'Home', 'cartvai' ); ?></a>
						<?php
						if ( ! empty( $ancestors ) ) {
							$ancestors = array_reverse( $ancestors );
							foreach ( $ancestors as $ancestor_id ) {
								echo '<span class="cv:text-slate-400">/</span>';
								echo '<a href="' . esc_url( get_permalink( $ancestor_id ) ) . '" class="hover:cv:text-primary cv:transition-colors">' . esc_html( get_the_title( $ancestor_id ) ) . '</a>';
							}
						}
						?>
						<span class="cv:text-slate-400">/</span>
						<span class="cv:text-slate-900 cv:font-semibold"><?php the_title(); ?></span>
					</nav>

					<!-- Page Title Header matching content width -->
					<header class="cv-entry__header cv:mb-8 cv:pb-6 cv:border-b cv:border-gray-200/80">
						<h1 class="cv-entry__title cv:text-3xl cv:sm:text-4xl cv:font-black cv:text-gray-950 cv:tracking-tight cv:leading-tight">
							<?php the_title(); ?>
						</h1>
						<?php if ( ! empty( $page_desc ) ) : ?>
							<p class="cv:text-sm cv:sm:text-base cv:text-gray-500 cv:mt-2 cv:max-w-3xl">
								<?php echo esc_html( $page_desc ); ?>
							</p>
						<?php endif; ?>
					</header>

					<!-- Featured Image (if available) -->
					<?php if ( $has_thumb ) : ?>
						<figure class="cv:mb-8 cv:rounded-2xl cv:overflow-hidden cv:border cv:border-gray-100 cv:shadow-xs">
							<?php the_post_thumbnail( 'full', array( 'class' => 'cv:w-full cv:h-auto cv:max-h-[520px] cv:object-cover' ) ); ?>
						</figure>
					<?php endif; ?>

					<!-- Main Content -->
					<div class="cv-entry__content cv:text-gray-700 cv:text-base cv:leading-relaxed">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before'      => '<div class="page-links cv:mt-10 cv:pt-6 cv:border-t cv:border-gray-100 cv:flex cv:items-center cv:gap-2"><span class="cv:text-xs cv:font-bold cv:text-gray-500 cv:uppercase cv:tracking-wider">' . esc_html__( 'Pages:', 'cartvai' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span class="cv:px-3 cv:py-1 cv:rounded-lg cv:bg-gray-100 cv:text-xs cv:font-semibold cv:text-gray-700 hover:cv:bg-primary hover:cv:text-white cv:transition-colors">',
								'link_after'  => '</span>',
							)
						);
						?>
					</div>
				</article>

				<?php
				if ( comments_open() || get_comments_number() ) :
					?>
					<div class="cv:mt-12 cv:pt-10 cv:border-t cv:border-gray-200/80">
						<?php comments_template(); ?>
					</div>
					<?php
				endif;
				?>
				<?php
			endwhile;
			?>
		</div>
	</div>

<?php endif; ?>

<?php
get_footer();
