<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
    <head>
    		<meta charset="utf-8">
    		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    		<meta class="foundation-mq">
    		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
      			<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
    	  <?php } ?>
    		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
			<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/boxchilli.css">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
        <link rel="stylesheet" href="https://use.typekit.net/tok4bnn.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    		<?php wp_head(); ?>
    </head>
	  <body <?php body_class(); ?>>

    		<div class="off-canvas-wrapper">
            
    		    <div class="off-canvas-content" data-off-canvas-content>

                <header class='header' role="banner">
        					 <?php get_template_part( 'parts/nav', 'title-bar' ); ?>
        				</header>
