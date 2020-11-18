<?php /* Template Name: Brochure */ get_header(); ?>

  	<div class="content">

        <?php get_template_part( 'parts/generic', 'banner' ); ?>

        <section class='brochures'>
            <div class='grid-container full pad90W'>
                <div class='grid-x grid-margin-x padT70 padB100'>
                    <?php if( have_rows('brochures')): ?>
                        <?php while ( have_rows('brochures')) : the_row(); ?>

                            <div class='small-12 medium-6 large-3 cell broBox rel'>
                                <div class='overlay'><a class='greyB' href='<?php echo get_sub_field('bro_link'); ?>' target='_blank'>Download</a></div>

                                <div class='innerBox whiteBg'>
                                    <img class='shadow' src="<?php echo get_sub_field('bro_img'); ?>"/>
                                </div>
                                <p class='center marT25 dtext semi'><?php echo get_sub_field('bro_title'); ?></p>

                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <?php get_template_part( 'parts/customer', 'info' ); ?>


  	</div>

<?php get_footer(); ?>
