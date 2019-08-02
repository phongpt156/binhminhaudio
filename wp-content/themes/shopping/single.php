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
                        <ul class="post-info">
                            <li class="post-date"><i class="fa fa-calendar"></i> <?php printf( '%s', '<span>' . get_the_date('D, m / Y') . '</span>' );?></li>
                            <li class="post-author"><i class="fa fa-user"></i> <?php $author_id = $post->post_author; ?><a class="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'user_nicename' , $author_id ); ?></a></li>
                        </ul>
                        <div class="news-content">
                            <?php
                            while(have_posts()) : the_post();
                            the_content();
                            endwhile;
                            ?>
                            <div class="entry-meta">
                                <span class="tag"><i class="fa fa-tags"></i> Từ khóa:</span>
                                <span class="tag-links">
                                    <?php the_tags( '', '', '' );?>
                                </span>
                            </div>
                            <hr>
                            <div class="article-fb-comments">
                                <div class='tabs_comment'>
                                    <ul class='nav_tabs_comment'>
                                        <li><a href="#tab_comment_fb_des" class='active'>Bình luận Facebook</a></li>
                                        <li><a href="#tab_comment_site_des">Bình luận</a></li>
                                    </ul>
                                    <div id='tab_comment_fb_des' class='content_tbs active'>
                                        <?php echo ew_comment_fb(); ?>
                                    </div>
                                    <div id='tab_comment_site_des' class='content_tbs '>
                                        <?php comments_template(); ?> 
                                    </div>
                                </div>
                                <script>
                                jQuery(document).ready(function(){
                                    jQuery(".nav_tabs_comment a").click(function(){
                                        var _this = jQuery(this);
                                        if(!_this.hasClass("active")){
                                            jQuery(".nav_tabs_comment a,.tabs_comment .content_tbs").removeClass("active");
                                            _this.addClass("active");
                                            jQuery(_this.attr("href")).addClass("active");
                                        }
                                        return false;
                                    });
                                });
                                </script>
                            </div>
                        </div>
                        <div class="related-news">
                            <h3 class="title-cate">
                                <span>Bài viết liên quan</span>
                            </h3>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="list-post-related">
                                        <?php
                                        $custom_taxterms = wp_get_object_terms( $post->ID, 'category', array('fields' => 'ids') );
                                        $args = array(
                                        'post_type' => 'post',
                                        'post_status' => 'publish',
                                        'showposts'=>12,
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'category',
                                                'field' => 'id',
                                                'terms' => $custom_taxterms
                                            )
                                        ),
                                        'post__not_in' => array ($post->ID),
                                        );
                                        $related_items = new WP_Query( $args );
                                        // loop over query
                                        if ($related_items->have_posts()) :
                                        echo '<ul>';
                                        while ( $related_items->have_posts() ) : $related_items->the_post();
                                        ?>
                                            <li>
                                                <a class="news-title" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
                                            </li>
                                        <?php
                                        endwhile;endif;wp_reset_postdata();
                                        echo '</ul>';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>