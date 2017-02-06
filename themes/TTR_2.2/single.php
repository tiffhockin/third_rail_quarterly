<?php
/**
 * Single Article Page (Post)
 *
 * @package WordPress
 * @subpackage TTR
 */
?>
<?php global $current_issue; global $this_issue; ?>

<?php 

$custom_cover = false;
$background_style = false;
// using `include` so we can pass variables between templates
include(locate_template('header.php' )); ?>

<!-- Below the Fold -->
<div id="content" class="white-bg">

	<!-- <div class="wrapper clear">
		<?php echo '<div class="mark column quarter"><img class="mark-interior" src="'.get_template_directory_uri().'/assets/img/ttr-assets_mark_interior.svg"></div>';?>
	</div> -->

	<div class="wrapper">

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	<div class="section-title">

		<?php edit_post_link(); ?>
	
		<h1 class="article-title"><?php the_title(); ?></h1>
	
		<p class="article-attribution">
			<?php if ( get_field('article_attribution') ) :
				echo get_field('article_attribution');
			endif; ?>
		</p>
	
	</div>

	<div class="section-content <?php echo get_field('article_typography'); ?>">
		
		<?php the_content(); ?>

		<?php if ( get_field('article_pdf') ) :
			echo '<a class="article-pdf" href="'.get_field('article_pdf').'">Download as PDF</a>'; 
		endif; ?>

	</div>

	<?php endwhile; endif; ?>
		
	</div>

</div>

<?php // past issues
include(locate_template('module-archive.php' )); ?>

<?php include(locate_template('footer.php' )); ?>