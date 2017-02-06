<?php
/**
 * Index Page
 * 
 * Default, shows all recent posts.
 *
 * @package WordPress
 * @subpackage TTR
 */
?>

<?php 
$custom_cover = true;
$background_style = false;
include(locate_template('header.php' )); ?>

<section id="content" role="main" class="news-archive">

	<div class="wrapper">

		<section class="clear">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'entry' ); ?>

		<?php endwhile; endif; ?>

		</section>

	</div>

</section>

<?php include(locate_template('footer.php' )); ?>