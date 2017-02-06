<?php
/**
 * Distribution
 *
 * @package WordPress
 * @subpackage TTR
 */
?>
<?php if ( get_option('ttr_collections') ) : ?>

<!-- Distribution -->
<section id="distribution" class="white-bg">
	<a id="distribution-anchor" class="anchor"></a>
	<div class="wrapper">

		<div class="section-title"><h1>Distribution</h1></div>

		<?php if ( get_option('ttr_distribution_description') && get_option('ttr_distribution_display') ) :
				echo '<div class="article-content">'.wpautop( get_option('ttr_distribution_description') ).'</div>';
		endif; ?>

		<div class="small-text text-columns column-4">
			<?php echo wpautop( get_option('ttr_distribution') ); ?>
		</div>
	</div>
</section>

<?php endif; ?>