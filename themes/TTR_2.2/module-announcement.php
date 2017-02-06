<?php
/**
 * Special Announcement
 *
 * Used on the home page
 *
 * @package WordPress
 * @subpackage TTR
 */
?>

<?php 

if ( get_option('ttr_announcement_display') ) : 

	if ( get_option('ttr_announcement_text') && get_option('ttr_announcement_page_id') ) : 

		$post = get_post( get_option('ttr_announcement_page_id') );

		$special = false;
		if ( $custom_cover ) { $special = 'special'; }

		echo '<a id="announcement" class="'.$special.'" href="'.$post->guid.'"><p>'.get_option('ttr_announcement_text').'</p></a>';

	endif; 

endif; ?>
