<?php
$slide_items = ot_get_option( 'slide_item', array() );
if(!empty($slide_items)) :
?>
<div id="slider">
    <div id="owl-slider" class="owl-carousel">
        <?php
        foreach( $slide_items as $slide_item ) {
            echo '
                <div class="item">
                    <a href="'.$slide_item['link_slide_item'].'" title="'.$slide_item['title'].'">
                        <img src="'.$slide_item['upload_img'].'" alt="'.$slide_item['title'].'" title="'.$slide_item['title'].'">
                    </a>
                </div>
            ';
        }?>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        var owl_slider;
        owl_slider = jQuery("#owl-slider");
        owl_slider.owlCarousel({
            autoplay : true,
            loop: true,
            items: 1,
            autoplayHoverPause: true,
            autoHeight: true,
            dots: false,
            nav:true,
            navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        });
    });
</script>
<?php endif;?>