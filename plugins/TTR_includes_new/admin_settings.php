<?php
/**
 * TTR Settings
 * @package TTR Includes
 * @version 2.0
 */


/* Current Issue
-------------------------------------------------------------- */
function th_issue_settings_api_init() {
	// add issue settings section
	add_settings_section( 
		'th_issue_settings_section',
		false,
		'th_issue_settings_section_function',
		'general'
	);

	// current issue
	add_settings_field( 
		'th_current_issue',
		'Current Issue',
		'th_current_issue_settings_function',
		'general',
		'th_issue_settings_section'
	);

	register_setting( 'general', 'th_current_issue' );

	// section description
	function th_issue_settings_section_function() {
		echo '<hr><h2>Current Issue</h2><p>Set the current issue of The Third Rail.</p>';
	}

	// th_current_issue dropdown
	function th_current_issue_settings_function() {
		// get all issues
		$terms = get_terms( 'issue' );
		$th_current_issue = get_option( 'th_current_issue', '' );
		// build the select
		$output = '<select name="th_current_issue" id="th_current_issue"><option value="">Current Issue</option>';
		// build the options
		foreach ( $terms as $term ) {
			$selected = '';
			if ( $term->slug == $th_current_issue ) $selected = ' selected';

			$output .= '<option value="' . $term->slug . '"' . $selected . '>' . $term->name . '</option>';
		}
		// display it
		echo $output . '</select>';
	}

}
add_action( 'admin_init', 'th_issue_settings_api_init' );



/* Announcement Banner
-------------------------------------------------------------- */
function ttr_announcement() {

	add_settings_section( 
		'ttr_announcement_section',
		false,
		'ttr_announcement_section_function',
		'general'
	);

	add_settings_field( 
		'ttr_announcement_text',
		'Announcement Text',
		'ttr_announcement_text_function',
		'general',
		'ttr_announcement_section',
		array(
			'ttr_announcement_display'
		)
	);

	add_settings_field( 
		'ttr_announcement_page_id',
		'Announcement Page',
		'ttr_announcement_page_id_function',
		'general',
		'ttr_announcement_section'
	);

	register_setting( 'general', 'ttr_announcement_display' );
	register_setting( 'general', 'ttr_announcement_text' );
	register_setting( 'general', 'ttr_announcement_page_id' );

	// section description
	function ttr_announcement_section_function() {
		echo '<hr><h2>Announcement</h2><p>Page associated with this announcement banner.</p>';
	}

	function ttr_announcement_text_function() {
		echo '<p><input name="ttr_announcement_text" type="url" id="ttr_announcement_text" value="'.get_option('ttr_announcement_text', false).'" class="regular-text ltr" maxlength="75" /></p>';

		$checked = "";
		if ( get_option('ttr_announcement_display') == true ){ $checked = 'checked="checked"'; }
		echo '<p><label for="ttr_announcement_display"><input name="ttr_announcement_display" type="checkbox" id="ttr_announcement_display" value="1" '.$checked.'> Show Announcement Banner?</label></p>';

	}

	function ttr_announcement_page_id_function() {

		$ttr_announcement_page_id = get_option( 'ttr_announcement_page_id', false );

		$args = array( 
			'post_type' => 'page',
			'orderby' => 'title',
			'order' => 'ASC',
			'showposts' => -1,
			);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) : 
			// build the select
			$output = '<select name="ttr_announcement_page_id" id="ttr_announcement_page_id"><option value="">Announcement Page</option>';
			// build the options
			while ( $query->have_posts() ) : $query->the_post();

				$selected = '';
				if ( get_the_id() == $ttr_announcement_page_id ) $selected = ' selected';

				$output .= '<option value="' . get_the_id() . '"' . $selected . '>' . get_the_title() . '</option>';

			endwhile;
			
			// display it
			echo $output . '</select>';

		endif; wp_reset_query();
		
	}


}
add_action( 'admin_init', 'ttr_announcement' );



/* Information & Errata
-------------------------------------------------------------- */
function ttr_info_etc() {

	add_settings_section( 
		'ttr_info_section',
		false,
		'ttr_info_section_function',
		'general'
	);

	add_settings_field( 
		'ttr_info_page_id',
		'Information Page',
		'ttr_info_page_id_function',
		'general',
		'ttr_info_section'
	);

	register_setting( 'general', 'ttr_info_page_id' );

	// section description
	function ttr_info_section_function() {
		echo '<hr><h2>Information</h2><p>"About" and contact info for The Third Rail.</p>';
	}

	function ttr_info_page_id_function() {

		$ttr_info_page_id = get_option( 'ttr_info_page_id', false );

		$args = array( 
			'post_type' => 'page',
			'orderby' => 'title',
			'order' => 'ASC',
			'showposts' => -1,
			);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) : 
			// build the select
			$output = '<select name="ttr_info_page_id" id="ttr_info_page_id"><option value="">Information Page</option>';
			// build the options
			while ( $query->have_posts() ) : $query->the_post();

				$selected = '';
				if ( get_the_id() == $ttr_info_page_id ) $selected = ' selected';

				$output .= '<option value="' . get_the_id() . '"' . $selected . '>' . get_the_title() . '</option>';

			endwhile;
			
			// display it
			echo $output . '</select>';

		endif; wp_reset_query();
		
	}


}
add_action( 'admin_init', 'ttr_info_etc' );



/* Distribution & Collections
-------------------------------------------------------------- */
function ttr_details() {
	
	add_settings_section( 
		'ttr_distribution_and_collections_section',
		false,
		'ttr_distribution_and_collections_section_function',
		'general'
	);

	// distribution description
	add_settings_field(
		'ttr_distribution_description',
		'Distribution Description',
		'ttr_distribution_description_function',
		'general',
		'ttr_distribution_and_collections_section',
		array(
			'ttr_distribution_display'
		)
	);

	// distribution
	add_settings_field(
		'ttr_distribution',
		'Distribution',
		'ttr_distribution_function',
		'general',
		'ttr_distribution_and_collections_section'
	);

	register_setting( 'general', 'ttr_distribution_description' );
	register_setting( 'general', 'ttr_distribution_display' );
	register_setting( 'general', 'ttr_distribution' );

	// collections description
	add_settings_field(
		'ttr_collections_description',
		'Collections Description',
		'ttr_collections_description_function',
		'general',
		'ttr_distribution_and_collections_section',
		array(
			'ttr_collections_display'
		)
	);

	// collections
	add_settings_field(
		'ttr_collections',
		'Collections',
		'ttr_collections_function',
		'general',
		'ttr_distribution_and_collections_section'
	);

	register_setting( 'general', 'ttr_collections_description' );
	register_setting( 'general', 'ttr_collections_display' );
	register_setting( 'general', 'ttr_collections' );

	// section description
	function ttr_distribution_and_collections_section_function() {
		echo '<hr>';
		echo '<h2>Distribution &amp; Collections</h2>';
	}

	function ttr_distribution_description_function() {

		echo '<textarea rows="3" cols="70" name="ttr_distribution_description" id="ttr_distribution_description">'.get_option('ttr_distribution_description', false).'</textarea>';
		echo '<p class="description">The distribution description will appear above the distribution list on the home page.</p>';

		$checked = "";
		if ( get_option('ttr_distribution_display') == true ){ $checked = 'checked="checked"'; }
		echo '<p><label for="ttr_distribution_display"><input name="ttr_distribution_display" type="checkbox" id="ttr_distribution_display" value="1" '.$checked.'> Show Distribution Description?</label></p>';

	}

	function ttr_distribution_function() {
		echo '<textarea rows="20" cols="70" name="ttr_distribution" id="ttr_distribution">'.get_option('ttr_distribution', false).'</textarea>';
	}

	function ttr_collections_description_function() {

		echo '<textarea rows="3" cols="70" name="ttr_collections_description" id="ttr_collections_description">'.get_option('ttr_collections_description', false).'</textarea>';
		echo '<p class="description">The collections description will appear above the collections list on the home page.</p>';

		$checked = "";
		if ( get_option('ttr_collections_display') == true ){ $checked = 'checked="checked"'; }
		echo '<p><label for="ttr_collections_display"><input name="ttr_collections_display" type="checkbox" id="ttr_collections_display" value="1" '.$checked.'> Show Collections Description?</label></p>';

	}

	function ttr_collections_function() {
		echo '<textarea rows="20" cols="70" name="ttr_collections" id="ttr_collections">'.get_option('ttr_collections', false).'</textarea>';
	}

}
add_action( 'admin_init', 'ttr_details' );


?>