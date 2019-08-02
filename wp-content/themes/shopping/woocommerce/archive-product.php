<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>
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
		        </div>
				<div class="col-lg-3 hidden-md hidden-sm hidden-xs sidebar">
					<?php get_sidebar();?>
				</div>
				<?php
				if ( is_active_sidebar('sidebar') ) {?>
					<div class="col-lg-9 col-sm-12 col-xs-12">
				<?php } else {?>
					<div class="col-xs-12">
				<?php }?>
					<?php woocommerce_breadcrumb();?>
					<div class="content-main">
						<div class="products-wrapper">
							<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
								<h1 class="title-cate">
									<span><?php woocommerce_page_title(); ?></span>
					            </h1>
				            <?php endif; ?>
				            <div class="products-nav">
				            	<?php
									/**
									 * woocommerce_before_shop_loop hook.
									 *
									 * @hooked woocommerce_result_count - 20
									 * @hooked woocommerce_catalog_ordering - 30
									 */
									do_action( 'woocommerce_before_shop_loop' );
								?>
				            </div>
				            <?php
								/**
								 * woocommerce_archive_description hook.
								 *
								 * @hooked woocommerce_taxonomy_archive_description - 10
								 * @hooked woocommerce_product_archive_description - 10
								 */
								do_action( 'woocommerce_archive_description' );
							?>
							<?php woocommerce_product_subcategories(); ?>
							<div class="product-cate">
				            	<?php
				                while(have_posts()) : the_post();

				                	get_template_part('template-parts/content');

				                endwhile;wp_reset_query();
				                ?>
				                <div class="clear"></div>
							</div>
                            <?php woocommerce_pagination();?>
                            <hr>
							<div class="article-fb-comments">
							    <?php echo ew_comment_fb(); ?>
							</div>
        				</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer();?>