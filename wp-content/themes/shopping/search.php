<?php get_header(); ?>
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
	          		<?php //woocommerce_breadcrumb();?>
		        </div>
				<?php
				if ( is_active_sidebar('sidebar') ) {?>
					<div class="col-lg-3 hidden-md hidden-sm hidden-xs sidebar">
						<?php get_sidebar();?>
					</div>
					<div class="col-lg-9 col-sm-12 col-xs-12">
				<?php } else {?>
					<div class="col-xs-12">
				<?php }?>
					<?php woocommerce_breadcrumb();?>
					<div class="content-main">
						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
							<h1 class="title-cate">
								<span><?php woocommerce_page_title(); ?></span>
				            </h1>
			            <?php endif; ?>
						<div class="product-cate">
				            	<?php
				                while(have_posts()) : the_post();
				                	get_template_part('template-parts/content');
				                endwhile;wp_reset_query();
				                ?>
				                <div class="clear"></div>
	                            <div class="col-lg-12">
	                                <?php woocommerce_pagination();?>
	                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer();?>