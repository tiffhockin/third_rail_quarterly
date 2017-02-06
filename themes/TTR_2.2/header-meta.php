<?php
/**
 * Issue Info
 *
 * Used inside the header to display information about the current issue + additional meta details.
 * 
 * @package WordPress
 * @subpackage TTR
 */
?>
<?php 

// LOGIC
// if is home ...
// 	issue = issue currently in print
// else
// 	if !home && !front page
//			issue = issue associated with current page

// current issue (in circulation right now)
global $current_issue;
// the issue we're looking at on the site
global $this_issue;
// is it an archive page? works with this_issue
global $archive;

$archive = false;
$this_issue = '';

echo '<!--' . PHP_EOL . "\tglobal current issue : " . $current_issue . PHP_EOL;

// tagged with an issue?
if ( has_term( '', 'issue', $post->ID ) ) :

	$this_issue = wp_get_post_terms( $post->ID, 'issue' )[0]->slug;
	echo "\tthis issue : " . $this_issue . PHP_EOL;

	// does it match global "current" issue?
	if ( $this_issue !== $current_issue ) :

		$archive = 'archive';
		echo "\t" . $archive . PHP_EOL;

	endif;

endif;

echo "\tthis issue : " . $this_issue . PHP_EOL;

echo "\t-->" . PHP_EOL

?>