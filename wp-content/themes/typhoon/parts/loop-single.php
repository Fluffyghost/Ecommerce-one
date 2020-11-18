

<div class='hide-for-small-only medium-auto large-auto cell' data-sticky-container>
		<div class='sharePost stickem' data-sticky data-margin-top="0">
				<p class='dtext largep'>Share</p>
				<a class='shareicon face' target='_blank' href="https://www.facebook.com/sharer/sharer.php?u=<?php echo the_permalink(); ?>"><i class="fab fa-facebook-f"></i></a>
				<a class='shareicon twit' target='_blank' href="https://twitter.com/intent/tweet?text=<?php echo the_permalink();  ?>"><i class="fab fa-twitter"></i></a>
				<a class='shareicon linked' target='_blank' href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo the_permalink(); ?>"><i class="fab fa-linkedin-in"></i></a>
		</div>
</div>



<div class='small-12 medium-12 large-12 cell'>
	  <div class='newsHeader marB50 mmidW'>
				<?php $category = get_the_category();
				$firstCategory = $category[1]->cat_name;
				echo '<a class="center orange" href="' . get_category_link( $category[1]->term_id ) . '">' . $category[1]->cat_name . '</a>'; ?>
				<h1 class='marB30 center dtext'><?php the_title(); ?></h1>
				<p class='bold center noMar dtext'><?php the_author(); ?></p>
				<p class='date center'><?php echo the_date('F d, Y'); ?></p>
	  </div>
		<div class='newsContent mmidW'>
			  <div class='mainImg'><?php the_post_thumbnail('full'); ?></div>
				<div class='text_block'>
            <?php the_content(); ?>
				</div>
		</div>
</div>
