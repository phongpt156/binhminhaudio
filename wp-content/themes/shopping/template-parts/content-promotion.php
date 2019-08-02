<?php  global $product;?>
<div class="item">
    <div class="box">
        <a class="post-img" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
            <div class="screen">
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
            </div>
        </a>
        <div class="info-product">
            <h3>
                <a class="title-product" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>
            <div class="price">
                <span class="amount">
                    <?php echo $product->get_price_html(); ?>
                </span>
            </div>
        </div>
    </div>
</div>