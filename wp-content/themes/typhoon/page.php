<?php get_header(); ?>

		<div class="content">

			<?php if ( is_page( array( 'my-account') ) ) { ?>

			<section class='genericBanner rel' style="background-image:url('<?php echo get_field('account_banner','options'); ?>');">
			    <div class='bannerOverlay'></div>
			    <div class='grid-container full pad90W'>
			        <div class='grid-x'>
			            <div class='large-12 cell padT10 whitecrumbs'>
			                <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<p id="breadcrumbs">','</p>' ); } ?>
			            </div>
			        </div>
			    </div>
			    <div class='grid-container'>
			        <div class='grid-x  padB30 bannerWrap'>
			            <div class='large-12 cell innerwrap midW'>
			                <h1 class='white marB20 center'><?php echo get_field('title'); ?>My Account</h1>
									</div>
			        </div>
			    </div>
			</section>

			<section class='accountPage'>
		 		 <div class="grid-container">
		 				 <div class="grid-x padB100">
		 						 <div class='large-12 cell'>
		 								 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		 										 <?php the_content(); ?>
		 								 <?php endwhile; endif; ?>
		 						 </div>
		 				 </div>
		 		 </div>
		  </section>

			<?php get_template_part( 'parts/customer', 'info' ); ?>

			<?php } else if ( is_page( array( 'basket') ) ) { ?>

					<section>
							<div class='grid-container full pad90W'>
									<div class='grid-x marT30'>
											<div class='large-12 cell'>
											    <?php echo woocommerce_breadcrumb(); ?>
											</div>
									</div>
							</div>
					</section>

					<section class='basketPage'>
							<div class="grid-container">
									<div class="grid-x padT40 padB100">
											<div class='large-12 cell'>
													<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
															<h1 class='h3 dtext'>Shopping bag</h1>
															<?php the_content(); ?>
													<?php endwhile; endif; ?>
											</div>
									</div>
							</div>
					</section>

          <?php get_template_part( 'parts/customer', 'info' ); ?>

		 <?php } else if ( is_page( array( 'checkout') ) ) { ?>

				 <section>
			 			<div class='grid-container'>
			 					<div class='grid-x marT30'>
			 							<div class='large-12 cell'>
			 								<?php if ( function_exists('yoast_breadcrumb') ) {
			 										yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			 								} ?>
			 							</div>
			 					</div>
			 			</div>
			 	</section>

			 	<section class='checkoutPage'>
			 			<div class="grid-container">
			 					<div class="grid-x padT40 padB100">
			 							<div class='large-12 cell'>
			 									<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			 											<h1 class='h3 dtext'>Checkout</h1>
			 											<?php the_content(); ?>
			 									<?php endwhile; endif; ?>
			 							</div>
			 					</div>
			 			</div>
			 	</section>

		 	  <?php get_template_part( 'parts/customer', 'info' ); ?>

		 <?php } else { ?>


				<section>
						<div class='grid-container'>
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
						<div class="grid-container">
								<div class="grid-x padT40 padB100">
										<div class='large-12 cell'>
												<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
													  <h1 class='marB20'><?php the_title(); ?></h1>
														<?php the_content(); ?>
												<?php endwhile; endif; ?>
										</div>
								</div>
						</div>
				</section>

				<?php get_template_part( 'parts/customer', 'info' ); ?>

		<?php } ?>

		</div>

<?php get_footer(); ?>
