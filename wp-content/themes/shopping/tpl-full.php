<?php /*Template Name: Template Full*/

get_header(); ?>
    <div id="main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <?php woocommerce_breadcrumb();?>
                </div>
                <div class="col-xs-12">
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