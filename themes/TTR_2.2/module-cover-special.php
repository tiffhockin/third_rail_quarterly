<?php
/**
 * Cover (special) / Above The Fold
 *
 * Used on the home page for special occasions. Called by `page-issue-special-template.php` or derivations thereof. NOTE: There should be no need to edit this template. 
 *
 * @package WordPress
 * @subpackage TTR
 */
?>

<?php 
// custom cover possibilities
// - "image"
// - no featured image
// - featured image

$feat_image = false;
// check for featured image
if ( have_posts() ) : while ( have_posts() ) : the_post();
	if ( has_post_thumbnail(get_the_ID()) ) :
		$feat_image = get_the_post_thumbnail_url();
	endif; 
endwhile; endif; ?>

<!-- Announcement -->
<?php include(locate_template('module-announcement.php' )); ?>

<!-- Cover -->
<section id="cover" class="special color-bg <?php echo $current_issue; ?>">

	<?php 
	// feature image + custom cover template means we display that image as full-bleed background
	if ( $custom_cover !== 'image' && $feat_image ) : ?>
		<div class="wrapper" style="background:url('<?php echo $feat_image; ?>'); background-size:cover; background-position:center;">

	<?php 
	// non-cropping image template OR
	// custom cover template, which means code will look for custom HTML page
	else : ?>

	<div class="wrapper">

		<?php 
		// non-cropping image template
		if ( $custom_cover === 'image' ) :
			if ( $feat_image ) : ?>
				<div class="non-cropping">
					<img src="<?php echo $feat_image; ?>">
				</div>
			<?php endif; ?>
		
		<?php 
		// custom cover template, which means code will look for custom HTML page
		else : ?>
			<?php 

			// code assumes file is named: "cover-issue-#.html". i.e., cover-issue-9.html
			$cover_file = 'cover-'.$this_issue.'.html';
			$file_path = dirname(__FILE__) . '/_editable-covers/';

			// only load the custom cover file if it actually exists
			if ( file_exists($file_path.$cover_file) ) : ?>

				<iframe id="special-cover" style="width:100%;height:100%;" src="<?php echo get_template_directory_uri().'/_editable-covers/'.$cover_file ; ?>"></iframe>
			
			<?php endif; ?>

		<?php endif; ?>

	<?php endif; ?>

		<div class="mark">
			<img class="horizontal" src="<?php echo get_template_directory_uri(); ?>/assets/img/ttr-assets_mark_S_shadowed.svg">
		</div>

		<div class="text-wrapper">
			<h1><?php echo strtoupper(str_replace(' ', '<br>', get_bloginfo('name'))); ?></h1>
		</div>

	</div>
</section>
<div id="cover-shim" class="color-bg <?php echo $current_issue; ?>"></div>