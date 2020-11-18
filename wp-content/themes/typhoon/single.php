<?php get_header(); ?>

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

				<article class='singleNews'>
            <div class='grid-container'>
                <div class='grid-x padT60 padB70 sharecontainer'>
									   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
										     <?php get_template_part( 'parts/loop', 'single' ); ?>
 										 <?php endwhile; else : ?>
 											   <?php get_template_part( 'parts/content', 'missing' ); ?>
 										<?php endif; ?>
								</div>
						</div>
				</article>

        <?php get_template_part( 'parts/customer', 'info' ); ?>
		</div>

<?php get_footer(); ?>
