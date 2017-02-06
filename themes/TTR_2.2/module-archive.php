<?php
/**
 * Past Issue Links
 *
 * Displayed on all issue pages
 *
 * @package WordPress
 * @subpackage TTR
 */
?>
<?php
echo '<!-- Past Issues -->';
echo '<section id="past-issues">';

$taxonomy = 'issue';
$args = array(
	'hide_empty'=> true,
	'orderby'=> 'name',
	'order' => 'DESC'
	);

$past_issues = false;
$past_issues = get_terms($taxonomy,$args);

if ( $past_issues ) {

	foreach ( $past_issues as $past_issue ) {
		// print the issue link for all past issues
		if ( $past_issue->slug !== $this_issue ) {
			// get associated page
			$page_args = array( 
				'post_type' => 'page',
				'tax_query' => array(
						array(
							'taxonomy' => 'issue',
							'field' => 'slug',
							'terms' => $past_issue->slug
						)),
				'showposts' => 1,
				);

			$query = new WP_Query( $page_args );

			if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

				// build the link
				echo '<a href="'.get_the_permalink().'" class="issue-link color-bg '.str_replace(' ','&nbsp;',$past_issue->slug).'" ><div class="wrapper clear"><div class="column half"><h1>'.get_the_title().'</h1></div><div class="column half issue-numbering"><img class="issue-count" src="'.get_template_directory_uri().'/assets/img/ttr-assets_'.$past_issue->slug.'.svg"></div></div></a>';

			endwhile; endif; wp_reset_query();

		}

	}
	
}

echo '</section>';

?>