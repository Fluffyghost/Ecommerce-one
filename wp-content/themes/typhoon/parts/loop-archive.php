
<?php $category = get_the_category(); ?>

<div class='small-6 medium-6 large-3 cell marB60'>
		<div class='blogBox'>
				<a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
				<div class='innerBox'>
					  <?php if ( $category[1] ) {
							   echo '<a class="orange tiny marT30" href="' . get_category_link( $category[1]->term_id ) . '">' . $category[1]->cat_name . '</a>';
					  } ?>
						<a class='marT8 hugep dtext' href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
		</div>
</div>
