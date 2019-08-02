<?php  global $product;  ?>
	<div class="box">
		<a class="post-img" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
			<div class="frame">
				<?php wc_get_template( 'loop/sale-flash.php' );?>
				<?php
				if (has_post_thumbnail())
					the_post_thumbnail('shop_catalog',array('alt'=>get_the_title()));
				?>
				<?php
				$countdown = get_post_meta(get_the_ID(), 'countdown', true);
				if($countdown == 'true')
					echo set_countdown($post->ID); ?>
			</div>
		</a>
		<div class="info-product">
			<h3>
				<a class="title-product" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_title(); ?>
				</a>
			</h3>
			<?php //wc_get_template( 'loop/rating.php' );?>
			<?php if ( $price_html = $product->get_price_html() ) : ?>
			<div class="price">
				<span class="amount">
					<?php echo $price_html; ?>
				</span>
			</div>
			<?php endif; ?>
			<div class="add-to-cart">
				<?php
				/**
				* woocommerce_after_shop_loop_item hook
				*
				* @hooked woocommerce_template_loop_add_to_cart - 10
				*/
				do_action( 'woocommerce_after_shop_loop_item' );
				?>
			</div>
		</div>
	</div>
