<?php
/* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	Theme setup
----------------------------------------------- */

// GO!
function ttr_setup() {

	// add theme support
	add_theme_support( 'html5', array( 'search-form', 'caption' ) );
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'ttr_thumb_metaboxes', 200, 150, true );
	add_image_size( 'ttr_thumb', 300, 200, true );
	add_image_size( 'ttr_thumb_retina', 600, 400, true );
	add_image_size( 'ttr_advert', 300, 300, true );
	add_image_size( 'ttr_advert_retina', 600, 600, true );

	// disable content width
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = '';

	// nav menus
	register_nav_menus( array( 
		  'main-menu' => __( 'Main Menu', 'ttr' ),
		  'footer-menu' => __( 'Footer Menu', 'ttr' )
		)
	);

}
add_action( 'after_setup_theme', 'ttr_setup' );

add_filter( 'the_title', 'title' );
function title( $title ) {
	if ( $title == '' ) {
		// title separator
		return '';
	} else {
		return $title;
	}
}



/* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	Issue Info
----------------------------------------------- */

global $page_color;
// current issue (in circulation right now)
global $current_issue;
// the issue we're looking at on the site
global $this_issue;
// is it an archive page? works with this_issue
global $archive;

// CURRENT ISSUE
// returns the slug of the current issue
if ( function_exists('th_get_current_issue') ) {
	$current_issue = th_get_current_issue();
} else {
	$current_issue = '';
}

// ISSUE STYLES
if ( get_option('th_current_issue', false) ) {
	include 'custom-issue-styles.php';
}




/* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	Scripts & Stylesheets
----------------------------------------------- */

// SCRIPTS
function register_scripts() {

	$script_filepath = get_template_directory_uri().'/assets/js';

	if( !is_admin()){
		wp_deregister_script('jquery');
		wp_register_script('jquery', $script_filepath.'/jquery-2.1.1.min.js', false, '2.1.1');
		wp_enqueue_script('jquery');
	}

	// responsive video embeds
	wp_register_script('fitvids_js', $script_filepath.'/jquery.fitvids.js', array('jquery'), '1.1', true );

	// main
	wp_register_script('main_js', $script_filepath.'/main.js', array( 'jquery', 'fitvids_js' ), rand(100,1000), true );

	// single
	wp_register_script('single_js', $script_filepath.'/single.js', array( 'jquery' ), '1.1', true );

	// all pages
	wp_enqueue_script('main_js');

	// if ( is_singular() ) {
	// 	wp_enqueue_script('single_js');
	// }

}
add_action('wp_enqueue_scripts','register_scripts');


// ANALYTICS ARE INCLUDED VIA _editable-header.php
// function add_googleanalytics() { 
// 	$tracking_code = "UA-49252093-1";
// 	echo "<script>";
// 	echo "//<![CDATA[";
// 	echo "\r\n";
// 	echo "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){";
// 	echo "(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),";
// 	echo "m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)";
// 	echo "})(window,document,'script','//www.google-analytics.com/analytics.js','ga');";
// 	echo "ga('create', '".$tracking_code."', 'auto');";
// 	echo "ga('send', 'pageview');";
// 	echo "\r\n";
// 	echo "//]]>";
// 	echo "</script>";
// }
// add_action('wp_footer', 'add_googleanalytics');


// STYLES
function enqueue_css() {

	$style_filepath = get_template_directory_uri().'/assets/';

	wp_register_style('issue_styles', $style_filepath.'css/colors.css', false, rand(100,1000), 'screen' );
	wp_enqueue_style('issue_styles');

}
add_action('wp_print_styles', 'enqueue_css');



/* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	Functions, Hooks, Filters, ETC
----------------------------------------------- */

// SITE TITLE
function filter_wp_title( $title ) {
	// display name instead of URL
	return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_filter( 'wp_title', 'filter_wp_title' );


// EXCERPT
// length, in words
function excerpt_length( $length ) { 
	// 50 words
	return 75; 
}
// "more" text
function excerpt_more( $more ) {
	return ' ...';
}
add_filter( 'excerpt_length', 'excerpt_length', 999 );
add_filter( 'excerpt_more', 'excerpt_more' );

// tidy it up
function tidy_excerpt( $excerpt ) {

	$delimeter = ". ";
	$delimeter_length = count( str_split( $delimeter ) );

	$num_sentences = 5;

	$position = stripos( $excerpt, $delimeter );

	if ( $position ) {

		for ( $i=0; $i < $num_sentences - 1; $i++ ) {

			$offset = $position + $delimeter_length;
			$position = stripos( $excerpt, $delimeter, $offset );

		}

		$tidied = substr( $excerpt, 0, $position + 1 );

		return $tidied;

	} else {
		// nothing
	}

}


// ENABLE CATEGORIES ON PAGES
function add_categories() {  
	// Add tag metabox to page
	register_taxonomy_for_object_type('post_tag', 'page'); 
	// Add category metabox to page
	register_taxonomy_for_object_type('category', 'page');  
}
 // Add to the admin_init hook of your theme functions.php file 
add_action( 'init', 'add_categories' );


// EXCLUDE CATEGORIES
// (by parent category)
function exclude_child_cats( $category_slug ) {

	$id = get_category_by_slug( $category_slug )->term_id;

	$exclude = get_categories( 'child_of=' . $id );

	$result = '' . $id;
	
	foreach ( $exclude as $ec ) {

		$result .= ', ' . $ec->cat_ID;

	}

	return $result . ' ';

}


// GET AUTHORS
function get_authors( $id ) {

	$authors = get_the_terms( $id , 'author' );

	if ( $authors && !is_wp_error( $authors ) ) : 

		$author_names = array();
		foreach ( $authors as $author ) {
			$author_names[] = $author->name;
		}

		// more than one author ...
		if ( count( $author_names ) > 1 ) :

			$last  = array_slice( $author_names, -1 );
			$first = join( ', ', array_slice( $author_names, 0, -1 ) );
			$both  = array_filter( array_merge( array( $first ), $last ), 'strlen');
			
			$author_list = join( ' and ' , $both );

		else :

			$author_list = $author_names[0];

		endif;

		return $author_list;

	endif;

}


// FOOTER LINK (footer)
// Limit number of nav menu items on menu
// http://wordpress.stackexchange.com/questions/109569/limit-top-level-menu-items-on-wp-nav-menu
function chop_footer_nav( $sorted_menu_items, $args ) {
	// check that menu exists
	if ( $args->theme_location != 'footer-menu' )
		return $sorted_menu_items;
	// reset
	$unset_top_level_menu_item_ids = array();
	$array_unset_value = 1;
	$count = 1;
	
	// get all menu items
	foreach ( $sorted_menu_items as $sorted_menu_item ) {
		// unset top level menu items if > 1
		if ( 0 == $sorted_menu_item->menu_item_parent ) {
			if ( $count > 1 ) {
				unset( $sorted_menu_items[$array_unset_value] );
				$unset_top_level_menu_item_ids[] = $sorted_menu_item->ID;
			}
			$count++;
		}
		// unset child menu items of unset top level menu items
		if ( in_array( $sorted_menu_item->menu_item_parent, $unset_top_level_menu_item_ids ) )
		unset( $sorted_menu_items[$array_unset_value] );

		$array_unset_value++;
	}
	// output the chopped menu
	return $sorted_menu_items;
}
// add_filter( 'wp_nav_menu_objects', 'chop_footer_nav', 10, 2 );



// ADD ANCHORS TO HEADER TAGS
// @fix
// doesn't work if header content is <b>, <strong> or <em> :(
// https://github.com/cferdinandi/add-ids-to-header-tags-plus/blob/master/add-ids-to-header-tags-plus-process.php
function add_anchors_to_headers( $content ) {
	
	if ( ! is_singular() ) {
		return $content;
	}

	$pattern = '#(?P<full_tag><(?P<tag_name>h\d)(?P<tag_extra>[^>]*)>(?P<tag_contents>[^<]*)</h\d>)#i';

	if ( preg_match_all( $pattern, $content, $matches, PREG_SET_ORDER ) ) {
	
		$find = array();
		$replace = array();
	
		foreach( $matches as $match ) {
	
			if ( strlen( $match['tag_extra'] ) && false !== stripos( $match['tag_extra'], 'id=' ) ) {
				continue;
			}
	
			$find[]    = $match['full_tag'];
			$id        = sanitize_title( $match['tag_contents'] );
			$id_attr   = sprintf( ' id="%s"', $id );
	
			$extra     = sprintf( '<a id="%s" class="section-anchor absolute full-width"></a>', $id );
			$replace[] = sprintf( '<%1$s%2$s>%3$s%4$s</%1$s>', $match['tag_name'], $match['tag_extra'], $match['tag_contents'], $extra );
	
		}
	
		$content = str_replace( $find, $replace, $content );
	
	}

	return $content;

}
add_filter( 'the_content', 'add_anchors_to_headers' );



/* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	Shortcodes
----------------------------------------------- */
/**
* [ttr_video]
* Example: [ttr_video image_id="260"]video URL[caption]caption[/caption][/ttr_video]
* wraps videos for better aspect ratio + adds captions
* @param {string} video_id. Vimeo ID
*/
function ttr_video( $attributes, $content = null ) {

	$bg_img = "";

	if ( isset($attributes['image_id']) ) :
		$bg_img = $attributes['image_id'];
		$bg_img_src = wp_get_attachment_image_url( $bg_img, array(65,65), true );
	endif;

	$output = '';

	$output = '<section class="video-window"><div class="video-background" style="background:url('.$bg_img_src.'); background-size:33%; background-position:center; background-attachment:fixed;"></div><div class="wrapper">'.do_shortcode( str_replace( '<br>', '',$content ) ).'</div></section>';

	return $output;

}
add_shortcode('ttr_video', 'ttr_video');


/**
* [caption]
* Example: [caption]PRINT ONLY[/caption]
* note special content
*/
function caption( $attributes, $content = null ) {

	$output = '<p class="caption">'.$content.'</p>';

	return $output;

}
add_shortcode('caption', 'caption');


/**
* [ttr_toc]
* Example: [ttr_toc custom="true"]content[/ttr_toc]
* allows custom TOC for each issue. uses [toc_qualifier]
*/
function ttr_toc( $attributes, $content = null ) {

	global $this_issue;

	$post_id = get_the_id();
	$output = "";

	$output = do_shortcode( wpautop( $content ) );

	$output = '<section id="table-of-contents"><div class="wrapper"><div class="section-title"><h1>Contents</h1></div><div class="clear text-columns column-4">'.$output.'</div></div></section>';

	return $output;

}
add_shortcode('ttr_toc', 'ttr_toc');


/**
* [toc_qualifier]
* Example: [toc_qualifier]PRINT ONLY[/toc_qualifier]
* note special content
*/
function toc_qualifier( $attributes, $content = null ) {

	$output = '<span class="qualifier">'.$content.'</span>';

	return $output;

}
add_shortcode('toc_qualifier', 'toc_qualifier');



/* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	Get rid of some WordPress BS 
----------------------------------------------- */

// DISABLE RSS
// disable RSS feed, point to homepage instead
function fb_disable_feed() {
	wp_die( __('No feed available, please visit our <a href="'. get_bloginfo('url') .'">homepage</a>.') );
}
add_action('do_feed', 'fb_disable_feed', 1);
add_action('do_feed_rdf', 'fb_disable_feed', 1);
add_action('do_feed_rss', 'fb_disable_feed', 1);
add_action('do_feed_rss2', 'fb_disable_feed', 1);
add_action('do_feed_atom', 'fb_disable_feed', 1);


// "DISABLE" WP GALLERY
// by removing the "Add Gallery" button. gallery shortcodes will still work
add_action( 'admin_footer-post-new.php', 'disable_media_gallery_wpse_76095' );
add_action( 'admin_footer-post.php', 'disable_media_gallery_wpse_76095' );
function disable_media_gallery_wpse_76095() {
	?>
	<script type="text/javascript">
		jQuery(document).ready( function($) {
			$(document.body).one( 'click', '.insert-media', function( event ) {
				$(".media-menu").find("a:contains('Gallery')").remove();
			});
		});
	</script>
	<?php
}

/**
 * Remove standard image sizes so that these sizes are not
 * created during the Media Upload process
 *
 * Tested with WP 3.2.1
 *
 * Hooked to intermediate_image_sizes_advanced filter
 * See wp_generate_attachment_metadata( $attachment_id, $file ) in wp-admin/includes/image.php
 *
 * @param $sizes, array of default and added image sizes
 * @return $sizes, modified array of image sizes
 * @author Ade Walker http://www.studiograsshopper.ch
 */
function sgr_filter_image_sizes( $sizes) {
		
	unset( $sizes['thumbnail']);
	unset( $sizes['medium']);
	unset( $sizes['large']);
	
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'sgr_filter_image_sizes');


/**
 * Add an HTML class to MediaElement.js container elements to aid styling.
 *
 * Extends the core _wpmejsSettings object to add a new feature via the
 * MediaElement.js plugin API.
 */
function example_mejs_add_container_class() {
	if ( ! wp_script_is( 'mediaelement', 'done' ) ) {
		return;
	}
	?>
	<script>
	(function() {
		var settings = window._wpmejsSettings || {};
		settings.features = settings.features || mejs.MepDefaults.features;
		settings.features.push( 'thclass' );
		MediaElementPlayer.prototype.buildthclass = function( player ) {
			player.container.addClass( 'th-mejs-container' );
		};
	})();
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'example_mejs_add_container_class' );


/**
 * Customize WP Audio output
 */
