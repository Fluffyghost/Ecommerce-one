<?php /* Template Name: Contact */ get_header(); ?>

  	<div class="content">

        <section class='conCols rel' style="background-image:url('<?php echo get_field('contact_bg'); ?>');">
            <div class='overlay'></div>
            <div class='grid-container'>
                <div class='grid-x align-middle lgW pad70'>
                    <div class='small-12 medium-12 large-6 cell contactDetails'>
                        <h1 class='marB20 white'>Get in touch</h1>
                        <p class='intro white'><?php echo get_field('contact_intro'); ?></p>

                        <h4 class='white marT40 hugep'>Address</h4>
                        <div class='white'><?php echo get_field('address','options'); ?></div>
                        <h4 class='white marT40 hugep'>Call us</h4>
                        <a class='white' href="tel:<?php echo get_field('phone','options');?>"><?php echo get_field('phone','options');?></a>
                        <h4 class='white marT40 hugep'>Fax</h4>
                        <p class='white'><?php echo get_field('fax','options'); ?></p>
                        <h4 class='white marT40 hugep'>Email</h4>
                        <a class='white' href="mailto:<?php echo get_field('email','options');?>"><?php echo get_field('email','options');?></a>

                    </div>
                    <div class='small-12 medium-12 large-6 cell contactForm whiteBg'>
                        <?php echo do_shortcode('[contact-form-7 id="309" title="Contact form"]'); ?>
                          <p class='tiny marT15'>By signing up you agree to our <a class='underline' href="<?php echo get_site_url(); ?>/terms-conditions">Terms & Conditions</a> &amp; <a class='underline' href="<?php echo get_site_url(); ?>/privacy-policy">Privacy Policy</a></p>
                    </div>
                </div>
            </div>
        </section>

        <?php get_template_part( 'parts/customer', 'info' ); ?>

  	</div>

<?php get_footer(); ?>
