<?php
function site_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    // Adding scripts file in the footer
    wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/scripts/scripts.js', array( 'jquery' ), filemtime(get_template_directory() . '/assets/scripts/js'), true );
    wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/assets/scripts/slick.min.js', array( 'jquery' ), '', false );
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/scripts/jquery-2.2.0.min.js', array( 'jquery' ), '', true);
    wp_enqueue_script( 'stickem', get_template_directory_uri() . '/assets/scripts/jquery.stickem.js', array( 'jquery' ), '', true );
    // wp_enqueue_script( 'cookiejs', get_template_directory_uri() . '/assets/scripts/jquery.cookiebar.js', array( 'jquery' ), '', false );
    wp_enqueue_script( 'customjs', get_template_directory_uri() . '/assets/scripts/custom.js', array( 'jquery' ), '', false );


    // Register main stylesheet
    wp_enqueue_style( 'site-css', get_template_directory_uri() . '/assets/styles/style.css', array(), filemtime(get_template_directory() . '/assets/styles/scss'), 'all' );
    wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/assets/styles/slick.css', array(), '', 'all' );
    wp_enqueue_style( 'slick-theme-css', get_template_directory_uri() . '/assets/styles/slick-theme.css', array(), '', 'all' );
    wp_enqueue_style( 'hamburgers', get_template_directory_uri() . '/assets/styles/hamburgers.css', array(), '', 'all' );
    // wp_enqueue_style( 'cookiebar', get_template_directory_uri() . '/assets/styles/jquery.cookiebar.css', array(), '', 'all' );


    // Comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
}
add_action('wp_enqueue_scripts', 'site_scripts', 999);
