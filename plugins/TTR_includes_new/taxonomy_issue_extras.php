<?php
/**
 * Custom Fields for Periodical Issues
 * @package TTR Includes
 * @version 1.0
 */

// http://sabramedia.com/blog/how-to-add-custom-fields-to-custom-taxonomies

// callback function to add a color field to the issues taxonomy
function issue_taxonomy_custom_fields( $issue ) {
   // Check for existing taxonomy meta for the term you're editing
    $issue_id = $issue->term_id; // Get the ID of the term you're editing
    $term_meta = get_option( "taxonomy_term_$issue_id" ); // Do the check

?>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="issue_color"><?php _e('Issue Color'); ?></label>
	</th>
	<td>
		<input type="color" name="term_meta[issue_color]" id="term_meta[issue_color]" value="<?php echo $term_meta['issue_color'] ? $term_meta['issue_color'] : '#8c8c8c'; ?>" style="height:75px;width:95%;"><br />
		<p class="description"><?php _e('Click the field above to set this issue\'s primary, or light, color.'); ?></p>
	</td>
</tr>

<?php
}

// callback function to save
function save_taxonomy_custom_fields( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_term_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $cat_keys as $key ){
            if ( isset( $_POST['term_meta'][$key] ) ){
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        //save the option array
        update_option( "taxonomy_term_$t_id", $term_meta );
    }
}

// Add the custom field to the 'issues' taxonomy
add_action( 'issue_edit_form_fields', 'issue_taxonomy_custom_fields', 10, 2 );

// Save the changes made on the "presenters" taxonomy, using our callback function
add_action( 'edited_issue', 'save_taxonomy_custom_fields', 10, 2 );