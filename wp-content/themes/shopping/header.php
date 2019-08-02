<!DOCTYPE HTML>
<html lang="vi-VN">
<head>
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<?php wp_head();?>
	<meta name="p:domain_verify" content="31c2f45df9944ae9a996fa04d769c601"/>
</head>
<body <?php body_class( 'woocommerce' ); ?>>
	<div class="wrapper">
		<div id="header-wrapper">
			<div class="header-top">
				<img src="<?php echo ot_get_option('header_top');?>">
			</div>
			<header id="header" class="header">
				<div class="info-top gradient">
					<div class="container">
						<div class="row">
							<div class="col-lg-12">
								<div class="menu-top">
									<?php
									wp_nav_menu( array(
									'theme_location' => 'second_menu',
									'container' => false
									));
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="logo">
					<div class="wapper-desk hidden-md">
						<div class="container">
							<div class="row">
								<div class="col-lg-3 col-sm-3 col-xs-12">
									<div class="logo">
										<a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>">
											<img src="<?php echo ot_get_option('logo');?>" alt="<?php bloginfo('name'); ?>">
										</a>
										<?php
	                                    if(is_page_template( 'template-parts/template-home.php' )){echo '<h1 class="site-title">'.get_bloginfo('name').' | '.get_bloginfo ( 'description' ).'</h1>';}
	                                    ?>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6">
									<div class="form-search-header">
										<?php get_search_form();?>
										<p class="hotkey"><?php echo ot_get_option('text_for_search');?></p>
									</div>
								</div>
								<div class="col-lg-3 col-sm-3">
									<div class="link-cart gradient">
										<a href="<?php echo esc_url( WC()->cart->get_cart_url() );?>" title="Giỏ hàng của bạn">
									        <i class="fa fa-opencart"></i>&nbsp;
									        Giỏ hàng [ <b><span id="count_shopping_cart"><?php echo wp_kses_data( sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ) );?> sản phẩm</span></b> ]
									    </a>
									</div> 
								</div>
							</div>
						</div>
					</div>
					<div class="mobile-wrapper">
						<div class="container">
							<div class="row">
								<div class="col-xs-12">
									<div class="wapper-mobile">
										<nav class="pull-left">
					                        <button type="button" class="navbar-toggle off-canvas-toggle" id="show-menu">
					                            <span class="sr-only">Toggle navigation</span>
					                            <span class="icon-bar"></span>
					                            <span class="icon-bar"></span>
					                            <span class="icon-bar"></span>
					                        </button>
					                    </nav>
										<div id="logoMobile" class="">
											<a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>">
												<img src="<?php echo ot_get_option('logo_mobile');?>" alt="<?php bloginfo('name'); ?>">
											</a>
										</div>
										<div class="search-mobile">
					                        <a class="icon-search" data-toggle="collapse" data-target="#nav-search" href="#" title="Search">
					                            <label for="s">
					                                <i class="fa fa-search"></i>
					                            </label>
					                        </a>
					                    </div>
									</div>
								</div>
							</div>
						</div>
						<div class="wrap-search">
						    <div class="container">
						        <form accept-charset="utf-8" action="<?php bloginfo('url'); ?>" method="get">
						            <div class="input-group">
						                <input type="text" id="s" name="s" class="form-control search-field" placeholder="Tìm kiếm sản phẩm" value="">
						                <span class="input-group-btn btn-close">
						                    <button type="button" data-toggle="collapse" data-target="#nav-search">
						                        <i class="fa fa-times"></i>
						                    </button>
						                </span>
						            </div><!--End-input-group-->
						        </form>
						    </div><!--End-container-->
						</div>
					</div>
				</div>
				<div id="off-canvas">
					<div class="off-canvas-inner">
						<?php
						$menu_class = 'menu';
						wp_nav_menu(
							array(
								'theme_location' => 'mobile_menu',
								'menu_class' => $menu_class,
								'container' => false
							)
						);?>
					</div>
				</div>
				<div class="wrapper-menu hidden-md">
					<div class="container">
						<div class="row">
					<!--		<div class="col-lg-3">
								<a id="mega-menu-title2" class="gradient title-cate-pro" href="#" title="Danh mục sản phẩm">
	                                <i class="fa fa-list"></i>&nbsp;DANH MỤC SẢN PHẨM&nbsp;&nbsp;<i class="fa fa-caret-square-o-down"></i>
	                            </a>
	                            <div class="dcjq-vertical-mega-menu mega-menu2">
									<nav class="product-menu">
										<?php
										wp_nav_menu( array(
					                        'theme_location' => 'cate_menu',
					                        'container' => false,
					                        'menu_id' => 'mega2',
					                    ));
										?>
									</nav>
								</div>
							</div> -->
							<div class="col-lg-12 pull-right">
								<nav class="container-main-menu">
									<?php
									$menu_class = 'menu';
									wp_nav_menu( array(
									'theme_location' => 'main_menu',
									'menu_class' => $menu_class,
									'container' => false
									));
									?>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</header><!-- /header -->
		</div>