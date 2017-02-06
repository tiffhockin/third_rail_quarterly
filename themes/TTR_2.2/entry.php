<article id="post-<?php the_ID(); ?>" <?php post_class('column third'); ?>>

	<?php //if ( !is_search() ) get_template_part( 'entry','archive-header' ); ?>

	<a href="<?php the_permalink(); ?>" rel="bookmark">

		<?php //if ( !is_search() ) get_template_part( 'entry','thumbnail' ); ?>

		<h2 class="large-text">
			<?php the_title(); ?>
		</h2>

	</a>

	<?php edit_post_link(); ?>

</article>