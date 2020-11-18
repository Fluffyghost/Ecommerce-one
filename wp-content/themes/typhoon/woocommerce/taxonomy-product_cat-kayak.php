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

<div class='shopArchive'>

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



		<section class='catTaxWrap'>
        <div class='grid-container full pad90W'>
            <div class='grid-x grid-margin-x marT60'>
                <div class='large-12 cell taxcatwrap' id='scrollcat'>
                    <div class='taxcatwrapinner'>

                        <?php $args = array(
                              'taxonomy' => 'product_cat',
                              'hide_empty' => false,
                              'parent'   => 253,
                              // 'exclude' => 481,
                              'include' => array(254, 426, 428, 266),
                            );
                            $product_cat = get_terms( $args );
                            foreach ($product_cat as $parent_product_cat) {
                                if($parent_product_cat->term_id !== 266) :
                        ?>

                            <div class="prodCatBox marB30">
                               <a href="<?php echo get_term_link($parent_product_cat->term_id) ?>">
                                   <?php
                                       $thumbnail_id = get_term_meta($parent_product_cat->term_id, 'thumbnail_id', true);
                                       $image = wp_get_attachment_url($thumbnail_id);
                                   ?>
                                   <?php if ( wp_get_attachment_url($thumbnail_id) ) { ?>
                                      <img class='catImg' src='<?php echo $image ?>' />
                                   <?php } else { ?>
                                       <img src="<?php bloginfo('template_directory'); ?>/assets/images/catdummy.jpg" alt="<?php the_title(); ?>" />
                                   <?php } ?>
                                   <p class='dtext mar20'><?php echo $parent_product_cat->name ?></p>
                               </a>
                            </div>

                        <?php endif; }
                        foreach ($product_cat as $parent_product_cat) {
                                if($parent_product_cat->term_id == 266) :
                        ?>

                            <div class="prodCatBox marB30">
                               <a href="<?php echo get_term_link($parent_product_cat->term_id) ?>">
                                   <?php
                                       $thumbnail_id = get_term_meta($parent_product_cat->term_id, 'thumbnail_id', true);
                                       $image = wp_get_attachment_url($thumbnail_id);
                                   ?>
                                   <?php if ( wp_get_attachment_url($thumbnail_id) ) { ?>
                                      <img class='catImg' src='<?php echo $image ?>' />
                                   <?php } else { ?>
                                       <img src="<?php bloginfo('template_directory'); ?>/assets/images/catdummy.jpg" alt="<?php the_title(); ?>" />
                                   <?php } ?>
                                   <p class='dtext mar20'><?php echo $parent_product_cat->name ?></p>
                               </a>
                            </div>

                        <?php endif; } ?>

                   </div>

                </div>
						</div>
            <div class="grid-x marB120 barWrap showmed">
                <div class="large-12 cell">
                    <div class="progress-container">
                        <div class="progress-bar" id="catBar"></div>
                    </div>
                </div>
            </div>
				</div>
		</section>

    <section class="topProducts">
        <div class="grid-container full">
            <div class="grid-x grid-margin-x marT120">
                <div class="large-12 cell">
                    <h2 class="dtext marB50 center">Top Kayaking products</h2>
                    <div class="topWrap rel" id="scrollprod">
                        <div class="topinner"><?php echo do_shortcode('[products limit="6" columns="6" orderby="popularity" category="kayak" ]'); ?></div>
                    </div>
                </div>
            </div>
            <div class="grid-x marB120 barWrap">
                <div class="large-12 cell">
                    <div class="progress-container">
                        <div class="progress-bar" id="myBar"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (get_field('cat_text_col_title', $taxonomy . '_' . $term_id)) : ?>
        <section class="catFullWidth">
            <div class="grid-container full pad90W">
                <div class="grid-x grid-margin-x xlgW marB100">
                    <div class="large-12 cell">
                        <h3 class="dtext marB15"><?php echo get_field('cat_text_col_title', $queried_object); ?></h3>
                        <?php if (get_field('cat_text_col_text', $taxonomy . '_' . $term_id)) : ?>
                            <div class="dtext"><?php echo get_field('cat_text_col_text', $queried_object); ?></div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php get_template_part( 'parts/customer', 'info' ); ?>


</div>

<?php get_footer( 'shop' );
