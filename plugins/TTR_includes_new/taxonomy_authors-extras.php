<?php
/**
 * Authors Taxonomy Custom Fields
 * @package TTR Includes
 * @version 2.0
 */

// A callback function to add a custom field to our "authors" taxonomy  
function th_author_taxonomy_custom_fields($tag) {  
   // Check for existing taxonomy meta for the term you're editing  
	$t_id = $tag->term_id; // Get the ID of the term you're editing  
	$term_meta = get_option( "th_author_term_$t_id" ); // Do the check  
?>  
  
<tr class="form-field">  
	<th scope="row" valign="top">  
		<label for="author_website"><?php _e('Author\'s website'); ?></label>  
	</th>  
	<td>  
		<input type="text" name="term_meta[author_website]" id="term_meta[author_website]" size="25" style="width:60%;" value="<?php echo $term_meta['author_website'] ? $term_meta['author_website'] : ''; ?>"><br />  
		<span class="description"><?php _e('You must included "http://". Example: http://www.website.com'); ?></span>  
	</td>  
</tr>  
  
<?php  
}

// A callback function to save our extra taxonomy field(s)  
function save_author_custom_fields( $term_id ) {  
    if ( isset( $_POST['term_meta'] ) ) {  
        $t_id = $term_id;  
        $term_meta = get_option( "th_author_term_$t_id" );  
        $cat_keys = array_keys( $_POST['term_meta'] );  
            foreach ( $cat_keys as $key ){  
            if ( isset( $_POST['term_meta'][$key] ) ){  
                $term_meta[$key] = $_POST['term_meta'][$key];  
            }  
        }  
        //save the option array  
        update_option( "th_author_term_$t_id", $term_meta );  
    }  
}  

// Add the fields to the "authors" taxonomy, using our callback function  
add_action( 'author_edit_form_fields', 'th_author_taxonomy_custom_fields', 10, 2 );  
  
// Save the changes made on the "authors" taxonomy, using our callback function  
add_action( 'edited_author', 'save_taxonomy_custom_fields', 10, 2 );  