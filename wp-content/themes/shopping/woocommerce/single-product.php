<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
	<div id="main">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?php
					/**
					 * woocommerce_before_single_product hook
					 *
					 * @hooked wc_print_notices - 10
					 */
					do_action( 'woocommerce_before_single_product' );

					if ( post_password_required() ) {
				 		echo get_the_password_form();
					 	return;
				 	}?>
	          		<?php woocommerce_breadcrumb();?>
		        </div>
				<?php //get_sidebar();?>
				<div class="col-lg-12 col-sm-12 col-xs-12">
					<div class="content-main">
						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'single-product' ); ?>

						<?php endwhile; // end of the loop. ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer();?>