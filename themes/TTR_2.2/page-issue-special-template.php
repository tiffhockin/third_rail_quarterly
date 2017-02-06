<?php
/**
 * Template Name: Issue Page (Special Cover)
 *
 * Use as a template for special issue pages where custom cover, layout, etc. are desired. Make a copy and rename per the issue for which you're customizing. Only edit within specified window.
 *
 * @package WordPress
 * @subpackage TTR
 */
?>
<?php global $current_issue; global $this_issue; ?>

<?php  
/* ----- 
	
	PLEASE NOTE ...

	Code assumes you wish to use a custom cover and makes the following assumptions:
	
		- Custom cover file will be titled: `cover-issue-#.html`.
		- Custom cover file (and all its related assets) will be saved within the `_editable-covers` folder.

	Create and save your cover file accordingly. Your custom cover will inserted via iFrame.

	ALTERNATELY ...  

	if you are not making a custom cover, set $custom_cover to `false`.

----- */
$custom_cover = true;
$background_style = false;
// using `include` so we can pass variables between templates
include(locate_template('header.php' )); ?>

<!-- Below the Fold -->
<div id="content">

	<?php if ( have_posts() ) : ?>
	
	<section class="issue color-bg <?php echo $this_issue; ?>">

		<?php while ( have_posts() ) : the_post(); ?>

		<div class="section-title issue-announcer">
			<div class="wrapper">
				<h1>
					<?php str_replace(' ', '&nbsp;', the_title() ); ?>
					<?php if ( is_home() || is_front_page() ) echo '<span class="in-print">Now in Print</span>'; ?>
				</h1>
			</div>
		</div>

		<div class="section-content">
		<!-- ********** BEGIN EDITING ********** -->

			<?php 
			// `the_content()` will display any content inserted via the text editor in WP Admin
			// see: https://developer.wordpress.org/reference/functions/the_content/
			the_content(); ?>

		<!-- ********** STOP EDITING ********** -->
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