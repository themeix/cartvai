<?php
/**
 * The footer for Cartvai Base Theme
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	</main><!-- #primary -->

	<?php
	$footer_style = function_exists( 'cartvai_get_footer_style' ) ? cartvai_get_footer_style() : 'ecommerce';
	get_template_part( 'template-parts/footer/' . $footer_style );
	?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
