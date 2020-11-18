<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<div class='giftcardSingle'>

		<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

			<section class='militaryForm'>
					<div class='grid-container'>
							<div class='grid-x align-middle greyBg lgW marT50 marB60 repairBox'>
									<div class='small-12 medium-12 large-5 cell textBox'>
											<h2 class='white marB30'><?php echo get_field('gift_title','options'); ?></h2>
											<div class='white'><?php echo get_field('gift_text','options'); ?></div>
									</div>
									<div class='small-12 medium-12 large-7 cell imgBox' style="background-image:url('<?php echo get_field('gift_image','options'); ?>');">

									</div>
							</div>
					</div>
			</section>

			<section class='giftCardDesigns'>
					<div class='grid-container'>
						  <div class='grid-x lgW padT100'>
                  <p class='dtext marB20 largep semi'>Our gift card designs available for selection:</p>
							</div>
							<div class='grid-x grid-margin-x lgW padB60 marB60 cardContainer'>
									<div class='small-6 medium-6 large-3 cell giftcard'>
									    <img src='<?php echo get_field('design_one','options'); ?>'/>
									</div>
									<div class='small-6 medium-6 large-3 cell giftcard'>
									    <img src='<?php echo get_field('design_two','options'); ?>'/>
									</div>
									<div class='small-6 medium-6 large-3 cell giftcard'>
									    <img src='<?php echo get_field('design_three','options'); ?>'/>
									</div>
									<div class='small-6 medium-6 large-3 cell giftcard'>
									    <img src='<?php echo get_field('design_four','options'); ?>'/>
									</div>
							</div>
					</div>
			</section>

			<div class="summary entry-summary giftcardsSum">

					<?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );
					?>

			</div>

			<?php
			/**
			 * Hook: woocommerce_after_single_product_summary.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
			?>



		</div>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
