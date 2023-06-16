<?php

require_once( __DIR__ . '/functions/woocommerce-cart-is-empty.php');

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	$parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
	$theme        = wp_get_theme();
	wp_enqueue_style( $parenthandle,
		get_template_directory_uri() . '/style.css',
		array(),  // If the parent theme code has a dependency, copy it to here.
		$theme->parent()->get( 'Version' )
	);
	wp_enqueue_style( 'child-style',
		get_stylesheet_uri(),
		array( $parenthandle ),
		$theme->get( 'Version' ) // This only works if you have Version defined in the style header.
	);
}
add_action( 'woocommerce_single_product_summary', 'my_extra_button_on_product_page', 30 );

function my_extra_button_on_product_page() {
  global $product;
  echo '<a href="URL">Extra Button</a>';
}

add_action( 'woocommerce_single_product_summary', 'custom_product_title', 5 );
function custom_product_title() {
	$value = get_field( "product_sub_title", 61 );


    echo '<h1 class="custom-product-title">' . get_the_title() . ' ' . get_the_date() . ' </h1>';
	if( $value ) {
		echo $value;
	} else {
		echo 'test';
	}
}

add_action( 'woocommerce_after_cart_table', 'show_product_list');

function show_product_list(){
	require_once( __DIR__ . '/functions/add-to-cart-add-on.php');
}


add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text' );
function wcc_change_breadcrumb_home_text( $defaults ) {
	// Change the breadcrumb home text from 'Home' to 'Apartment'
	// Check if it's a single post
	if (is_singular()) {
		global $post;

		// Check if the post type is "product" (change "product" to your desired post type)
		if ($post->post_type === 'product') {
			$product_id = $post->ID; // Get the product ID of the current post

			// Check if the product ID matches a specific ID
			$desired_product_id = 26; // Replace 123 with your desired product ID
			if ($product_id === $desired_product_id) {
				// Custom code for the specific product

				/**
				 * Rename "home" in breadcrumb
				 */

				$defaults['home'] = 'Apartment';
				// You can add your custom logic here
			} else {
				// Custom code for other products

				// Example: Display a message
				null;

				// You can add your custom logic here
			}
		}
	}
	return $defaults;
}