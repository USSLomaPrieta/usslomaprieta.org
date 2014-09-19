<?php if (wp_loaded() === true) { ?><?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/blueprint/screen.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/blueprint/print.css" type="text/css" media="print" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<!--[if lte IE 6]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/blueprint/ie.css" type="text/css" media="screen, projection" />
<script src="<?php bloginfo('template_url'); ?>/js/iepng.js" type="text/javascript"></script>
<![endif]-->
<!--[if lte IE 7]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie.css" type="text/css" media="screen, projection" />
<![endif]-->
<?php if(wpthemes_options('top_gallery_posts') != '' && is_home()) {
?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/jdgallery/jd.gallery.css" type="text/css" media="screen" charset="utf-8" />
<script src="<?php bloginfo('template_url'); ?>/jdgallery/mootools-1.2.1-core-yc.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_url'); ?>/jdgallery/mootools-1.2-more.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_url'); ?>/jdgallery/jd.gallery.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_url'); ?>/jdgallery/jd.gallery.transitions.js" type="text/javascript"></script>
<?php } ?>

<script src="<?php bloginfo('template_directory'); ?>/menu/mootools-1.2.1-core-yc.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/menu/MenuMatic.css" type="text/css" media="screen" charset="utf-8" />
<!--[if lt IE 7]>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/menu/MenuMatic-ie6.css" type="text/css" media="screen" charset="utf-8" />
<![endif]-->
<!-- Load the MenuMatic Class -->
<script src="<?php bloginfo('template_directory'); ?>/js/menu-hover.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/menu/MenuMatic_0.68.3.js" type="text/javascript" charset="utf-8"></script>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_head(); ?>
    </head><?php } ?>

<body>
<script type="text/javascript">
window.addEvent('domready', function() {			
		var myMenu = new MenuMatic();
});	
</script>
<div id="wrapper">
<div id="container-wrap">
	<div id="container" class="container">
		<div id="header" class="span-24">
		<?php 
        if(wpthemes_options('header_code') != '') {
        echo wpthemes_options("header_code")  . "\n"; 
        }
        ?>
        <div>
            <div class="logo">
				<?php if(wpthemes_options('logo') != '') {?>
                    <div class="blog-name">
                        <a href="<?php bloginfo('url'); ?>"><img src="<?php echo wpthemes_options('logo'); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>
                    </div>
                <?php
                } else { ?>
                  <?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
                  <<?php echo $heading_tag; ?> class="blog-name"><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></<?php echo $heading_tag; ?>>
                  <?php } ?>
            </div>
        </div>
        <div id="navigation" class="span-24">
		<?php if(function_exists('wp_nav_menu')) {
                    wp_nav_menu('theme_location=menu_2&menu_id=nav&container=&fallback_cb=menu_custom_2');
                } else {
                    if(wpthemes_options('show_dropdown') != '') {
                        menu_custom_2();
                    }
                }
                function menu_custom_2() { ?>
			<ul id="nav">
				<li <?php if(is_home()) { echo ' class="current-cat" '; } ?>><a href="<?php bloginfo('url'); ?>">Home</a></li>
				<?php custom_cat_menu('exclude_hor_cat'); ?>
				<?php custom_page_menu('exclude_hor_pages'); ?>
				<?php custom_link_menu('exclude_hor_links'); ?>
			</ul>
			<?php } ?>
        </div>
        <div class="span-24 header-tools">
        	<?php include(TEMPLATEPATH . '/searchform.php'); ?>
            <?php include(TEMPLATEPATH . '/tool-wrap.php'); ?>
            <div class="ad-wrap">
				<?php if(wpthemes_options('ad468_googleads') != '') {
                    echo wpthemes_options('ad468_googleads');
                } elseif ( wpthemes_options('ad468_location') != '') { ?>
                    <a href="<?php echo wpthemes_options('ad468_url'); ?>"><img src="<?php echo wpthemes_options('ad468_location'); ?>" /></a>
                <?php } ?>
            </div>
        </div>
        <div>
            <div id="rss"><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" alt="RSS" /></a></div>
            <div id="twitter"><a href="http://twitter.com/<?php echo wpthemes_options('twitter_account') ;?>"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" alt="twitter" /></a></div>
        </div>
</div>
<!-- end header -->
<div id="content-wrap" class="span-24">