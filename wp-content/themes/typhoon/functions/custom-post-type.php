<?php

// let's create the function for the custom type
function teams_cpt() {
	// creating (registering) the custom type
	register_post_type( 'teams', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Teams', 'jointswp'), /* This is the Title of the Group */
			'singular_name' => __('Team', 'jointswp'), /* This is the individual type */
			'all_items' => __('Teams', 'jointswp'), /* the all items menu item */
			'add_new' => __('Add New', 'jointswp'), /* The add new menu item */
			'add_new_item' => __('Add New Team', 'jointswp'), /* Add New Display Title */
			'edit' => __( 'Edit', 'jointswp' ), /* Edit Dialog */
			'edit_item' => __('Edit Team', 'jointswp'), /* Edit Display Title */
			'new_item' => __('New Team', 'jointswp'), /* New Display Title */
			'view_item' => __('View Team', 'jointswp'), /* View Display Title */
			'search_items' => __('Search Teams', 'jointswp'), /* Search Custom Type Title */
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'CPT for Teams', 'jointswp' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-admin-users', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
			'rewrite'	=> array( 'slug' => 'teams', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'team-riders', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */

	/* this adds your post categories to your custom post type */
	// register_taxonomy_for_object_type('category', 'teams');
	/* this adds your post tags to your custom post type */
	// register_taxonomy_for_object_type('post_tag', 'sectors');

}
add_action( 'init', 'teams_cpt');


function testimonials_cpt() {
	// creating (registering) the custom type
	register_post_type( 'testimonials', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Testimonials', 'jointswp'), /* This is the Title of the Group */
			'singular_name' => __('Testimonial', 'jointswp'), /* This is the individual type */
			'all_items' => __('Testimonials', 'jointswp'), /* the all items menu item */
			'add_new' => __('Add New', 'jointswp'), /* The add new menu item */
			'add_new_item' => __('Add New Testimonial', 'jointswp'), /* Add New Display Title */
			'edit' => __( 'Edit', 'jointswp' ), /* Edit Dialog */
			'edit_item' => __('Edit Testimonial', 'jointswp'), /* Edit Display Title */
			'new_item' => __('New Testimonial', 'jointswp'), /* New Display Title */
			'view_item' => __('View Testimonial', 'jointswp'), /* View Display Title */
			'search_items' => __('Search Testimonials', 'jointswp'), /* Search Custom Type Title */
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'CPT for Testimonials', 'jointswp' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-format-chat', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
			'rewrite'	=> array( 'slug' => 'testimonials', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'testimonials', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */

}
add_action( 'init', 'testimonials_cpt');


function events_cpt() {
	// creating (registering) the custom type
	register_post_type( 'events', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Events', 'jointswp'), /* This is the Title of the Group */
			'singular_name' => __('Event', 'jointswp'), /* This is the individual type */
			'all_items' => __('Events', 'jointswp'), /* the all items menu item */
			'add_new' => __('Add New', 'jointswp'), /* The add new menu item */
			'add_new_item' => __('Add New Event', 'jointswp'), /* Add New Display Title */
			'edit' => __( 'Edit', 'jointswp' ), /* Edit Dialog */
			'edit_item' => __('Edit Event', 'jointswp'), /* Edit Display Title */
			'new_item' => __('New Event', 'jointswp'), /* New Display Title */
			'view_item' => __('View Event', 'jointswp'), /* View Display Title */
			'search_items' => __('Search Events', 'jointswp'), /* Search Custom Type Title */
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'CPT for Events', 'jointswp' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-excerpt-view', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
			'rewrite'	=> array( 'slug' => 'events', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'events', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */

	/* this adds your post categories to your custom post type */
	// register_taxonomy_for_object_type('category', 'teams');
	/* this adds your post tags to your custom post type */
	// register_taxonomy_for_object_type('post_tag', 'sectors');

}

	// adding the function to the Wordpress init
	add_action( 'init', 'events_cpt');

	// now let's add custom categories (these act like categories)
register_taxonomy( 'events_cat',
    	array('events'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */
    		'labels' => array(
    			'name' => __( 'Event Categories', 'jointswp' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Event Category', 'jointswp' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Event Categories', 'jointswp' ), /* search title for taxomony */
    			'all_items' => __( 'All Event Categories', 'jointswp' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Event Category', 'jointswp' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Event Category:', 'jointswp' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Event Category', 'jointswp' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Event Category', 'jointswp' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Event Category', 'jointswp' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Event Category Name', 'jointswp' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'event-cats' ),
    	)
    );

function stockist_cpt() {
			// creating (registering) the custom type
    register_post_type( 'stockists', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
			 	// let's now add all the options for this post type
		    array('labels' => array(
						'name' => __('Stockists', 'jointswp'), /* This is the Title of the Group */
						'singular_name' => __('Stockist', 'jointswp'), /* This is the individual type */
						'all_items' => __('Stockists', 'jointswp'), /* the all items menu item */
						'add_new' => __('Add New', 'jointswp'), /* The add new menu item */
						'add_new_item' => __('Add New Stockist', 'jointswp'), /* Add New Display Title */
						'edit' => __( 'Edit', 'jointswp' ), /* Edit Dialog */
						'edit_item' => __('Edit Stockist', 'jointswp'), /* Edit Display Title */
						'new_item' => __('New Stockist', 'jointswp'), /* New Display Title */
						'view_item' => __('View Stockist', 'jointswp'), /* View Display Title */
						'search_items' => __('Search Stockists', 'jointswp'), /* Search Custom Type Title */
						'not_found' =>  __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */
						'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
						'parent_item_colon' => ''
						), /* end of arrays */
						'description' => __( 'CPT for Stockists', 'jointswp' ), /* Custom Type Description */
						'public' => true,
						'publicly_queryable' => true,
						'exclude_from_search' => false,
						'show_ui' => true,
						'query_var' => true,
						'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
						'menu_icon' => 'dashicons-welcome-add-page', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
						'rewrite'	=> array( 'slug' => 'stockists', 'with_front' => false ), /* you can specify its url slug */
						'has_archive' => 'stockists', /* you can rename the slug here */
						'capability_type' => 'post',
						'hierarchical' => false,
						/* the next one is important, it tells what's enabled in the post editor */
						'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
			 	) /* end of options */
		); /* end of register post type */

			/* this adds your post categories to your custom post type */
			// register_taxonomy_for_object_type('category', 'teams');
			/* this adds your post tags to your custom post type */
			// register_taxonomy_for_object_type('post_tag', 'sectors');

}

			// adding the function to the Wordpress init
add_action( 'init', 'stockist_cpt');

			// now let's add custom categories (these act like categories)
register_taxonomy( 'stockist_cat',
    array('stockists'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
				'labels' => array(
					'name' => __( 'Stockist Categories', 'jointswp' ), /* name of the custom taxonomy */
					'singular_name' => __( 'Stockist Category', 'jointswp' ), /* single taxonomy name */
					'search_items' =>  __( 'Search Stockist Categories', 'jointswp' ), /* search title for taxomony */
					'all_items' => __( 'All Stockist Categories', 'jointswp' ), /* all title for taxonomies */
					'parent_item' => __( 'Parent Stockist Category', 'jointswp' ), /* parent title for taxonomy */
					'parent_item_colon' => __( 'Parent Stockist Category:', 'jointswp' ), /* parent taxonomy title */
					'edit_item' => __( 'Edit Stockist Category', 'jointswp' ), /* edit custom taxonomy title */
					'update_item' => __( 'Update Stockist Category', 'jointswp' ), /* update title for taxonomy */
					'add_new_item' => __( 'Add New Stockist Category', 'jointswp' ), /* add new title for taxonomy */
					'new_item_name' => __( 'New Stockist Category Name', 'jointswp' ) /* name title for taxonomy */
				),
				'show_admin_column' => true,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'stockist-cats' ),
		)
);



function sizechart_cpt() {
			// creating (registering) the custom type
    register_post_type( 'sizecharts', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
			 	// let's now add all the options for this post type
		    array('labels' => array(
						'name' => __('Size Charts', 'jointswp'), /* This is the Title of the Group */
						'singular_name' => __('Size Chart', 'jointswp'), /* This is the individual type */
						'all_items' => __('Size Charts', 'jointswp'), /* the all items menu item */
						'add_new' => __('Add New', 'jointswp'), /* The add new menu item */
						'add_new_item' => __('Add New Size Chart', 'jointswp'), /* Add New Display Title */
						'edit' => __( 'Edit', 'jointswp' ), /* Edit Dialog */
						'edit_item' => __('Edit Size Chart', 'jointswp'), /* Edit Display Title */
						'new_item' => __('New Size Chart', 'jointswp'), /* New Display Title */
						'view_item' => __('View Size Chart', 'jointswp'), /* View Display Title */
						'search_items' => __('Search Size Charts', 'jointswp'), /* Search Custom Type Title */
						'not_found' =>  __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */
						'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
						'parent_item_colon' => ''
						), /* end of arrays */
						'description' => __( 'CPT for Size Charts', 'jointswp' ), /* Custom Type Description */
						'public' => true,
						'publicly_queryable' => true,
						'exclude_from_search' => false,
						'show_ui' => true,
						'query_var' => true,
						'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
						'menu_icon' => 'dashicons-feedback', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
						'rewrite'	=> array( 'slug' => 'sizecharts', 'with_front' => false ), /* you can specify its url slug */
						'has_archive' => 'size-charts', /* you can rename the slug here */
						'capability_type' => 'post',
						'hierarchical' => false,
						/* the next one is important, it tells what's enabled in the post editor */
						'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
			 	) /* end of options */
		); /* end of register post type */

			/* this adds your post categories to your custom post type */
			// register_taxonomy_for_object_type('category', 'teams');
			/* this adds your post tags to your custom post type */
			// register_taxonomy_for_object_type('post_tag', 'sectors');

}

			// adding the function to the Wordpress init
add_action( 'init', 'sizechart_cpt');

			// now let's add custom categories (these act like categories)
register_taxonomy( 'sizechart_cat',
    array('sizecharts'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
				'labels' => array(
					'name' => __( 'Size Chart Categories', 'jointswp' ), /* name of the custom taxonomy */
					'singular_name' => __( 'Size Chart Category', 'jointswp' ), /* single taxonomy name */
					'search_items' =>  __( 'Search Size Chart Categories', 'jointswp' ), /* search title for taxomony */
					'all_items' => __( 'All Size Chart Categories', 'jointswp' ), /* all title for taxonomies */
					'parent_item' => __( 'Parent Size Chart Category', 'jointswp' ), /* parent title for taxonomy */
					'parent_item_colon' => __( 'Parent Size Chart Category:', 'jointswp' ), /* parent taxonomy title */
					'edit_item' => __( 'Edit Size Chart Category', 'jointswp' ), /* edit custom taxonomy title */
					'update_item' => __( 'Update Size Chart Category', 'jointswp' ), /* update title for taxonomy */
					'add_new_item' => __( 'Add New Size Chart Category', 'jointswp' ), /* add new title for taxonomy */
					'new_item_name' => __( 'New Size Chart Category Name', 'jointswp' ) /* name title for taxonomy */
				),
				'show_admin_column' => true,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'sizechart-cats' ),
		)
);
