<?php /* Template Name: Compare */ get_header(); ?>

  	<div class="content">

        <section>
            <div class='grid-container full pad90W'>
                <div class='grid-x marT30'>
                    <div class='large-12 cell'>
                      <?php if ( function_exists('yoast_breadcrumb') ) {
                          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                      } ?>
                    </div>
                </div>
            </div>
        </section>

        <section class='plainPage'>
            <div class="grid-container full pad90W">
                <div class="grid-x pad40 smW">
                    <div class='large-12 cell'>
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <h1 class='dtext center marB20'><?php the_title(); ?></h1>
                            <div class='center marB100'><?php echo get_field('compare_text'); ?></div>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
                <div class="grid-x padB100">
                    <div class='large-12 cell'>
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <p class='medshow marB20 dtext'>Scroll to view product comparison table</p>
                            <?php the_content(); ?>
                          <?php endwhile; ?>
                          <?php else : ?>
                              <p class='h3 title center'>No products have been added.</p>
                              <a class='center block marT30 blue underline' href="<?php echo get_site_url(); ?>/typhoon-leisure/">Click here to view products</a>
                          <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <?php get_template_part( 'parts/customer', 'info' ); ?>

  	</div>

<?php get_footer(); ?>
