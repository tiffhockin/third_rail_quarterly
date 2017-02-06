<?php
/**
 * Periodical Issues
 * @package TTR Includes
 * @version 1.0
 * @author Adapted from Periodical Publishing by [Chris Knowles](http://wpmu.org),
 * Adds functionality for publishing issue-based / periodical content
 */

// Register the issues Custom Taxonomy
// query_var => true provides automatic filtering of posts if issue in querystring
function th_custom_taxonomy_issue() {

	$labels = array(
		'name'                       => _x( 'Issues', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Issue', 'Taxonomy Singular Name', 'text_domain'),
		'menu_name'                  => __( 'Issues', 'text_domain' ),
		'all_items'                  => __( 'All issues', 'text_domain' ),
		'parent_item'                => __( '', 'text_domain' ),
		'parent_item_colon'          => __( '', 'text_domain' ),
		'new_item_name'              => __( 'Add New issue', 'text_domain' ),
		'edit_item'                  => __( 'Edit issue', 'text_domain' ),
		'update_item'                => __( 'Update issue', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate issues with commas', 'text_domain' ),
		'search_items'               => __( 'Search issues', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove issues', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used issues', 'text_domain' )
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'snow_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'query_var'                  => true,
		'has_archive'                => true,
		'rewrite'                    => array(
			'slug' => 'issue',
			'with_front' => true,
			'pages' => false
			)
	);
	register_taxonomy( 'issue', array('page','post'), $args );

}
// register the issue taxonomy via the init action
add_action( 'init', 'th_custom_taxonomy_issue' );

// Load meta field options
include 'taxonomy_issue_extras.php';

// admin columns
add_filter( 'manage_edit-issue_columns', 'issue_columns' );
function issue_columns( $issue_columns ) {
	$new_columns = array(
		'cb'          => '<input type="checkbox" />',
		'name'        => __( 'Issue' ),
		'color'       => __( 'Color' ),
		'description' => __( 'Desc.' ),
		'slug'        => __( 'Slug' ),
		'posts'       => __( 'Posts' )
		);
	return $new_columns;
}
// build columns
add_filter( 'manage_issue_custom_column', 'manage_issue_columns', 10, 3 );
function manage_issue_columns( $out, $column_name, $issue_id ) {
	$issue = get_term( $issue_id, 'issue' );
	switch ( $column_name ) {
		case 'color':
			// get color
			$term_meta = get_option( "taxonomy_term_$issue_id" );
			$color_background = $term_meta['issue_color'];
			$out .= '<div style="width:55px;height:55px;background-color:'. $color_background .';"></div>';
			break;
		default:
			break;
	}
	return $out;
}



/* Helper functions
-------------------------------------------------------------- */

// CURRENT EDITION OBJECT
// get all current issue info (not just the slug)
function th_get_current_issue_object() {
	$th_current_issue_object = get_term_by( 'slug', get_option( 'th_current_issue', false ), 'issue' );
	return $th_current_issue_object;
}

// CURRENT EDITION
function th_get_current_issue() {
	$th_current_issue = get_option( 'th_current_issue', false );
	return $th_current_issue;
}


?>