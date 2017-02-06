<?php
/**
 * Libraries & Collections
 *
 * @package WordPress
 * @subpackage TTR
 */
?>
<?php if ( get_option('ttr_collections') ) : ?>

<!-- Collections -->
<div class="white-bg section-divider clear"><div class="wrapper"><hr/></div></div>
<section id="collections" class="white-bg">
	<a id="collections-anchor" class="anchor"></a>
	<div class="wrapper clear">

		<div class="section-title"><h1>Libraries</h1></div>

		<?php if ( get_option('ttr_collections_description') && get_option('ttr_collections_display') ) :
				echo '<div class="section-content">'.wpautop( get_option('ttr_collections_description') ).'</div>';
		endif; ?>
		
		<div class="small-text clear text-columns column-5">
			<?php echo wpautop( get_option('ttr_collections') ); ?>
		</div>
	</div>
</section>

<?php endif; ?>