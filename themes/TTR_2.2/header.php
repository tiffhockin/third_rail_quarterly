<?php
/**
 * Header
 *
 * Used on every page, of course.
 *
 * @package WordPress
 * @subpackage TTR
 */
?>
<!DOCTYPE html> 
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php 
	// global variables
	global $current_issue; global $this_issue; ?>

	<?php 
	// issue information
	include(locate_template('header-meta.php' )); ?>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<title><?php echo wp_title( '—', false, 'right' ); ?></title>
	<!-- <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon.png"> -->

	<meta name="description" content="<?php bloginfo('description'); ?>"/>

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

	<!-- open graph -->
	<meta property="og:url" content="<?php echo get_permalink(); ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php the_title(); ?>" />
	<meta property="og:description" content="<?php echo get_the_excerpt(); ?>" />	
	<?php if ( has_post_thumbnail($post->ID) ) :
		$post_thumb_id = get_post_thumbnail_id($post->ID);
		$post_thumb_url =  wp_get_attachment_image_src($post_thumb_id, 1200, 650, false);
		$og_img = $post_thumb_url[0];
	else :
		$og_img = "http://thirdrailquarterly.org/wp-content/themes/TTR/assets/images/ttr-og-image.jpg";
	endif; ?>
	<meta name="og:image" content="<?php echo $og_img; ?>"/>

	<!-- fonts -->
	<style type="text/css">
		@import url("http://fast.fonts.net/t/1.css?apiType=css&projectid=7590d78d-e400-4958-8f5d-342d5c6bde98");
		@font-face{
			font-family:"UniversLTW01-53Extended";
			src:url("<?php echo get_template_directory_uri(); ?>/assets/fonts/e90b5a92-17e5-4875-a46d-4bf20adb66e8.eot?#iefix");
			src:url("<?php echo get_template_directory_uri(); ?>/assets/fonts/e90b5a92-17e5-4875-a46d-4bf20adb66e8.eot?#iefix") format("eot"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/e28c9873-2f96-4c27-8864-a7e26b898512.woff2") format("woff2"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/d2810795-22a0-44b6-b13c-7312ea475d48.woff") format("woff"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/c2eb9b46-a921-46b3-9c2b-113037bf7350.ttf") format("truetype"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/7a32f151-8355-48d4-b5d1-be3c2ffbd6ed.svg#7a32f151-8355-48d4-b5d1-be3c2ffbd6ed") format("svg");
		}
		@font-face{
			font-family:"Univers W01_63 Bold Ex";
			src:url("<?php echo get_template_directory_uri(); ?>/assets/fonts/c031d364-61db-4b59-99f5-09eeb240a700.eot?#iefix");
			src:url("<?php echo get_template_directory_uri(); ?>/assets/fonts/c031d364-61db-4b59-99f5-09eeb240a700.eot?#iefix") format("eot"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/d860af8f-6ac0-46d8-b821-bd4de3c18f65.woff2") format("woff2"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/117029bb-8ac2-4137-94e9-3cfd354bedc7.woff") format("woff"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/866c5e2b-437a-4b02-86b5-978886920ad3.ttf") format("truetype"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/622149ee-ce25-451e-bdd8-ac0beec13460.svg#622149ee-ce25-451e-bdd8-ac0beec13460") format("svg");
		}
		@font-face{
			font-family:"Univers LT W01_55 Roman";
			src:url("<?php echo get_template_directory_uri(); ?>/assets/fonts/b5c30ea8-0700-4fd2-aa12-cc45074693a9.eot?#iefix");
			src:url("<?php echo get_template_directory_uri(); ?>/assets/fonts/b5c30ea8-0700-4fd2-aa12-cc45074693a9.eot?#iefix") format("eot"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/091fe5d9-1aaa-4f3c-9b94-c83bb7c362ab.woff2") format("woff2"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/7b95cb9a-a288-4405-97a0-13095f56a903.woff") format("woff"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/c7481806-4ea4-40db-a623-7bc352bbbe43.ttf") format("truetype"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/ac8280da-3de5-456d-bd77-8f01665452a9.svg#ac8280da-3de5-456d-bd77-8f01665452a9") format("svg");
		}
		@font-face{
			font-family:"UniversLTW01-55Oblique";
			src:url("<?php echo get_template_directory_uri(); ?>/assets/fonts/783e01cd-5eb8-41d7-a380-a18673f2983b.eot?#iefix");
			src:url("<?php echo get_template_directory_uri(); ?>/assets/fonts/783e01cd-5eb8-41d7-a380-a18673f2983b.eot?#iefix") format("eot"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/456b1708-d5cd-4511-8e27-164cd85eee93.woff2") format("woff2"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/90c17e08-290d-4eba-ab33-77c81c1f559d.woff") format("woff"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/d93b9eab-632d-4aaf-b7fa-5c17060d62fc.ttf") format("truetype"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/caa7a31a-310f-4020-8311-89816a31472f.svg#caa7a31a-310f-4020-8311-89816a31472f") format("svg");
		}
		@font-face{
			font-family:"Univers LT W01_65 Bold";
			src:url("<?php echo get_template_directory_uri(); ?>/assets/fonts/db1c462f-8890-4a11-9de5-36872279e20a.eot?#iefix");
			src:url("<?php echo get_template_directory_uri(); ?>/assets/fonts/db1c462f-8890-4a11-9de5-36872279e20a.eot?#iefix") format("eot"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/a88f6520-d0c2-4877-b792-cb77cca8e307.woff2") format("woff2"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/b993da84-c1f6-474a-8f00-8aa797b3de8f.woff") format("woff"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/58403ef6-4c15-4280-b4b6-9acf50804f4f.ttf") format("truetype"),url("<?php echo get_template_directory_uri(); ?>/assets/fonts/9178e351-95c5-4913-9eeb-fd0645a18c2d.svg#9178e351-95c5-4913-9eeb-fd0645a18c2d") format("svg");
		}
	</style>

	<!-- style -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>?ver=081616" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/reset.css?ver=081616" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/main.css?ver=082916" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/audio.css?ver=081616" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_editable-style/custom.css?ver=081616" />

	<?php wp_head(); ?>

	<!-- tracking codes, etc. -->
	<?php include(locate_template('_editable-header.php' )); ?>

</head>
<?php 

// set bg color based on page type
$class = "";

if (!is_home() && !is_front_page()) :
	$class = 'not-home'; 
endif; 
if ($custom_cover) :
	$class .= ' custom-cover'; 
endif; 

?>

<body <?php body_class($class); ?> data-directory="<?php echo get_template_directory_uri(); ?>" data-mobile="<?php if(wp_is_mobile()){echo'true';}else{echo'false';} ?>">

<header class="page-row">
<?php 

// above-the-fold content
if ( is_home() || is_front_page() ) {
	if ( $custom_cover ) {
		// special cover with small mark & logotype
		include(locate_template('module-cover-special.php'));
	} else {
		// default cover with large mark & logotype
		include(locate_template('module-cover.php'));
	}
}
// using include so we can pass variables between templates
include(locate_template('nav-header.php' )); ?>

</header>

<main class="ttr-content page-row page-row-expanded <?php echo $this_issue; ?>">

<div id="content-container" class="<?php if($this_issue){echo 'color-bg '.$this_issue;}elseif(is_page() && !is_home()){echo'black-bg';} ?>">