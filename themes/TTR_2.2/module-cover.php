<?php
/**
 * Cover / Above The Fold
 *
 * Used on the home page
 *
 * @package WordPress
 * @subpackage TTR
 */
?>

<!-- Announcement -->
<?php include(locate_template('module-announcement.php' )); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

	if ( has_post_thumbnail(get_the_ID()) ) :
		$background_url = get_the_post_thumbnail_url();
		$background_style = 'background:url(\''.$background_url.'\');background-size:cover;background-position:center;';
	endif; 

endwhile; endif; ?>

<!-- Cover -->
<section id="cover" class="color-bg <?php echo $current_issue; if($background_style){ echo ' bg-image'; } ?>" style="<?php if($background_style){ echo $background_style; } ?>">

	<div class="wrapper">
		
		<div class="inner-wrapper">
			<div class="relative">
				<div class="text-wrapper">
					<h1><?php echo strtoupper(str_replace(' ', '<br>', get_bloginfo('name'))); ?></h1>
				</div>
				<div class="mark-wrapper">
					<div class="mark">
						<img class="horizontal" src="<?php echo get_template_directory_uri(); ?>/assets/img/ttr-assets_mark_L.svg">
					</div>
				</div>
			</div>
		</div>

	</div>
</section>
<div id="cover-shim" class="color-bg <?php echo $current_issue; ?>"></div>