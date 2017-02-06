<?php
/**
 * Footer Nav
 * 
 * @package WordPress
 * @subpackage TTR
 */
?>
<?php

$bg_class = 'black-bg';
// if ( is_home() || is_front_page() ) :
// 	$bg_class = 'black-bg';
// else :
// 	$bg_class = 'black-bg';
// endif;

?>
<footer class="page-row">
	<div id="footer-container" class="<?php echo $bg_class; ?>">
		<div class="wrapper clear">

			<hr>

			<div id="footer-site-title" class="column quarter">
				<h1>
					<?php 
					if ( !is_home() && !is_front_page() ) {
						$pre_wrap = '<a href="'.get_site_url().'" class="home-link">';
						$post_wrap = '</a>';
					}
					else {
						$pre_wrap = '';
						$post_wrap = '';
					}
					echo $pre_wrap.strtoupper(str_replace(' ', '<br>', get_bloginfo('name'))).$post_wrap;
					?>
				</h1>
			</div>

			<div id="footer-contact" class="column quarter">
				1237 Fourth Street NE<br> 
				Minneapolis, MN 55413<br>
				<a href="mailto:info@thirdrailquarterly.org" target="_blank">info@thirdrailquarterly.org</a>
			</div>
			<div id="footer-misc" class="column quarter">
				<?php echo '&copy; '.date('Y').' '.get_bloginfo('name'); ?><br> 
				ISSN: 2331-7566
			</div>

			<div id="footer-links" class="column quarter">
				<?php

				$options = array(
					'theme_location' => 'footer-menu',
					'container'	=> false,
					'depth' => 1
					);
				wp_nav_menu( $options );

				?>
			</div>

		</div>
	</div>
</footer>