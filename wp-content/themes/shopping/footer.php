        <div id="footer-wrapper">
            <footer id="footer" class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <?php if ( ! dynamic_sidebar( 'footer-block-1' ) ) : ?>
                            <?php endif;?>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <?php if ( ! dynamic_sidebar( 'footer-block-2' ) ) : ?>
                            <?php endif;?>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <?php if ( ! dynamic_sidebar( 'footer-block-3' ) ) : ?>
                            <?php endif;?>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <?php if ( ! dynamic_sidebar( 'footer-block-4' ) ) : ?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <div id="copyright">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="copyright">
                                    <p>
                                        <?php $copyright = ot_get_option('copyright'); echo $copyright;?>       
                                    </p>
                                    <ul class="social">
                                        <?php
                                        $link_twitter = ot_get_option('link_twitter');
                                        $link_facebook = ot_get_option('link_facebook');
                                        $link_youtube = ot_get_option('link_youtube');
                                        ?>
                                        <li class=" social-tw social-slide">
                                            <a href="<?php echo $link_twitter?>" title="Twitter">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="social-fb social-slide">
                                            <a href="<?php echo $link_facebook?>" title="Facebook">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="social-yt social-slide">
                                            <a href="<?php echo $link_youtube?>" title="Youtube">
                                                <i class="fa fa-youtube"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <a href="#" class="scrollTo"><i class="fa fa-angle-up"></i></a>
        </div>
        <?php wp_footer();?>
    </div>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118272958-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-118272958-1');
</script>
</body>
</html>