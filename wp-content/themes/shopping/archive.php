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
                            <?php
                            if(is_author()){
                                printf( '<span>Tác giả: %s', '<span class="vcard">' . get_the_author() . '</span></span>' );
                            }elseif(is_day()){
                                printf( '<span>Ngày: %s', '<span>' . get_the_date('d/m/Y') . '</span></span>' );
                            }elseif(is_month()){
                                printf( '<span>Tháng: %s', '<span>' . get_the_date( 'm') . '</span></span>' );
                            }elseif(is_year()){
                                printf( '<span>Năm: %s', '<span>' . get_the_date( 'Y') . '</span></span>' );
                            }
                            elseif(is_tag()){
                                $title = single_tag_title('Tag: ',false);
                                echo '<span>'.$title.'</span>';
                            }else{
                                $title = single_cat_title('',false);
                                echo '<span>'.$title.'</span>';
                            }
                            ?>
                        </h1>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="list-post">
                                    <?php while(have_posts()) : the_post();?>
                                    <div class="news-item">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4">
                                                <a href="<?php the_permalink();?>" title="<?php the_title();?>" class="thumb-news-item">
                                                    <?php
                                                    if (has_post_thumbnail())
                                                        the_post_thumbnail('thumb_252x182');
                                                    else
                                                        echo '<img src="'.woocommerce_placeholder_img_src().'" alt="'.get_the_title().'" width="252" height="182" />';
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="col-md-8 col-sm-8">
                                                <a class="news-title" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
                                                <ul class="post-info">
                                                    <li class="post-date"><i class="fa fa-calendar"></i> <?php printf( '%s', '<span>' . get_the_date('D, m / Y') . '</span>' );?></li>
                                                    <li class="post-author"><i class="fa fa-user"></i> <?php $author_id = $post->post_author; ?><a class="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'user_nicename' , $author_id ); ?></a></li>
                                                </ul>
                                                <p class="exp-news-item">
                                                    <?php echo eweb_truncate_description('300');?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endwhile;wp_reset_query();?>
                                </div>
                            </div>
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