<?php
/**
 * Displays "About" page per Settings in WP Admin
 *
 * @package WordPress
 * @subpackage TTR
 */
?>
<?php 
if ( get_option( 'ttr_info_page_id', false ) ) :
	
	$post = get_post( get_option('ttr_info_page_id') ); ?>

	<!-- Information -->
	<section id="information" class="black-bg">
		<div class="wrapper">

			<a id="about" class="anchor"></a>

			<div class="section-title">
				<div class="wrapper">
					<h1>
						<?php echo get_the_title($post->post_id); ?>
					</h1>
				</div>
			</div>

			<div class="section-content">
				<?php $content = apply_filters('the_content', $post->post_content); 
					echo $content; ?>
				<?php include(locate_template('module-mailchimp.php' )); ?>

			</div>

		</div>
	</section>

<?php endif; ?>