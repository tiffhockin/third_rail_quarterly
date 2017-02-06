<?php
/**
 * Template Name: Issue Page (Uncropped Image)
 *
 * Display an un-cropped feature image
 *
 * @package WordPress
 * @subpackage TTR
 */
?>
<?php global $current_issue; global $this_issue; ?>

<?php  

$custom_cover = 'image';
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