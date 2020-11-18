<?php
/**
 * For more info: https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

// Theme support options
require_once(get_template_directory().'/functions/theme-support.php');

// WP Head and other cleanup functions
require_once(get_template_directory().'/functions/cleanup.php');

// Register scripts and stylesheets
require_once(get_template_directory().'/functions/enqueue-scripts.php');

// Register custom menus and menu walkers
require_once(get_template_directory().'/functions/menu.php');

// Register sidebars/widget areas
require_once(get_template_directory().'/functions/sidebar.php');

// Makes WordPress comments suck less
require_once(get_template_directory().'/functions/comments.php');

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/functions/page-navi.php');

// Adds support for multiple languages
require_once(get_template_directory().'/functions/translation/translation.php');

// Adds site styles to the WordPress editor
// require_once(get_template_directory().'/functions/editor-styles.php');

// Remove Emoji Support
// require_once(get_template_directory().'/functions/disable-emoji.php');

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/functions/related-posts.php');

// Use this as a template for custom post types
require_once(get_template_directory().'/functions/custom-post-type.php');

// Customize the WordPress login menu
// require_once(get_template_directory().'/functions/login.php');

// Customize the WordPress admin
// require_once(get_template_directory().'/functions/admin.php');


if( function_exists('acf_add_options_page') ) { acf_add_options_page(); }
if( function_exists('acf_add_options_page') ) {
  acf_add_options_sub_page(array(
		'page_title' 	=> 'Post Settings',
		'menu_title'	=> 'Post Settings',
		'pmenu_slug'	=> 'post-settings',
	    'capability' => 'edit_posts',
	    'parent_slug' => 'edit.php',
	    'position' => false,
	    'icon_url' => false
	));
}

function wpdocs_custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function my_wpcf7_form_elements($html) {
    $text = '-- Please select --';
    $html = str_replace('<option value="">---</option>', '<option disabled selected value="">' . $text . '</option>', $html);
    return $html;
}
add_filter('wpcf7_form_elements', 'my_wpcf7_form_elements');



//********Woocommerce********//

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


//Cart count
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );
function iconic_cart_count_fragments( $fragments ) {
    $fragments['span.header-cart-count'] = '<span class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
    return $fragments;
}


// /* Storing views of different time periods as meta keys */
// add_action( 'wpp_post_update_views', 'custom_wpp_update_postviews' );
// function custom_wpp_update_postviews($postid) {
// 	// Accuracy:
// 	//   10  = 1 in 10 visits will update view count. (Recommended for high traffic sites.)
// 	//   30 = 30% of visits. (Medium traffic websites)
// 	//   100 = Every visit. Creates many db write operations every request.
//
// 	$accuracy = 50;
//
// 	if ( function_exists('wpp_get_views') && (mt_rand(0,100) < $accuracy) ) {
// 		// Remove or comment out lines that you won't be using!!
// 		update_post_meta( $postid, 'views_total',   wpp_get_views( $postid )            );
// 		// update_post_meta( $postid, 'views_daily',   wpp_get_views( $postid, 'daily' )   );
// 		// update_post_meta( $postid, 'views_weekly',  wpp_get_views( $postid, 'weekly' )  );
// 		// update_post_meta( $postid, 'views_monthly', wpp_get_views( $postid, 'monthly' ) );
// 	}
// }
//

// Add filter
add_filter( 'woocommerce_placeholder_img_src', 'growdev_custom_woocommerce_placeholder', 10 );

/**
 * Function to return new placeholder image URL.
 */
function growdev_custom_woocommerce_placeholder( $image_url ) {
  $image_url = get_site_url() . '/assets/images/catdummy.png';  // change this to the URL to your custom placeholder
  return $image_url;
}

add_filter( 'template_include', 'custom_single_product_template_include', 50, 1 );
function custom_single_product_template_include( $template ) {
    if ( is_singular('product') && (has_term( 'courses', 'product_cat')) ) {
        $template = get_stylesheet_directory() . '/woocommerce/single-product-courses.php';
    }
    return $template;
}


//Reposition WooCommerce breadcrumb
function woocommerce_remove_breadcrumb(){
remove_action(
    'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
}
add_action(
    'woocommerce_before_main_content', 'woocommerce_remove_breadcrumb'
);
function woocommerce_custom_breadcrumb(){
    woocommerce_breadcrumb();
}
add_action( 'woo_custom_breadcrumb', 'woocommerce_custom_breadcrumb' );

//Archive cart link PPE
add_filter( 'woocommerce_loop_add_to_cart_link', 'ts_replace_add_to_cart_button', 10, 2 );
function ts_replace_add_to_cart_button( $button, $product ) {
    if (is_product_category() || is_shop()) {
        $button_text = __("View more", "woocommerce");
        $button_link = $product->get_permalink();
        // $button = '<a class="viewmore blue" href="' . $button_link . '"><span class="underline">' . $button_text .  '</span>></a>';
        $button = '';
        return $button;
    }
}

//Woocommerce Pagination
function woocommerce_pagination() {
    if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
      return;
    }

    $args = array(
      'total'   => wc_get_loop_prop( 'total_pages' ),
      'current' => wc_get_loop_prop( 'current_page' ),
      'base'    => esc_url_raw( add_query_arg( 'product-page', '%#%', false ) ),
      'format'  => '?product-page=%#%',
    );

    if ( ! wc_get_loop_prop( 'is_shortcode' ) ) {
      $args['format'] = '';
      $args['base']   = esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
    }

    wc_get_template( 'loop/pagination.php', $args );
}

// Remove product_result_count archive

add_action( 'after_setup_theme', 'my_remove_product_result_count', 99 );
function my_remove_product_result_count() {
    remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_after_shop_loop' , 'woocommerce_result_count', 20 );
}

remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

//Remove single product tabs

function remove_woocommerce_product_tabs( $tabs ) {
	unset( $tabs['description'] );
	unset( $tabs['reviews'] );
	unset( $tabs['additional_information'] );
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'remove_woocommerce_product_tabs', 98 );

//Add Qty label
add_action( 'woocommerce_before_add_to_cart_quantity', 'bbloomer_echo_qty_front_add_cart' );
function bbloomer_echo_qty_front_add_cart() {
  echo '<div class="qty title">Qty: </div>';
}


//REGISTRATION REDIRECT
add_filter( 'woocommerce_registration_redirect', 'custom_redirection_after_registration', 10, 1 );
function custom_redirection_after_registration( $redirection_url ){
    // Change the redirection Url
    $redirection_url = get_home_url(); // Home page
    return $redirection_url; // Always return something
}

//LOGIN REDIRECT
add_filter('woocommerce_login_redirect', 'custom_wc_login_redirect', 10, 3);
  function custom_wc_login_redirect( $redirect, $user ) {
  $redirect = site_url() . '/my-account/';
  return $redirect;
}
//Logout redirect
add_action( 'wp_logout', 'auto_redirect_external_after_logout');
function auto_redirect_external_after_logout(){
  wp_redirect( 'http://devsites-co-uk.stackstaging.com/hindsite/' );
  exit();
}


//Shop Pagination

add_filter( 'woocommerce_pagination_args', 	'change_woo_pagination' );
function change_woo_pagination( $args ) {

	$args['prev_text'] = '<i class="fas fa-chevron-left"></i>';
	$args['next_text'] = '<i class="fas fa-chevron-right"></i>';

	return $args;
}
