<?php get_header(); ?>

    <div class="content">

        <section class='blogArchive pad80'>
            <div class='grid-container'>
                <div class='grid-x marB40'>
                    <div class='large-12 cell'>
                        <h1>Blogs</h1>
												<p><?php echo get_field('archive_description', 'option'); ?></p>
										</div>
								</div>
								<div class='grid-x grid-margin-x'>
                    <?php if (have_posts()) : query_posts($query_string.'&cat=-33,-34'); while (have_posts()) : the_post(); ?>
										    <?php get_template_part( 'parts/loop', 'archive' ); ?>
									  <?php endwhile; ?>
										    <?php joints_page_navi(); ?>
									  <?php else : ?>
										    <?php get_template_part( 'parts/content', 'missing' ); ?>
									  <?php endif; ?>
								</div>
						</div>
				</section>

		</div>

<?php get_footer(); ?>
