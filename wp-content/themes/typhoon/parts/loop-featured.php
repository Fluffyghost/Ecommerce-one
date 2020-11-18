<div class='small-12 medium-12 large-12 cell mainFeatured marB60'>
		<?php $args = array(
				'posts_per_page' => 1,
				'post_type' => 'post',
				'category_name' => 'featured',
		);
		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post );

		$category = get_the_category(); ?>

		<div class='grid-x'>
			  <div class='large-12 cell'>
					  <div class='grid-x grid-margin-x align-middle'>
							  <div class='small-12 medium-12 large-6 cell'>
										<a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
								</div>
								<div class='small-12 medium-12 large-6 cell'>
									<div class='innerBox pad25'>
											<?php if ( $category[1] ) {
													 echo '<a class="orange marT30" href="' . get_category_link( $category[1]->term_id ) . '"> Featured news <span class="dot">&middot;</span>' . $category[1]->cat_name . '</a>';
											} ?>
											<a class='dtext' href="<?php echo the_permalink(); ?>"><h2 class='h1 dtext'><?php the_title(); ?></h2></a>
									</div>
							  </div>
				  	</div>
			  </div>
		</div>

		<?php endforeach; wp_reset_postdata(); ?>
</div>
