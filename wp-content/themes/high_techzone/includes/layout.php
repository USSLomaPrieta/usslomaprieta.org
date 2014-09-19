<?php 
function wpthemes_do_page() {
    global $this_wptheme_name, $theme_options_prefix, $custom_options, $prompt_txt;
	if ( $_REQUEST['saved'] ) {
		echo '<div style="font-size:14px; font-weight:bold; color:#FF0000; padding-top:20px; padding-left: 20px;">'.$this_wptheme_name.' settings saved.</div>';
	} elseif ( $_REQUEST['reset'] ) {
		$prompt_act = 'reset';
		echo '<div style="font-size:14px; font-weight:bold; color:#FF0000; padding-top:20px; padding-left: 20px;">'.$this_wptheme_name.' settings reset.</div>';
	}
	
?>
<link href="<?php echo get_template_directory_uri(); ?>/includes/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 6]>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" type="text/css" media="screen, projection" />
<script src="<?php echo get_template_directory_uri(); ?>/js/iepng.js" type="text/javascript"></script>
<script type="text/javascript">DD_belatedPNG.fix('#admin_main_wrap a, #admin_main_wrap, #admin_main_bottom');</script>
<![endif]-->
<?php wp_register_script( 'jquery-lib', get_template_directory_uri() . '/includes/js/jquery-1.6.1.js', array( 'jquery-lib' ) ); ?>
<script type="text/javascript">
	var jQ$ = jQuery.noConflict();
	jQ$(document).ready(function(){
	
	jQ$("input[class=reset_button]").click(function(){
		var input_grandparent = jQ$(this).parent().parent().find("input[type=text]");
		input_grandparent.attr('value','');
		/*jQ$(this).(".option textarea").text("");*/
	});
	jQ$("input[id=select_all]").click(function(){
		var checkbox_grandparent = jQ$(this).parent().parent().parent().find("ul input[class=check_box]");
			checkbox_grandparent.attr('checked','checked');
		
	});
	jQ$("input[id=invert_selection]").click(function(){
		var invert_grandparent = jQ$(this).parent().parent().parent().find("ul input[class=check_box]");
		invert_grandparent.each(function(){
				if(this.checked){ 
					this.checked=false;
				} else {
					this.checked=true;
				}});
	});
	/*jQ$("input[class=controls_check]").click(function(){
		var check_grandparent = jQ$(this).parent().parent().prev().find("select");
		check_grandparent.each(function(){
				if(this.disabled){ 
					this.disabled=false;
				} else {
					this.disabled=true;
				}});
	});*/
	
	var swi_n = 0;
		
	jQ$('#expand_options').click(function(){
		if(swi_n == 0){
			swi_n = 1;
			jQ$( '#admin_main_wrap #admin_nav').hide();
			jQ$(this).text( '[-]' );
			
		} else {
			swi_n = 0;
			jQ$( '#admin_main_wrap #admin_nav').show();
			jQ$( '#admin_main_wrap .group:first').show();
			jQ$( '#admin_main_wrap #admin_nav li').removeClass( 'current');
			jQ$( '#admin_main_wrap #admin_nav li:first').addClass( 'current');
			
			jQ$(this).text( '[+]' );
		}
	
	});
		function unhideHidden(){
			if (jQ$(this).attr( 'checked')) {
				jQ$(this).parent().parent().parent().nextAll().removeClass( 'hidden');
			}
			else {
				jQ$(this).parent().parent().parent().nextAll().each( 
					function(){
						if (jQ$(this).filter( '.last').length) {
							jQ$(this).addClass( 'hidden' );
							return false;
						}
						jQ$(this).addClass( 'hidden' );
					});
					
			}
		}
		jQ$('#admin_nav li:first').addClass('current');
		jQ$('#admin_nav li a').click(function(evt){
		
				jQ$('#admin_nav li').removeClass('current');
				jQ$(this).parent().addClass('current');
				
				var clicked_group = jQ$(this).attr('href');
 
				jQ$('.group').hide();
				
					jQ$(clicked_group).fadeIn();

				evt.preventDefault();
				
			});
		
			
	});
</script>
<div id="admin_container">
    <div id="admin_main_wrap">
        <div id="admin_main_top">
          <div id="admin_left">
              <div class="logo"><a href="http://www.wpthemepremium.com/"><img alt="WpThemePremium Panel" src="<?php echo get_template_directory_uri(); ?>/includes/images/logo.png"/></a></div>
              <div id="admin_nav">
                <ul>
                  <li><a href="#c1"><img src="<?php echo get_template_directory_uri(); ?>/includes/images/admin-icon-general.png"/>General Settings</a></li>
                  <li><a href="#c2"><img src="<?php echo get_template_directory_uri(); ?>/includes/images/admin-icon-featured.png"/>Featured Slider Settings</a></li>
                  <li><a href="#c3"><img src="<?php echo get_template_directory_uri(); ?>/includes/images/admin-icon-seo.png"/>SEO Options</a></li>
                  <li><a href="#c4"><img src="<?php echo get_template_directory_uri(); ?>/includes/images/admin-icon-navigation.png"/>Navigation Bar Settings</a></li>
                  <li><a href="#c5"><img src="<?php echo get_template_directory_uri(); ?>/includes/images/admin-icon-banner.png"/>Advertisement</a></li>
                  <li><a href="#c6"><img src="<?php echo get_template_directory_uri(); ?>/includes/images/admin-icon-miscellaneous.png"/>Miscellaneous</a></li>
                </ul>
            </div>
          </div>
          <div id="admin_right">
<form method="post">
<?php foreach ($custom_options as $option_value) { ?>
<?php if ($option_value['type'] == "group_head") { ?>
			<div id="<?php echo $option_value['id']; ?>" class="group" <?php if (($option_value['id']) != "c1") { echo 'style="display: none;"';} ?>>
<?php } elseif ($option_value['type'] == "group_foot") { ?>
				<div class="global_upload_button">
					<input class="default_button" type="submit" value="Default" name="option_reset" onclick="return confirm( 'Click OK to reset all options. All settings will be lost!' );" />
					<input class="save_button" type="submit" name="option_update"  value="Save" /><input type="hidden" name="action" value="option_update" />
		  </div>
            </div>
<?php } elseif ($option_value['type'] == "section_head") { ?>
			<div class="section">
                <h3 class="title"><?php echo $option_value['title']; ?></h3>
                <div class="option clearfix">
<?php } elseif ($option_value['type'] == "section_foot") { ?>
                </div>
                <div class="clear"></div>
            </div>
<?php } elseif ($option_value['type'] == "section_checkbox_head") { ?>
			<div class="section_checkbox">
                <h3 class="title"><?php echo $option_value['title']; ?></h3>
                <div class="option">
<?php } elseif ($option_value['type'] == "section_checkbox_foot") { ?>
                </div>
                <div class="clear"></div>
            </div>
<?php } elseif ($option_value['type'] == "select1") { ?>
                    <div class="controls">
						<select id="<?php echo $option_value['id']; ?>" name="<?php echo $option_value['id']; ?>">
							<?php $num = 1;
							while($num <= $option_value['num_sum']) { ?>
							<option value="<?php echo $num; ?>" <?php if ((wpthemes_settings($option_value['id'])) == $num) { echo 'selected="selected"';} ?>><?php echo $num; ?></option>
							<?php $num++; } ?>
						</select>
					</div>
                    <div class="explain"><?php echo $option_value['desc']; ?></div>
<?php } elseif ($option_value['type'] == "select2") { ?>
                    <div class="controls">
						<select id="<?php echo $option_value['id']; ?>" name="<?php echo $option_value['id']; ?>">
							<?php $num = 1;
							while($num <= $option_value['num_sum']) { ?>
							<option value="<?php echo $num; ?>" <?php if ((wpthemes_settings($option_value['id'])) == $num) { echo 'selected="selected"';} ?>><?php echo $num; ?></option>
							<?php $num++; } ?>
						</select>
					</div>
<?php } elseif ($option_value['type'] == "select3") { ?>
                    <div class="controls">
                        <select name="<?php echo $option_value['id']; ?>" id="<?php echo $option_value['id']; ?>">
							<?php foreach ($option_value['options'] as $option) { ?>
							<option value="<?php echo $option['value']; ?>" <?php if (wpthemes_settings($option_value['id']) == $option['value']) { echo ' selected="selected"'; } ?>><?php echo $option['title']; ?></option>
							<?php } ?>
						</select>
					</div>
<?php } elseif ($option_value['type'] == "select4") { ?>
                    <div class="controls">
						<select name="<?php echo $option_value['id']; ?>" id="<?php echo $option_value['id']; ?>" class="select_str">
							<?php foreach ($option_value['options'] as $option) { ?>
							<option value="<?php echo $option['value']; ?>" <?php if (wpthemes_settings($option_value['id']) == $option['value']) { echo ' selected="selected"'; } ?>><?php echo $option['title']; ?></option>
							<?php } ?>
						</select>
<?php } elseif ($option_value['type'] == "select5") { ?>
						<select id="<?php echo $option_value['id']; ?>" name="<?php echo $option_value['id']; ?>" class="select_num">
							<?php $num = 1;
							while($num <= $option_value['num_sum']) { ?>
							<option value="<?php echo $num; ?>" <?php if ((wpthemes_settings($option_value['id'])) == $num) { echo 'selected="selected"';} ?>><?php echo $num; ?></option>
							<?php $num++; } ?>
						</select>
<?php } elseif ($option_value['type'] == "checkbox2") { ?>
					</div>
                    <div class="explain"><label title="Enable <?php echo $option_value['desc']; ?>?"><?php echo $option_value['desc']; ?><?php if(wpthemes_settings($option_value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
				<input class="controls_check" type="checkbox" name="<?php echo $option_value['id']; ?>" id="<?php echo $option_value['id']; ?>" value="true" <?php echo $checked; ?> /></label></div>
<?php } elseif ($option_value['type'] == "option_head") { ?>
				</div>
				<br />
                <h3 class="title"><?php echo $option_value['title']; ?></h3>
                <div class="option clearfix">
<?php } elseif ($option_value['type'] == "explain1") { ?>
					</div>
                    <div class="explain break_explain"><?php echo $option_value['desc']; ?></div>
<?php } elseif ($option_value['type'] == "input4") { ?>
					</div>
                    <div class="controls"><div class="inputbg"><input title="<?php echo wpthemes_settings( $option_value['id'] ); ?>" class="upload" name="<?php echo $option_value['id']; ?>" value="<?php echo wpthemes_settings( $option_value['id'] ); ?>" type="text" id="<?php echo $option_value['id']; ?>" /></div></div>
                <div class="explain line_explain"><?php echo $option_value['desc']; ?></div>
<?php } elseif ($option_value['type'] == "input1") { ?>
				<div class="controls"><div class="inputbg"><input title="<?php echo wpthemes_settings( $option_value['id'] ); ?>" class="upload" name="<?php echo $option_value['id']; ?>" value="<?php echo wpthemes_settings( $option_value['id'] ); ?>" type="text" id="<?php echo $option_value['id']; ?>" /></div></div>
                <div class="explain"><?php echo $option_value['desc']; ?></div>
                <div class="upload_button"><input class="reset_button" name="reset_button" type="button" value="Reset" /><input class="upload_image_button" type="button" value="Upload Image" /></div>
<?php } elseif ($option_value['type'] == "input2") { ?>
				<div class="controls_all"><div class="inputbg416"><input title="<?php echo wpthemes_settings( $option_value['id'] ); ?>" class="upload416" name="<?php echo $option_value['id']; ?>" value="<?php echo wpthemes_settings( $option_value['id'] ); ?>" type="text" id="<?php echo $option_value['id']; ?>" /></div><div class="explain_text"><?php echo $option_value['desc']; ?></div></div>
<?php } elseif ($option_value['type'] == "input3") { ?>
				<div class="controls"><div class="inputbg"><input title="<?php echo wpthemes_settings( $option_value['id'] ); ?>" class="upload" name="<?php echo $option_value['id']; ?>" value="<?php echo wpthemes_settings( $option_value['id'] ); ?>" type="text" id="<?php echo $option_value['id']; ?>" /></div></div>
                <div class="explain"><?php echo $option_value['desc']; ?></div>
<?php } elseif ($option_value['type'] == "checkbox") { ?>
				<?php if(wpthemes_settings($option_value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
				<label><input class="controls_check" type="checkbox" name="<?php echo $option_value['id']; ?>" id="<?php echo $option_value['id']; ?>" value="true" <?php echo $checked; ?> />
                <span class="explain_check"><?php echo $option_value['desc']; ?></span></label>
<?php } elseif ($option_value['type'] == "textarea1") { ?>
				<div class="controls"><div class="textareabg251"><textarea name="<?php echo $option_value['id']; ?>" id="<?php echo $option_value['id']; ?>" class="textarea251"><?php echo wpthemes_settings( $option_value['id'] ); ?></textarea></div></div>
<?php } elseif ($option_value['type'] == "textarea2") { ?>
				<div class="controls_all"><div class="textareabg416"><textarea class="textarea416" id="<?php echo $option_value['id']; ?>" name="<?php echo $option_value['id']; ?>" ><?php echo wpthemes_settings( $option_value['id'] ); ?></textarea></div></div>
				<div class="explain_text"><?php echo $option_value['desc']; ?></div>
<?php } elseif ($option_value['type'] == "link") { ?>
				<a href="<?php echo $option_value['href']; ?>"><?php echo $option_value['name']; ?></a>
<?php } elseif ($option_value['type'] == "section_box_head") { ?>
			<div class="section_box">
                <h3 class="title"><?php echo $option_value['title']; ?></h3>
                <div class="section_inside"><?php echo $option_value['desc']; ?></div>
                <ul>
<?php } elseif ($option_value['type'] == "section_box_foot") { ?>
				</ul>
            </div>
<?php } elseif ($option_value['type'] == "checkbox_li") { ?>
					<li>
                        <div class="option_title"><?php echo $option_value['title']; ?></div>
                        <ul class="clearfix">
							<?php foreach ($option_value['options'] as $option) { ?>
							<li><label><input class="check_box" id="<?php echo $option_value['id'],"-",$option['value']; ?>" name="<?php echo $option_value['id']; ?>[]" type="checkbox" <?php if (get_option( $option_value['id'])) { if (in_array($option['value'], get_option( $option_value['id'] ))) {echo '"checked="checked"'; }} ?> value="<?php echo $option['value']; ?>" /><span class="check_text"><?php echo $option['title']; ?></span></label></li>
							
							<?php } ?>
                            
                        </ul>
						<div class="selection">
							<label><input type="checkbox" id="select_all" />Select All</label>
							<label><input type="checkbox" id="invert_selection" />Invert Selection</label>
						</div>
                    </li>
<?php } elseif ($option_value['type'] == "section_box_head1") { ?>
			<div class="section_box">
                <h3 class="title"><?php echo $option_value['title']; ?></h3>
                <div class="option">
<?php } elseif ($option_value['type'] == "section_box_foot1") { ?>
				<div class="clear"></div>
                </div>
            </div>
<?php } elseif ($option_value['type'] == "option_list1") { ?>
					<div class="<?php echo $option_value['class']; ?>">
                    	<div class="description"><?php echo $option_value['title']; ?></div>
                        <div class="controls"><div class="textareabg251"><textarea name="<?php echo $option_value['id']; ?>" id="<?php echo $option_value['id']; ?>" class="textarea251"><?php echo wpthemes_settings( $option_value['id'] ); ?></textarea></div></div>
                        <div class="explain"><?php echo $option_value['desc']; ?></div>
                        <div class="clear"></div>
                    </div>
<?php } elseif ($option_value['type'] == "option_list") { ?>
					<div class="<?php echo $option_value['class']; ?>">
                    	<div class="description"><?php echo $option_value['title']; ?></div>
                        <div class="controls"><div class="inputbg"><input class="upload" name="<?php echo $option_value['id']; ?>" value="<?php echo wpthemes_settings( $option_value['id'] ); ?>" type="text" title="<?php echo wpthemes_settings( $option_value['id'] ); ?>" id="<?php echo $option_value['id']; ?>" /></div></div>
                        <div class="explain"><?php echo $option_value['desc']; ?></div>
                        <div class="clear"></div>
                    </div>
<?php } ?>
<?php } ?>
</form>
          </div>
        </div>
    </div>
    <div id="admin_main_bottom"></div>
</div>
<?php
}
 ?>