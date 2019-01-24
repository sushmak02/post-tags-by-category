<?php

//Paste below code in your active Themes Functions.php file.

function custom_tags_by_category( $categories ){

	// Initialize the tag arrays
    $list_tags = array();

    foreach ( $categories as $key => $cat ) {

    	$category_id = get_cat_ID( $cat );
	    
	    // Set up the query for the posts with current category
	    $list_posts = new WP_Query( array(
	      'cat' => $category_id, // Current category id
	      'posts_per_page' => -1 // All posts from that category
	    ));

	    if ( $list_posts->have_posts() ) { 

	    	// If category has posts the check each post
	    	while ( $list_posts->have_posts() ) { 

	    		$list_posts->the_post();

				// Get all tags of the current post
				$post_tags = wp_get_post_tags( $list_posts->post->ID );

				// Loop through each tag
				foreach ( $post_tags as $tag ) {

					// Push each tag into the array if not already in it
					if ( !in_array( $tag, $list_tags ) ) {
						array_push( $list_tags, $tag );
					}
	     		}
	    	}
		}
	}
	return $list_tags;
}

//Pass one or mare category names in below array separated by comma
$cat_list = array( 'category' );

//Call above function to get the tags list
$tags_list = custom_tags_by_category( $cat_list );

return $tags_list;

?>