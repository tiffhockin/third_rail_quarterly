<?php
/**
 * Main Nav
 * 
 * @package WordPress
 * @subpackage TTR
 */
?>
<?php
if ($this_issue) {
	$header_bg_class = $this_issue;
	$header_issue = get_term_by('slug', $this_issue, 'issue');
} else {
	$header_bg_class = $current_issue;
	$header_issue = get_term_by('slug', $current_issue, 'issue');
}
?>
<div id="main-nav" class="<?php echo 'color-bg '.$header_bg_class; ?>">
	<div class="wrapper">
		<?php 

		if ( !is_home() && !is_front_page() ) :
			// display the title 
			echo '<div class="masthead"><h1><a href="'.get_home_url().'" class="home-link">'.strtoupper(get_bloginfo('name')).'</a>'; 

			// if it's a single article, display issue number
			if ( is_singular('post') ) echo '<span>'.$header_issue->name.'</span>';
			
			echo '</h1></div>';

		endif; ?>

		<?php if(!$background_style && !$custom_cover){ echo '<hr class="nav-rule top">'; } ?>
		
		<nav>
		<?php

		$options = array(
			'theme_location' => 'main-menu',
			'container'	=> false,
			'depth' => 1
			);

		wp_nav_menu( $options );

		?>
		</nav>
		<hr class="nav-rule bottom">
	</div>
</div>