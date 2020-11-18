<?php /* Template Name: Repairs */ get_header(); ?>

  	<div class="content">

        <?php get_template_part( 'parts/generic', 'banner' ); ?>

        <section class='militaryForm'>
            <div class='grid-container'>
                <div class='grid-x align-middle greyBg lgW marT50 marB60 repairBox'>
                    <div class='small-12 medium-12 large-5 cell textBox'>
                        <h2 class='white marB30'><?php echo get_field('box_title'); ?></h2>
                        <div class='white'><?php echo get_field('box_text'); ?></div>
                    </div>
                    <div class='small-12 medium-12 large-7 cell imgBox' style="background-image:url('<?php echo get_field('box_image'); ?>');">

                    </div>
                </div>
                <div class='grid-x grid-margin-x padB100'>
                    <div class='large-12 cell'>
                        <div class='formWrap whiteBg'>
                            <?php if ( is_page( array( 'repairs-and-spares') ) ) { ?>
                                <h3 class='dtext marB30'>Repairs &amp; spares enquiry</h3>
                                <?php echo do_shortcode('[contact-form-7 id="966" title="Repair Form"]'); ?>
                            <?php } else { ?>
                                <h3 class='dtext marB30'>Returns enquiry</h3>
                                <?php echo do_shortcode('[contact-form-7 id="1130" title="Returns form"]'); ?>
                            <?php } ?>
                            <p class='dtext tiny marT15'>By sending a message, you agree to our <a class='underline' href="<?php echo get_site_url(); ?>/terms-conditions">Terms & Conditions</a> &amp; <a class='underline' href="<?php echo get_site_url(); ?>/privacy-policy">Privacy Policy</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php get_template_part( 'parts/customer', 'info' ); ?>


  	</div>

<?php get_footer(); ?>
