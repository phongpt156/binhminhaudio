<?php get_header(); ?>
    <div id="main">
        <div class="container">
            <div class="row">
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
                        <h1 class="title-cate">
                            <span><?php the_title();?></span>
                        </h1>
                        <div class="news-content">
                            <?php
                            while(have_posts()) : the_post();
                            the_content();
                            endwhile;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>