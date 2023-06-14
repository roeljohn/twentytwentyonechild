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