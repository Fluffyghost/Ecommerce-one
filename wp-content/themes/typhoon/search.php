<?php get_header(); ?>

		<div class="content">

        <section class='searchPage'>
            <div class="grid-container">
                <div class="grid-x pad100">
                    <div class='large-12 cell'>


												<div class='grid-x grid-margin-x'>
														<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
																<?php if ( get_post_type() === 'product' ) { ?>

																		<div class='small-6 medium-3 large-3 cell marT40'>
																				<ul class='products'><?php wc_get_template_part( 'content', 'product' ); ?></ul>
																		</div>
																<?php } else { ?>

																<?php } ?>
														<?php endwhile; ?>
														<?php else : ?>
																<div class='large-12 cell padT100 padB200'>
																		<p class='h2 title center'>Sorry no products were found.</p>
																		<a class='center block marT30 blue underline' href="<?php echo get_site_url(); ?>">Click here to return home</a>
																</div>
														<?php endif; ?>
												</div>

                    </div>
                </div>
            </div>
        </section>

		</div>

<?php get_footer(); ?>
