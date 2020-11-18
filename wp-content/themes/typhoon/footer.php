<?php if ( is_active_sidebar( 'Compare' ) ) : ?>

  <?php dynamic_sidebar( 'Compare' ); ?>

<?php endif; ?>

<footer class="footer greyBg padT80 padB30" role="contentinfo">
    <div class='grid-container full pad90W'>
        <div class='grid-x grid-margin-x footwrap'>
            <div class='footCol newsAndSocial small-12 medium-6 large-auto cell'>

                <p class='h4 white bold'>Typhoon Exclusives</p>
                <p class='marB30 white'>Sign up to get exclusive offers & discounts</p>
                <?php echo do_shortcode('[contact-form-7 id="304" title="Footer newsletter"]'); ?>
                <div class='hide-for-small-only marB40'>
                    <p class='h4 white bold marT30'>Follow us</p>
                    <?php if ( get_field('facebook','options')) : ?>
                        <a class='link' href="<?php echo get_field('facebook','options'); ?>"><i class="fab fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if ( get_field('instagram','options')) : ?>
                        <a class='link' href="<?php echo get_field('instagram','options'); ?>"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if ( get_field('linkedin','options')) : ?>
                        <a class='link' href="<?php echo get_field('linkedin','options'); ?>"><i class="fab fa-linkedin-in"></i></a>
                    <?php endif; ?>
                    <?php if ( get_field('youtube','options')) : ?>
                        <a class='link' href="<?php echo get_field('youtube','options'); ?>"><i class="fab fa-youtube"></i></a>
                    <?php endif; ?>
                    <?php if ( get_field('twitter','options')) : ?>
                        <a class='link' href="<?php echo get_field('twitter','options'); ?>"><i class="fab fa-twitter"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class='footCol shop small-12 medium-6 large-auto cell'>
                <div class='hide-for-small-only'>
                    <p class='h4 white marB20 bold'>Shop</p>
                    <?php shop_footer(); ?>
                </div>
                <div class='show-for-small-only'>
                    <p class='h4 white marB20 shopTog bold'>Shop <span class="material-icons shopdown">keyboard_arrow_down</span><span class="material-icons shopright">keyboard_arrow_right</span></p>
                    <div class='shopTogDrop'>
                        <?php shop_footer(); ?>
                    </div>
                    <div class='footLine'></div>
                </div>
            </div>
            <div class='footCol more small-12 medium-6 large-auto cell'>
                <div class='hide-for-small-only'>
                    <p class='h4 white marB20 bold'>More</p>
                    <?php more_footer(); ?>
                </div>
                <div class='show-for-small-only'>
                    <p class='h4 white marB20 moreTog bold'>More <span class="material-icons moredown">keyboard_arrow_down</span><span class="material-icons moreright">keyboard_arrow_right</span></p>
                    <div class='moreTogDrop'>
                        <?php more_footer(); ?>
                    </div>
                    <div class='footLine'></div>
                </div>
            </div>
            <div class='footCol companyInfo small-12 medium-6 large-auto cell'>
                <div class='hide-for-small-only'>
                    <p class='h4 white marB20 bold'>Company Info</p>
                    <?php comp_footer(); ?>
                </div>
                <div class='show-for-small-only'>
                    <p class='h4 white marB20 compTog bold'>Company Info <span class="material-icons compdown">keyboard_arrow_down</span><span class="material-icons compright">keyboard_arrow_right</span></p>
                    <div class='compTogDrop'>
                        <?php comp_footer(); ?>
                    </div>
                    <div class='footLine'></div>
                </div>
            </div>
            <div class='footCol address small-12 medium-6 large-auto cell'>
                <div class='hide-for-small-only'>
                    <p class='h4 white marB20 bold'>Need assistance?</p>
                    <p class='info white'><a class='white underline' href="<?php echo get_field('phone','options'); ?>"><?php echo get_field('phone','options'); ?></a></p>
                    <p class='info white'><a class='white underline' href="<?php echo get_field('email','options'); ?>"><?php echo get_field('email','options'); ?></a></p>
                    <div class='address white'><?php echo get_field('address','options'); ?></div>
                </div>
                <div class='show-for-small-only'>
                    <p class='h4 white marB20 needTog bold'>Need assistance? <span class="material-icons needdown">keyboard_arrow_down</span><span class="material-icons needright">keyboard_arrow_right</span></p>
                    <div class='needTogDrop'>
                        <p class='info white'><a class='white underline' href="<?php echo get_field('phone','options'); ?>"><?php echo get_field('phone','options'); ?></a></p>
                        <p class='info white'><a class='white underline' href="<?php echo get_field('email','options'); ?>"><?php echo get_field('email','options'); ?></a></p>
                        <div class='address white'><?php echo get_field('address','options'); ?></div>
                    </div>
                </div>
                <div class='show-for-small-only marT60 newsAndSocial'>
                    <p class='h4 white bold'>Follow us</p>
                    <?php if ( get_field('facebook','options')) : ?>
                        <a class='link' href="<?php echo get_field('facebook','options'); ?>"><i class="fab fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if ( get_field('instagram','options')) : ?>
                        <a class='link' href="<?php echo get_field('instagram','options'); ?>"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if ( get_field('linkedin','options')) : ?>
                        <a class='link' href="<?php echo get_field('linkedin','options'); ?>"><i class="fab fa-linkedin-in"></i></a>
                    <?php endif; ?>
                    <?php if ( get_field('youtube','options')) : ?>
                        <a class='link' href="<?php echo get_field('youtube','options'); ?>"><i class="fab fa-youtube"></i></a>
                    <?php endif; ?>
                    <?php if ( get_field('twitter','options')) : ?>
                        <a class='link' href="<?php echo get_field('twitter','options'); ?>"><i class="fab fa-twitter"></i></a>
                    <?php endif; ?>
                </div>
          </div>
        </div>
        <div class='grid-x footwrap padT30'>
            <div class='large-12 cell rel'>

                <div class='hide-for-small-only'><?php info_footer(); ?></div>
                <div class='flexend footlogos'>
                    <?php if( have_rows('footer_logos','options')): $i = 1;  ?>
                        <?php while ( have_rows('footer_logos','options')) : the_row(); ?>
                            <img src="<?php echo get_sub_field('foot_logo','options'); ?>"/>
                        <?php $i++; endwhile;?>
                    <?php endif; ?>
                </div>
                <div class='show-for-small-only'><?php info_footer(); ?></div>
            </div>
        </div>
    </div>
</footer>
<div class='creditBar lGreyBg'>
    <div class='grid-container full pad90W'>
        <div class='grid-x'>
            <div class='large-12 cell barInner'>
                <p class='white tiny noMar'><?php echo get_field('reg_address','options'); ?><span class='marL40'>&copy; <?php echo the_date('Y'); ?> Typhoon International Limited</span></p>
                <p class='white tiny noMar'>Designed & Developed by <a href="http://boxchilli.com" target="_blank">boxChilli</a></p>
            </div>
        </div>
    </div>
</div>

</div><!-- end .off-canvas-content -->
</div><!-- end .off-canvas-wrapper -->

<?php wp_footer(); ?>


</body>
</html>
