<?php
// Register menus
register_nav_menus(
	array(
		'main-nav'		=> __( 'The Main Menu', 'jointswp' ),		// Main nav in header
		'top-bar'    => __( 'Top Bar Menu', 'jointswp'),      // Top bar menu in header
		'shop-footer'	=> __( 'Shop Footer', 'jointswp' ),			// Shop menu in footer
		'more-footer'	=> __( 'More Footer', 'jointswp' ),			// More menu in footer
		'comp-footer'	=> __( 'Company Footer', 'jointswp' ),	// Company menu in footer
		'info-footer'	=> __( 'Info Footer', 'jointswp' ),	// Info menu in footer
		'mob-nav'	=> __( 'Mob Nav', 'jointswp' ),	// Mobile drilldown menu
	)
);

// The Top Menu
function joints_top_nav() {
	wp_nav_menu(array(
		'container'			=> false,						// Remove nav container
		'menu_id'			=> 'main-nav',					// Adding custom nav id
		'menu_class'		=> 'large-horizontal menu',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion large-dropdown">%3$s</ul>',
		'theme_location'	=> 'main-nav',					// Where it's located in the theme
		'depth'				=> 5,							// Limit the depth of the nav
		'fallback_cb'		=> false,						// Fallback function (see below)
		'walker'			=> new Topbar_Menu_Walker()
	));
}

// Big thanks to Brett Mason (https://github.com/brettsmason) for the awesome walker
class Topbar_Menu_Walker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 2, $args = Array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"menu\">\n";
	}
}

//Mobile Menu
function mob_nav() {
	wp_nav_menu(array(
		'container'			=> false,						// Remove nav container
		'menu_id'			=> 'mob-nav',					// Adding custom nav id
		'menu_class'		=> 'vertical menu drilldown',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s" data-drilldown data-auto-height="true" data-animate-height="true">%3$s</ul>',
		'theme_location'	=> 'mob-nav',					// Where it's located in the theme
		'depth'				=> 5,							// Limit the depth of the nav
		'fallback_cb'		=> false,						// Fallback function (see below)
	));
}

// Top bar menu
function top_bar() {
	wp_nav_menu(array(
		'container'			=> 'false',				// Remove nav container
		'menu_id'			=> 'top-bar',		// Adding custom nav id
		'menu_class'		=> 'menu',				// Adding custom nav class
		'theme_location'	=> 'top-bar',		// Where it's located in the theme
		'depth'				=> 0,					// Limit the depth of the nav
		'fallback_cb'		=> ''					// Fallback function
	));
}

// The Shop Footer Menu
function shop_footer() {
	wp_nav_menu(array(
		'container'			=> 'false',				// Remove nav container
		'menu_id'			=> 'shop-footer',		// Adding custom nav id
		'menu_class'		=> 'menu',				// Adding custom nav class
		'theme_location'	=> 'shop-footer',		// Where it's located in the theme
		'depth'				=> 0,					// Limit the depth of the nav
		'fallback_cb'		=> ''					// Fallback function
	));
}

// The More Footer Menu
function more_footer() {
	wp_nav_menu(array(
		'container'			=> 'false',				// Remove nav container
		'menu_id'			=> 'more-footer',		// Adding custom nav id
		'menu_class'		=> 'menu',				// Adding custom nav class
		'theme_location'	=> 'more-footer',		// Where it's located in the theme
		'depth'				=> 0,					// Limit the depth of the nav
		'fallback_cb'		=> ''					// Fallback function
	));
}
// The Company Footer Menu
function comp_footer() {
	wp_nav_menu(array(
		'container'			=> 'false',				// Remove nav container
		'menu_id'			=> 'comp-footer',		// Adding custom nav id
		'menu_class'		=> 'menu',				// Adding custom nav class
		'theme_location'	=> 'comp-footer',		// Where it's located in the theme
		'depth'				=> 0,					// Limit the depth of the nav
		'fallback_cb'		=> ''					// Fallback function
	));
}

function info_footer() {
	wp_nav_menu(array(
		'container'			=> 'false',				// Remove nav container
		'menu_id'			=> 'info-footer',		// Adding custom nav id
		'menu_class'		=> 'menu',				// Adding custom nav class
		'theme_location'	=> 'info-footer',		// Where it's located in the theme
		'depth'				=> 0,					// Limit the depth of the nav
		'fallback_cb'		=> ''					// Fallback function
	));
}



// Add Foundation active class to menu
function required_active_nav_class( $classes, $item ) {
	if ( $item->current == 1 || $item->current_item_ancestor == true ) {
		$classes[] = 'active';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );
