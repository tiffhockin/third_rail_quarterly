<?php
/**
 * Authors Taxonomy
 * @package TTR Includes
 * @version 2.0
 */

// Register the Custom Taxonomy
// query_var => true provides automatic filtering of posts if author in querystring
function custom_th_author_taxonomy() {

	$labels = array(
		'name'                       => _x( 'TTR Author', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Author', 'Taxonomy Singular Name', 'text_domain'),
		'menu_name'                  => __( 'Authors', 'text_domain' ),
		'all_items'                  => __( 'All Authors', 'text_domain' ),
		'parent_item'                => __( 'Parent Author', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Author:', 'text_domain' ),
		'new_item_name'              => __( 'Add New Author', 'text_domain' ),
		'edit_item'                  => __( 'Edit Author', 'text_domain' ),
		'update_item'                => __( 'Update Author', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate authors with commas', 'text_domain' ),
		'search_items'               => __( 'Search authors', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove authors', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used authors', 'text_domain' )
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'snow_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => true,
		'rewrite'                    => false
	);
	register_taxonomy( 'th_author', 'post', $args );

}
// register the Author taxonomy via the init action
add_action( 'init', 'custom_th_author_taxonomy' );

// Load meta field options
// require_once( 'taxonomy_authors-extras.php' );

// admin columns
add_filter( 'manage_edit-th_author_columns', 'th_author_columns' );
function th_author_columns( $th_author_columns ) {
	$new_columns = array(
		'cb'          => '<input type="checkbox" />',
		'name'        => __( 'Author' ),
		'slug'        => __( 'Slug' ),
		'posts'       => __( 'articles' )
		);
	return $new_columns;
}
// build columns
add_filter( 'manage_th_author_custom_column', 'manage_th_author_columns', 10, 3 );
function manage_th_author_columns( $out, $column_name, $th_author_id ) {
	$th_author = get_term( $th_author_id, 'th_author' );
	switch ( $column_name ) {
		default:
			break;
	}
	return $out;
}


