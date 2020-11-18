<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}?>

<?php if ( has_term( 'gift-cards', 'product_cat' ) ) { ?>


<?php } else { ?>


		<div class='grid-container full'>

				<?php if ( has_term( 'typhoon-commercial', 'product_cat' ) || has_term( 'isp', 'product_cat' ) ) { ?>

						<div class='grid-x grid-margin-x align-middle'>

								<div class='small-12 medium-12 large-12 cell maintitle'>
										<?php the_title( '<h1 class="dtext marB20 h2 prodtitle">', '</h1>' ); ?>
										  <a href="mailto:<?php echo get_field('commercial_email','options'); ?>?subject=Commercial Product Enquiry&body=Product: <?php echo the_permalink(); ?>" class='orangeB enquiresingle'>Enquiry only</a>
								</div>

				<?php } else { ?>

						<div class='grid-x align-middle'>

								<div class='small-8 medium-8 large-8 cell maintitle'>
										<?php the_title( '<h1 class="dtext marB20 h2 prodtitle">', '</h1>' ); ?>
								</div>
								<div class='small-4 medium-4 large-4 cell flexend pricemob'>
										<?php global $product; ?>
										<p class="h3 dtext noMar"><?php echo $product->get_price_html(); ?></p>
								</div>


								<?php $hasreviews = get_post_meta( get_the_ID(), '_wc_rating_count', true );
                    // var_dump($hasreviews);
								?>

								<?php if( !$hasreviews) { ?>
								    <button data-open="reviewModal" class='dtext marB20 block underline'>Write a review</button>
								<?php } ?>



				<?php } ?>

				</div>
		</div>


<?php } ?>
