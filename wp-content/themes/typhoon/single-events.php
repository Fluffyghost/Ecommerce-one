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

												 <div class='hide-for-small-only medium-auto large-auto cell stickem-container'>
														<div class='sharePost stickem'>
																<p class='dtext largep'>Share</p>
																<a class='shareicon face' target='_blank' href="https://www.facebook.com/sharer/sharer.php?u=<?php echo the_permalink(); ?>"><i class="fab fa-facebook-f"></i></a>
																<a class='shareicon twit' target='_blank' href="https://twitter.com/intent/tweet?text=<?php echo the_permalink();  ?>"><i class="fab fa-twitter"></i></a>
																<a class='shareicon linked' target='_blank' href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo the_permalink(); ?>"><i class="fab fa-linkedin-in"></i></a>
														</div>
												 </div>

												 <div class='small-12 medium-12 large-12 cell'>
														<div class='newsHeader marB50 mmidW'>
																<h1 class='marB30 center dtext'><?php the_title(); ?></h1>
																<p class='bold center noMar'>Date: <?php echo get_field('date'); ?></p>
																<p class='date center'>Location: <?php echo get_field('location'); ?></p>
														</div>
														<div class='newsContent mmidW'>
																<div class='mainImg'><?php the_post_thumbnail('full'); ?></div>
																<div class='text_block'>
																		 <?php the_content(); ?>
																</div>
														</div>
												 </div>

 										 <?php endwhile; else : ?>
 											   <?php get_template_part( 'parts/content', 'missing' ); ?>
 										<?php endif; ?>
								</div>
						</div>
				</article>

        <?php get_template_part( 'parts/customer', 'info' ); ?>
		</div>

<?php get_footer(); ?>
