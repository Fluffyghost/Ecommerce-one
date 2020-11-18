<?php /* Template Name: Military */ get_header(); ?>

  	<div class="content">

        <?php get_template_part( 'parts/generic', 'banner' ); ?>

        <section class='militaryForm'>
            <div class='grid-container'>
                <div class='grid-x grid-margin-x padT60 padB100'>
                    <div class='large-12 cell'>
                        <div class='formWrap whiteBg'>
                            <h3 class='dtext'><?php echo get_field('form_title'); ?></h3>
                            <p class='dtext marB40'><?php echo get_field('form_text'); ?></p>
                            <?php echo do_shortcode('[contact-form-7 id="886" title="Military Form"]'); ?>
                            <p class='dtext tiny marT15'>By sending a message, you agree to our <a class='underline' href="<?php echo get_site_url(); ?>/terms-conditions">Terms & Conditions</a> &amp; <a class='underline' href="<?php echo get_site_url(); ?>/privacy-policy">Privacy Policy</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php get_template_part( 'parts/customer', 'info' ); ?>


  	</div>

<?php get_footer(); ?>
