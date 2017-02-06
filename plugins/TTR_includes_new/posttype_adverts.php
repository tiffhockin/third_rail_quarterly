<?php
/**
* @package TTR Advertisement Post type
* @version 1.0
*/

function ttr_custom_adverts() {

	$labels = array(
		'name'                => _x( 'Advertisements', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Advertisements', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Advertisements', 'text_domain' ),
		'parent_item_colon'   => __( '', 'text_domain' ),
		'all_items'           => __( 'Advertisements', 'text_domain' ),
		'view_item'           => __( 'View Advertisements', 'text_domain' ),
		'add_new_item'        => __( 'Add New Advertisements', 'text_domain' ),
		'add_new'             => __( 'Add an Advertisement', 'text_domain' ),
		'edit_item'           => __( 'Edit Advertisements', 'text_domain' ),
		'update_item'         => __( 'Update Advertisements', 'text_domain' ),
		'search_items'        => __( 'Search Advertisements', 'text_domain' ),
		'not_found'           => __( 'No Advertisements here', 'text_domain' ),
		'not_found_in_trash'  => __( 'No Advertisements found in Trash', 'text_domain' ),
		'ttr_name'            => __( '')
	);
	$args = array(
		'label'               => __( 'Advertisements', 'text_domain' ),
		'description'         => __( 'Advertisements', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post'
	);
	register_post_type( 'ttr_adverts', $args );

}
// Hook into the 'init' action
add_action( 'init', 'ttr_custom_adverts', 0 );

// admin options
add_filter("manage_edit-ttr_adverts_columns", "ttr_adverts_edit_columns");
function ttr_adverts_edit_columns($ttr_adverts_columns){  
 $ttr_adverts_columns = array(  
	 "cb" => "<input type=\"checkbox\" />",  
	 "title" => "Advertiser",
	 "image" => "Images",
 	 "date" => "Date"
 );
 return $ttr_adverts_columns;  
}

add_action( 'manage_ttr_adverts_posts_custom_column', 'th_manage_ttr_adverts_columns', 10, 2 );
function th_manage_ttr_adverts_columns( $column, $post_id ) {

	global $post;

	switch( $column ) {

		case "image" :

			if ( function_exists('have_rows') ) :
				
				if ( have_rows('ad_images') ) {

					$counter = 0;
					$number_of_imgs = count( get_field( 'ad_images' ) );

					while ( have_rows('ad_images') ) {

						the_row();
						$image = get_sub_field('ad_images_image');

						if ( $image !== null ) {
							$img_src = wp_get_attachment_image( $image, array(65,65), true );
							echo '<div style="border:solid 1px #b4b9be; display:inline-block; width:65px; height:65px; margin-right:10px; padding:3px;">'.$img_src.'</div>';
						}
						$counter++;

					}

				} else {
				// there are no images
					echo 'NA';
				}

			endif;

			break;
	}

}

?>