<?php get_header(); ?>
	<div id="main">
		<div class="container">
			<div class="row">
				<div class="content-main col-lg-12 col-sm-12 col-xs-12">
						<div class="col-lg-3 hidden-md hidden-sm hidden-xs ">
							<?php if ( ! dynamic_sidebar('menu-home') ) : ?>
							<?php endif;?>
						</div>
						<div class="col-lg-9 col-sm-9 col-xs-12 slider-box-tab">
							<?php
							$hidden_slider = ot_get_option('hidden_slider');
							if($hidden_slider == 'on')
								get_template_part('template-parts/template-slider');
							?>
						</div>

				</div>
				<div style="padding: 0px" class="col-lg-12">
					<?php if ( ! dynamic_sidebar( 'content-home' ) ) : ?>
    				<?php endif;?>
				</div>
				<div class="col-lg-12">
					<?php if ( ! dynamic_sidebar( 'bottom' ) ) : ?>
					<?php endif;?>
				</div>
			</div>
		</div>
		<div class="section">
			<div class="container">
				<section id="counter" class="section">
					<div class="container-fluid">
						<div class="row">
							<?php
							$counterup = ot_get_option('counterup',array());
							if(!empty($counterup)){
								foreach($counterup as $item){
									echo '
										<div class="col-md-4 text-center">
											<p class="avo bold text-green"><span class="counter">'.$item["number_counterup"].'</span><span> +</span></p>
											<p class="avo">'.$item["title"].'</p>
										</div>
									';
								}
							}else{?>
								<div class="col-md-4 text-center">
									<p class="avo bold text-green"><span class="counter">10000</span><span> +</span></p>
									<p class="avo">Khách hàng tin tưởng</p>
								</div>
								<div class="col-md-4 text-center">
									<p class="avo bold text-green"><span class="counter">06</span><span> +</span></p>
									<p class="avo">Lĩnh vực hoạt động</p>
								</div>
								<div class="col-md-4 text-center">
									<p class="avo bold text-green"><span class="counter">130</span><span> +</span></p>
									<p class="avo">Đại lý trên toàn quốc</p>
								</div>
							<?php }?>
						</div>
					</div>
				</section>
			</div>	
		</div>
	</div>
<?php get_footer();?>