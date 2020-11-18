<?php

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

// Use this as a template for custom post types
require_once(get_template_directory().'/functions/custom-post-type.php');


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

add_filter( 'big_image_size_threshold', '__return_false' );

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

function customize_add_button_atts( $attributes ) {
  return array_merge( $attributes, array(
    'text' => '+ Add another item number',
  ) );
}
add_filter( 'wpcf7_field_group_add_button_atts', 'customize_add_button_atts' );

function customize_remove_button_atts( $attributes ) {
  return array_merge( $attributes, array(
    'text' => '- Remove',
  ) );
}
add_filter( 'wpcf7_field_group_remove_button_atts', 'customize_remove_button_atts' );



//********Woocommerce********//

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

//Woocommerce gallery thumbnail size
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
	return array(
		'height' => 560,
    'width' => '',
		'crop'   => 0,
	);
} );


// Change product title from h2 to p.
// Show the product title in the product loop. By default this is an H2.
if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
    function woocommerce_template_loop_product_title() {
        echo '<p class="woocommerce-loop-product__title center marB10">' . get_the_title() . '</p>';
    }
}
function custom_codefactry_single_product_image_html( $html, $post_id ) {
    return get_the_post_thumbnail( $post_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
}
add_filter('woocommerce_single_product_image_html', 'custom_codefactry_single_product_image_html', 10, 2);


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'woocommerce_after_single_product_summary', 'related_upsell_products', 15 );

function related_upsell_products() {
    global $product;

    if ( isset( $product ) && is_product() ) {
        $upsells = $product->get_upsell_ids();

        if ( sizeof( $upsells ) > 0 ) {
            woocommerce_upsell_display();
        } else {
            woocommerce_upsell_display();
            woocommerce_output_related_products();
        }
    }
}


//Create trade user scrollLeft
$wp_roles = wp_roles();

$customerRole = $wp_roles->get_role( 'customer' ); // Copy customer role capabilities

$role = 'trade';
$display_name = 'Trade';
add_role( $role , $display_name , $customerRole->capabilities );


//Cart count
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );
function iconic_cart_count_fragments( $fragments ) {
    //
    // $fragments['span.header-cart-count'] = '<span class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
    // return $fragments;
    if ( WC()->cart->get_cart_contents_count() == 0 ) {
      $fragments['span.header-cart-count'] = '<span class="header-cart-count rel"><span class=""></span></span>';
        return $fragments;
    } else {
      $fragments['span.header-cart-count'] = '<span class="header-cart-count rel"><span class="green dot"></span></span>';
        return $fragments;
    }
}

// Hide add to cart button on archive
add_action( 'woocommerce_after_shop_loop_item', 'remove_add_to_cart_buttons', 1 );
function remove_add_to_cart_buttons() {
  if( is_product_category() || is_shop()) {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
  }
}

//Move coupon field in checkout
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_coupon_form', 5 );

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

add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = ' <span class="material-icons"> keyboard_arrow_right </span> ';
	return $defaults;
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


//Remove single product tabs

// function remove_woocommerce_product_tabs( $tabs ) {
// 	unset( $tabs['description'] );
// 	unset( $tabs['reviews'] );
// 	unset( $tabs['additional_information'] );
// 	return $tabs;
// }
// add_filter( 'woocommerce_product_tabs', 'remove_woocommerce_product_tabs', 98 );
//
// function woocommerce_template_product_reviews() {
// woocommerce_get_template( 'single-product-reviews.php' );
// }
// // add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_product_reviews', 50 );
// add_action( 'woocommerce_after_single_product_summary', 'comments_template', 50 );



add_filter( 'woocommerce_get_availability_text', 'bbloomer_custom_get_availability_text', 99, 2 );
function bbloomer_custom_get_availability_text( $availability, $product ) {
    $stock = $product->get_stock_quantity();
    if ( $product->is_in_stock() && $stock < 11 ) {
        // if ($stock == 1) {
        //     $verb = "is";
        // } else {
        //     $verb = "are";
        // }
        // $availability = "There " . $verb . " only " . $stock . " left!";
        $availability = "<p class='limstock dtext'><span class='orange'>&#183;</span> Limited Stock in Select Sizes</p>";
    }
    return $availability;
}

//Add Qty label
// add_action( 'woocommerce_before_add_to_cart_quantity', 'bbloomer_echo_qty_front_add_cart' );
// function bbloomer_echo_qty_front_add_cart() {
//   echo '<div class="qty title">Qty: </div>';
// }

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30);

//Custom thumbnail size
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width' => 530,
        'height' => 680,
        'crop' => 0,
    );
} );


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
  wp_redirect( 'http://devsites-co-uk.stackstaging.com/typhoon/' );
  exit();
}


//Redirect my account if user is not logged in
add_action( 'template_redirect', 'redirect_to_specific_page' );
function redirect_to_specific_page() {

if ( is_page('my-account') && ! is_user_logged_in() ) {

wp_redirect( 'http://devsites-co-uk.stackstaging.com/typhoon/login', 301 );
  exit;
    }
}


//My account customisations

function my_account_menu_order() {
 	$menuOrder = array(
    'edit-account'    	=> __( 'Personal details', 'woocommerce' ),
    'edit-address'       => __( 'Address book', 'woocommerce' ),
 		'orders'             => __( 'Order history', 'woocommerce' ),
		// 'dashboard'          => __( 'Dashboard', 'woocommerce' ),
    // 'payment-methods'   => __( 'Payment methods', 'woocommerce' ),
    'customer-logout'    => __( 'Logout', 'woocommerce' ),
 	);
 	return $menuOrder;
 }
 add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );

//Shop Pagination

// add_filter( 'woocommerce_pagination_args', 	'change_woo_pagination' );
// function change_woo_pagination( $args ) {
//
// 	$args['prev_text'] = '<i class="fas fa-chevron-left"></i>';
// 	$args['next_text'] = '<i class="fas fa-chevron-right"></i>';
//
// 	return $args;
// }
