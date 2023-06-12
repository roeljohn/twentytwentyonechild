<?php
// Set the category slug you want to retrieve products from
$category_slug = 'add-on';

// Query arguments
$args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'orderby' => 'rand',
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $category_slug,
        ),
    ),
);

// Create a new instance of WP_Query
$query = new WP_Query($args);

// Check if there are any products found
if ($query->have_posts()) {
    // Start the product loop
    while ($query->have_posts()) {
        $query->the_post();
        
        // Access the current product object
        global $product;
        
        // Get the product ID and name
        $product_id = $product->get_id();
        $product_name = $product->get_name();

        // Output the product details
        echo 'Product ID: ' . $product_id . '<br>';
        echo 'Product Name: ' . $product_name . '<br>';
        echo '--------------------<br>';

    }
    
    // Reset the global post data
    wp_reset_postdata();
} else {
    // Output message if no products found
    echo 'No products found.';
}