<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

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
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<?php woocommerce_show_product_images();?>
		<div class="col-md-3">
				<?php
				$on_off_cs = ot_get_option('on_off_cs');
				if($on_off_cs == 'on'){?>
					<div id="policy">
						<ul>
							<?php
					        $chinh_sach = ot_get_option( 'chinh_sach', array() );
					        $hotline = ot_get_option('hotline_single');
					        foreach( $chinh_sach as $chinh_sach_item ) {?>
					            <li class="item_policy">
									<?php echo $chinh_sach_item['icon_policy'];?><?php echo $chinh_sach_item['title'];?>
								</li>
					        <?php }?>
							<li class="item_policy yahoo-sky">
								<div class="bg-hl">
									Hỗ trợ trực tuyến<br><?php echo $hotline;?>
								</div>
							</li>
						</ul>
					</div>
				<?php }?>
		</div><!-- .summary -->
	</div>

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		//echo woocommerce_output_product_data_tabs();
		//echo woocommerce_upsell_display();
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
