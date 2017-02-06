<?php

/**
 * @package TTR Includes
 * @version 2.0
 */

/*

Plugin Name: TTR Includes
Description: Custom taxonomies, settings and functionality for The Third Rail
Author: TH
Version: 2.0

*/


/* Issue Taxonomy
-------------------------------------------------------------- */
include_once 'taxonomy_issue.php';
include_once 'taxonomy_issue_extras.php';

/* Author Taxonomy
-------------------------------------------------------------- */
include_once 'taxonomy_authors.php';
// include_once 'taxonomy_authors-extras.php';

/* Ad Post Type
-------------------------------------------------------------- */
include_once 'posttype_adverts.php';

/* Inline Footnotes
-------------------------------------------------------------- */
include_once 'plugin_inline-footnotes.php';

/* Settings
-------------------------------------------------------------- */
include_once 'admin_settings.php';


// colorize favicon based on current issue color
// would require translation of hex -> r,g,b
// not in use; black favicon looks better
function colorize_favicon( $r, $g, $b ) {

	$file_path = plugin_dir_url( __FILE__ ) . 'images/';

	$img_template = imagecreatefrompng( $file_path . 'favicon.png');
	imagealphablending( $img_template , false );

	imagesavealpha( $img_template , true );

	if ( $img_template && imagefilter( $img_template, IMG_FILTER_COLORIZE, $r, $g, $b ) ) {

		imagepng( $img_template, dirname( __FILE__ ) . '/images/favicon_issue-01.png' );

	} else {

		// fail. do nothing

	}

	imagedestroy( $img_template );

}

?>