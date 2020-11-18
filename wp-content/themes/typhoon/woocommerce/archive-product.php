<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>


<!-- </?php if(is_product_category( 'isp' )) { ?>

	<div class="reveal" id="ispmodal" data-reveal data-close-on-click="true">
			<div class='grid-container full'>
					<div class='grid-x'>

							<div class='small-12 medium-12 large-12 cell innerbox'>
									<button class="close-button" data-close aria-label="Close reveal" type="button">
											<span class="material-icons">clear</span>
									</button>
									<img src="</?php echo get_field('isp_logo','options'); ?>"/>
									<p class='h2 dtext marB20'></?php echo get_field('isp_title','options'); ?></p>
									</?php echo get_field('isp_text','options'); ?>
									<a class='orangeB' href='</?php echo get_site_url(); ?>'>Go back to homepage</a>
							</div>

					</div>
			</div>
	</div>

</?php }  else { }?> -->

<div class='shopArchive'>

		<?php if(is_product_category()) { ?>

				<?php
						$queried_object = get_queried_object();
						$taxonomy = $queried_object->taxonomy;
						$term_id = $queried_object->term_id;
				?>
        <?php if(get_field('cat_banner', $taxonomy . '_' . $term_id)) { ?>
				    <section class='genericBanner rel catBanner' style="background-image:url('<?php echo get_field('cat_banner', $queried_object); ?>');">
				<?php } else { ?>
 						<section class='genericBanner placeholder rel catBanner' style="background-image:url('<?php echo get_field('placeholder_banner','options'); ?>');">
			  <?php } ?>
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
				                <h1 class='white marB20 center'><?php woocommerce_page_title(); ?></h1>
				                <p class='white h4 center'><?php do_action( 'woocommerce_archive_description' ); ?></p>
										</div>
				        </div>
				    </div>
				</section>

		<?php } else {  ?>

				<?php get_template_part( 'parts/shop', 'banner' ); ?>

		<?php } ?>

		<section class='shopWrap'>
        <div class='grid-container full pad90W'>
            <div class='grid-x padT16'>
                <div class='small-12 medium-12 large-12 cell filterBar'>
								    <div class='filterWrap'>


											  <!-- <button class='mgreyB' data-toggle="off-canvas">Filter</button> -->

												<ul class='filterbuttons hidemed'>
														<?php if( have_rows('filter_buttons','options')): $i = 1; ?>
				 											 <?php while ( have_rows('filter_buttons','options')) : the_row(); ?>
				 											     <li><button class='mgreyB filterB fbutt_<?php echo $i; ?>'  data-toggle="off-canvas"><?php echo get_sub_field('button','options'); ?></button><li>
				 											 <?php $i++; endwhile; ?>
				 								    <?php endif; ?>
												</ul>

												<div class='filterbuttons showmed'>
				 								    <button class='mgreyB filterB'  data-toggle="off-canvas">Filter <span class="material-icons marL5">keyboard_arrow_down</span></button>
												</div>

												<div class="off-canvas position-right" id="off-canvas" data-off-canvas>

														<?php if ( is_active_sidebar( 'offcanvas' ) ) : ?>
															  <span class="material-icons closefilter" data-toggle="off-canvas">close</span>
		                            <p class='filterT marB30 dtext'>Product filter</p>
																<?php dynamic_sidebar( 'offcanvas' ); ?>
														<?php endif; ?>

												</div>
									  </div>
								</div>
								<div class='small-12 medium-12 large-12 cell'>



									  <?php
												if ( woocommerce_product_loop() ) {

														/**
														 * Hook: woocommerce_before_shop_loop.
														 *
														 * @hooked woocommerce_output_all_notices - 10
														 * @hooked woocommerce_result_count - 20
														 * @hooked woocommerce_catalog_ordering - 30
														 */
														do_action( 'woocommerce_before_shop_loop' ); ?>

														<div class='bline marB60 marT16'></div>

														<?php woocommerce_product_loop_start();

														if ( wc_get_loop_prop( 'total' ) ) {
																while ( have_posts() ) {
																		the_post();
																		do_action( 'woocommerce_shop_loop' );
																		wc_get_template_part( 'content', 'product' );
																}
														}


														woocommerce_product_loop_end();
														// woo_pagination();
														/**
														 * Hook: woocommerce_after_shop_loop.
														 * @hooked woocommerce_pagination - 10
														 */


														do_action( 'woocommerce_after_shop_loop' );?>
														<div class='resultcount'><?php woocommerce_result_count(); ?></div>

											  <?php } else {
														do_action( 'woocommerce_no_products_found' );
												}

												/**
												 * Hook: woocommerce_after_main_content.
												 *
												 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
												 */
												do_action( 'woocommerce_after_main_content' );




												get_footer( 'shop' );
										?>

								</div>
						</div>
				</div>
		</section>

</div>
