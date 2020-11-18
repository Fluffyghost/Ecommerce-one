<?php /* Template Name: Terms */ get_header(); ?>

  	<div class="content">

        <section class='termsPage'>
            <div class='grid-container full pad90W'>
                 <div class='grid-x pad10'>
                      <div class='large-12 cell padT10'>
                          <?php if ( function_exists('yoast_breadcrumb') ) {
                              yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                          } ?>
                      </div>
                  </div>
             </div>
             <div class='grid-container'>
                <div class='grid-x lgW termscontainer marB200'>
                    <div class='small-12 medium-3 large-3 cell stickem-container'>
                        <div class='stickem'>
                            <?php info_footer(); ?>
                        </div>
                    </div>
                    <div class='small-12 medium-9 large-9 cell'>
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <h1 class='marB20 h2 dtext'><?php the_title(); ?></h1>
                            <?php the_content(); ?>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php get_template_part( 'parts/customer', 'info' ); ?>

  	</div>

<?php get_footer(); ?>
