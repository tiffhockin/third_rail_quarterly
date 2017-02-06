<?php
/**
 * Template Name: Issue 8 (Special Cover)
 *
 * Use as a template for special issue pages where custom cover, layout, etc. are desired. Make a copy and rename per the issue for which you're customizing. Only edit within specified window.
 *
 * @package WordPress
 * @subpackage TTR
 */
?>
<?php global $current_issue; global $this_issue; ?>

<?php  

$custom_cover = true;
// using `include` so we can pass variables between templates
include(locate_template('header.php' )); ?>

<!-- Below the Fold -->
<div id="content">

	<?php if ( have_posts() ) : ?>
	
	<section class="issue color-bg issue-8">

		<?php while ( have_posts() ) : the_post(); ?>

		<div class="section-title issue-announcer">
			<div class="wrapper">
				<h1>
					<?php str_replace(' ', '&nbsp;', the_title() ); ?>
					<?php if ( is_home() || is_front_page() ) echo '<span class="in-print">Now in Print</span>'; ?>
				</h1>
			</div>
		</div>

		<div class="section-content">

			<?php 

			$posters = array(
				["TTR8_01_Aaron-Anderson_Eric-Timothy-Carlson", "Aaron Anderson &amp; Eric Timothy Carlson", false],
				["TTR8_02_Lise-Haller-Baggessen", "Lise Haller Baggessen", false],
				["TTR8_03_Gina-Beavers", "Gina Beavers", false],
				["TTR8_04_Judith-Bernstein", "Judith Bernstein", false],
				["TTR8_05_AK-Burns", "A.K. Burns", false],
				["TTR8_06_Cameron-Keith-Gainer", "Cameron Keith Gainer", false],
				["TTR8_07_Sam-Gould", "Sam Gould", true],
				["TTR8_08_Albert-Herter_Hiro-Kone", "Albert Herter &amp; Hiro Kone", false],
				["TTR8_09_Jibade-Khalil-Huffman", "Jibade Khalil Huffman", false],
				["TTR8_10_Alfredo-Jaar_01", "Alfredo Jaar", true],
				["TTR8_10_Alfredo-Jaar_02", "Alfredo Jaar", true],
				["TTR8_11_Chris-Kasper", "Chris Kasper", true],
				["TTR8_12_Devin-Kenny", "Devin Kenny", false],
				["TTR8_13_Justin-Lieberman", "Justin Lieberman", false],
				["TTR8_14_Jordan-Nassar_Brendan-Fowler", "Jordan Nassar &amp; Brendan Fowler", true],
				["TTR8_15_Sara-Greenberger-Rafferty", "Sara Greenberger Rafferty", true],
				["TTR8_16_Peter-Rostovsky", "Peter Rostovsky", true],
				["TTR8_17_Bruce-Tapola", "Bruce Tapola", true],
				["TTR8_18_Jonathan-Thomas", "Jonathan Thomas", false],
				["TTR8_19_Voider", "Voider", false],
				["TTR8_20_Christine-Wang", "Christine Wang", true],
				["TTR8_21_C-Spencer-Yeh", "C. Spencer Yeh", false],
				["TTR8_22_Dante-Carlos", "Dante Carlos", false]
				);

			$posters_json = json_encode($posters);

			$poster_path = get_template_directory_uri().'/TTR8_posters/';

			$poster = $posters[ rand(0,count($posters)-1) ];
			$poster_img = $poster[0];
			$poster_author = $poster[1];

			?>

			<section class="media-window color-bg issue-8" style="background:url(<?php echo $poster_path.'brick.png'; ?>); background-position:center; background-attachment:fixed; background-size:48px;">

				<div class="wrapper">
					<div class="media-container">
						<a href="<?php echo $poster_path.'/_pdf/'.$poster_img.'.pdf'; ?>" target="_blank"><div><img src="<?php echo $poster_path.'/L/'.$poster_img.'.png'; ?>" target="_blank"></div></a>
					</div>
					<p class="caption">
						<br>
						<span><b><?php echo $poster_author; ?></b></span>
					</p>
				</div>

			</section>

			<div class="wrapper">
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p class="align-center extended">
					When you invent the ship, you also invent the shipwreck.
					<br>
					— Paul Virilio, Politics of the Very Worst
				</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
			</div>

			<div class="content-grid wrapper">
				<div class="clear">
					<div class="content-grid-container">

					<?php 

					$vert_count = 0;
					$horiz_count = 0;

					for ( $i = 0; $i < count($posters); $i++ ) { 

					$poster = $posters[$i];
					$poster_img = $poster[0];
					$poster_author = $poster[1];
					$horiz = $poster[2];

					?>
					
					<div class="column <?php if(!$horiz){echo 'vertical quarter';}else{echo 'quarter';} ?>">
						<a href="<?php echo $poster_path.'/_pdf/'.$poster_img.'.pdf'; ?>" target="_blank">
							<span class="caption"><b>
							<?php echo str_replace('&amp; ', '&amp;<br>', $poster_author); ?>
							</b></span>
							<div class="img-container"> 
								<img src="<?php echo $poster_path.'/M/'.$poster_img.'.png'; ?>">
							</div>
						</a>
					</div>

					<?php 

					if ( $i > 1 && ($i + 1) % 4 == 0 ) echo "<hr class='clear row'>";

					// force irregularly sized columns into rows
					// if ( $horiz ) { $horiz_count++; }
					// else { $vert_count++; }

					// quarter and third
					// if ( $vert_count == 4 
					// 	|| ($vert_count == 2 && $horiz_count == 1)
					// 	|| $horiz_count == 3
					// 	|| ($horiz_count == 2 && $vert_count == 1)
					// 	) { 
					// 	echo "<hr class='clear column-keeper'>";
					// 	$vert_count = 0;
					// 	$horiz_count = 0;
					// }

					// quarter and fifth
					// if ( $vert_count == 5 
					// 	|| ($horiz_count == 1 && $vert_count == 3)
					// 	|| ($horiz_count == 2 && $vert_count == 2)
					// 	|| ($horiz_count == 3 && $vert_count == 1)
					// 	|| $horiz_count == 4
					// 	) { 
					// 	echo "<hr class='clear row'>";
					// 	$vert_count = 0;
					// 	$horiz_count = 0;
					// }

					?>

					<?php } ?>
					</div>
				</div>
			</div>

		</div>
		<script type="text/javascript">
			<?php echo "var posters = ".$posters_json; ?>
		</script>

		<?php endwhile; ?>

		<?php if ( is_home() || is_front_page() ) :
			// ads & sponsors
			include(locate_template('module-sponsors.php' ));
		endif; ?>

	</section>

	<?php endif; ?>

	<?php

	// past issues
	include(locate_template('module-archive.php' ));

	if ( is_home() || is_front_page() ) {
		// distribution
		include(locate_template('module-distribution.php' ));
		// libraries & collections
		include(locate_template('module-collections.php' ));
		// about
		include(locate_template('module-information.php' ));
	}
	
	?>

</div>

<?php include(locate_template('footer.php' )); ?>