<?php
/**
 * Default Page
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

	<div class="wrapper">

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	<div class="section-title">
		<?php edit_post_link(); ?>
		<h1 class="article-title"><?php the_title(); ?></h1>
	</div>

	<div class="section-content">
		<?php the_content(); ?>
	</div>

	<?php endwhile; endif; ?>

	</div>

</div>

<?php include(locate_template('footer.php' )); ?>