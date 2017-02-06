<?php
/**
 * Template Name: Issue Page
 *
 * Should be used for all Issue pages for The Third Rail.
 *
 * @package WordPress
 * @subpackage TTR
 */
?>

<?php global $current_issue; global $this_issue; ?>

<?php  // using `include` so we can pass variables between templates
$custom_cover = false;
$background_style = false;
include(locate_template('header.php' )); ?>

<!-- Below the Fold -->
<div id="content">

	<?php if ( have_posts() ) : ?>
	
	<section class="issue color-bg <?php echo $this_issue; ?>">

		<?php while ( have_posts() ) : the_post(); ?>

		<div class="section-title issue-announcer">
			<div class="wrapper clear">
				<?php 
				// print the _|_|_|_ mark on interior pages
				if ( !is_home() && !is_front_page() ) echo '<div class="mark column quarter"><img class="mark-interior" src="'.get_template_directory_uri().'/assets/img/ttr-assets_mark_interior.svg"></div>'; ?>
				<div class="column half">
					<h1>
						<?php str_replace(' ', '&nbsp;', the_title() ); ?>
						<?php if ( is_home() || is_front_page() ) echo '<span class="in-print">Now in Print</span>'; ?>
					</h1>
				</div>
				<?php 
				// print the _|_|_|_ numbering system on interior pages
				if ( !is_home() && !is_front_page() ) echo '<div class="issue-count column quarter"><img class="issue-count" src="'.get_template_directory_uri().'/assets/img/ttr-assets_'.$this_issue.'.svg"></div>'; ?>
			</div>
		</div>

		<div class="section-content">
			<?php the_content(); ?>
		</div>

		<?php endwhile; ?>

		<?php if ( is_home() || is_front_page() ) :
			// ads & sponsors
			include(locate_template('module-sponsors.php' ));
		endif; ?>

	</section>

	<?php endif; ?>

	<?php

	// past issues
	include(locate_template('module-archive.php' ));

	if ( is_home() || is_front_page() ) {
		// distribution
		include(locate_template('module-distribution.php' ));
		// libraries & collections
		include(locate_template('module-collections.php' ));
		// about
		include(locate_template('module-information.php' ));
	}
	
	?>

</div>

<?php include(locate_template('footer.php' )); ?>