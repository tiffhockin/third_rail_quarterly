<?php
/**
 * Issue Advertisements
 *
 * @package WordPress
 * @subpackage TTR
 */

?>

<?php

// $current_issue must be passed to the template
// ads are only displayed for the current issue
$args = array( 'post_type' => 'ttr_adverts' );

$query = new WP_Query( $args );

if ( $query->have_posts() ) : 

?>
<!-- Advertisers -->
<section id="issue-sponsors">
	<div class="wrapper">
		<div class="masonry clear">

		<?php 

		while ( $query->have_posts() ) : $query->the_post();
			
			$pre_wrap = '';
			$post_wrap = '';
			
			// link to the advertiser's website
			if ( get_field('ad_link') ) {
				// build ad link
				$pre_wrap = '<a class="org-link relative" href="'.get_field('ad_link').'" target="_blank">';
				$post_wrap = '</a>';
			}

			echo '<div class="org column fifth"><div>';

			// edit_post_link();
			// <a href="...">
			echo $pre_wrap;

			// only display an ad if images exist
			if ( have_rows('ad_images') ) {

				$counter = 0;
				$number_of_imgs = count( get_field( 'ad_images' ) );

				while ( have_rows('ad_images') ) {

					the_row();
					$image = get_sub_field('ad_images_image');

					if ( $image !== null ) {
						// if more than one image exist
						if ( $number_of_imgs > 1 ) {
							// the first image is the 'static' image
							if ( $counter === 0 ) {
								$img_class = 'org-static';
							}
							// second image is animated or 'active' image
							if ( $counter === 1 ) {
								$img_class = 'org-active';
							}

						} else {
						// if there's only one image, treat it as static
							$img_class = 'org-static no-active';
						}
						
						$img_src = wp_get_attachment_image_src( $image, 'full' );
						echo '<img src="'.$img_src[0].'" class="'.$img_class.'">';

					}

					$counter++;

				}

			} else {
			// there are no images
				// display the advertiser's name
				echo '<p class="org-title absolute">';
					the_title();
				echo '</p>';
				// insert a filler image
				echo '<img class="org-static no-active no-image" src="'.get_template_directory_uri().'/assets/img/filler.png">';
			}

			// close the link
			echo $post_wrap;
			// close the container
			echo '</div></div>';

		endwhile; 

		?>
		</div>
	</div>
</section>

<?php endif; wp_reset_query(); ?>