<?php get_header(); ?>

	<div class="content">

		<section class='courseBanner blackBg'>
				<div class='grid-container full pad90W'>
						<div class='grid-x'>
								<div class='large-12 cell padT10'>
										<?php do_action('woo_custom_breadcrumb'); ?>
								</div>
						</div>
				</div>
				<div class='grid-container'>
						<div class='grid-x'>
								<div class='large-12 cell'>
										<h1 class='orange center alCen marT80'>404 Page not found :( </h1>
								</div>
						</div>
				</div>
		</section>


		  <section class='plainPage'>
				  <div class="grid-container">
					  	<div class="grid-x pad100">
					  	    <div class='large-12 cell'>
										<h2 class='center marB30 h4 dtext'>Looks like the page you were looking for, doesn't exist.</h2>
										<p class='center'><a class='orange underline' href='<?php echo get_site_url(); ?>'>Click here to return Home.</a></p>
									</div>
					  	</div>
				  </div>
	  	</section>


	</div>

<?php get_footer(); ?>
