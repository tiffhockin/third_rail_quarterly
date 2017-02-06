<?php
/**
 * Issue Colors
 *
 * Write custom colors for each issue to colors.css file within assets/css/. Set colors via Posts > Issues, or Pages > Issues within WP Admin
 * 
 * @package WordPress
 * @subpackage TTR
 */

function generate_issue_styles() {

// issues CSS
$issue_css = <<<EOTAAA

/* ------- %issue_slug% ------- */
.%issue_slug%.color-bg { background-color: %issue_color%; }
.%issue_slug%.white-bg a:link, .%issue_slug%.white-bg a:visited { color: %issue_color%; }

EOTAAA;

// get all issue info
$args = array(
	'hide_empty' => false,
	'orderby' => 'name',
	'order' => 'ASC'
	);

$issues = get_terms('issue', $args);

// define placeholder text to search for
$search = array(
	'%issue_color%',
	'%issue_slug%'
	);

$output = '';
// time stamp
$output .= "/* ------- updated " . date('Y-m-d H:i') . " ------- */" . PHP_EOL;

foreach ( $issues as $issue ) {

	$issue_id = $issue->term_taxonomy_id;
	$issue_slug = $issue->slug;
	$issue_meta = get_option("taxonomy_term_$issue_id");
	$issue_color = $issue_meta['issue_color'];

	$replace = array(
		$issue_color, 
		$issue_slug
	);

	// find -> replace to compile issue styles
	$output .= str_replace($search, $replace, $issue_css);

} 

// open doc write stream
$options = array('ftp' => array('overwrite' => true)); 
$stream = stream_context_create($options); 

// write to file
$file = dirname(__FILE__).'/assets/css/colors.css';
if ( file_put_contents( $file, $output ) ) {
	file_put_contents( $file, $output );
}

} // end generate_issue_styles()

add_action('create_issue', 'generate_issue_styles');
add_action('edit_issue', 'generate_issue_styles');
add_action('delete_issue', 'generate_issue_styles'); 

?>