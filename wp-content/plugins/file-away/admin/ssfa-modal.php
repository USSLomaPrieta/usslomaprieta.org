<?php
defined('SSFA_FILE') or die("Shirley, you can't be serious.");
$limited = (SSFA_BASE1 !== '' && SSFA_BASE1 != false && SSFA_BS1NAME !== '' && SSFA_BS1NAME != false ? false : true);
$mmaccess = 0;
while ($mmaccess == 0):
	if(current_user_can('administrator')) $mmaccess = 1;
	$allowed_roles = explode(',', SSFA_MANAGER_ROLES);
	foreach ($allowed_roles as $role) if(current_user_can($role)) $mmaccess = 1;
	$allowed_users = explode(',', SSFA_MANAGER_USERS); $ID = get_current_user_id();
	foreach($allowed_users as $user) if($ID == $user) $mmaccess = 1;
	break;
endwhile;
$table_classes = (SSFA_CUSTOM_TABLE_CLASSES === '' ? false : preg_split("/(,\s|,)/", preg_replace('/\s+/', ' ', SSFA_CUSTOM_TABLE_CLASSES)));
$list_classes = (SSFA_CUSTOM_LIST_CLASSES === '' ? false : preg_split("/(,\s|,)/", preg_replace('/\s+/', ' ', SSFA_CUSTOM_LIST_CLASSES)));
$color_classes = (SSFA_CUSTOM_COLOR_CLASSES === '' ? false : preg_split("/(,\s|,)/", preg_replace('/\s+/', ' ', SSFA_CUSTOM_COLOR_CLASSES)));
$accent_classes = (SSFA_CUSTOM_ACCENT_CLASSES === '' ? false : preg_split("/(,\s|,)/", preg_replace('/\s+/', ' ', SSFA_CUSTOM_ACCENT_CLASSES)));
function ssfa_custom_selections ($classes){
	if ($classes){
		foreach ($classes as $class){
			list ($classclass, $classname) = preg_split ("/(\|)/", $class);
			$classclass = trim ($classclass, ' '); $classname = trim ($classname, ' ');
			echo ($classclass !== '' ? "<option value='$classclass'>$classname</option>" : null);
		}
	}
}
function ssfa_helplink($class){
	echo "<span class='link-ssfamodal-help-$class ssfamodal-helplink ssfa-helpinfo4'></span>"; }
function ssfa_helpmodal($id){
	echo "<div id='ssfamodal-help-$id' class='ssfamodal-help-backdrop'>
		<div class='ssfamodal-help-content'><div class='ssfamodal-help-close ssfa-helpclose2'></div>"; }
function ssfa_baseselect($id){
	echo '<select  id="ssfamodal-'.$id.'-base" class="select ssfamodal_base" name="base">
		<option value="">Base Directory</option>';
	if (SSFA_BS1NAME !== '' and SSFA_BASE1 !== '') 
		echo '<option value="" style="font-style: italic; color: red;">'.SSFA_BS1NAME.'</option>';
	if (SSFA_BS2NAME !== '' and SSFA_BASE2 !== '')
		echo '<option value="2">'.SSFA_BS2NAME.'</option>';
	if (SSFA_BS3NAME !== '' and SSFA_BASE3 !== '')
		echo '<option value="3">'.SSFA_BS3NAME.'</option>';
	if (SSFA_BS4NAME !== '' and SSFA_BASE4 !== '')
		echo '<option value="4">'.SSFA_BS4NAME.'</option>';
	if (SSFA_BS5NAME !== '' and SSFA_BASE5 !== '')
		echo '<option value="5">'.SSFA_BS5NAME.'</option>';	
	if ($GLOBALS['ssfa_s2member']) 
		echo '<option value="s2member-files">s2member-files</option>';	
	echo '</select>';
}
function ssfa_inclusionselect ($id, $type){
	if($type !== 'u'):
		echo "<div class='ss".$id."amodal_option' style='display:inline-block;'>
		<select id='ss".$id."amodal-".$id.$type."-images' class='select ss".$id."amodal_images' name='images' style='width:75px;'>
		<option value=''>Images</option>
		<option value='' style='font-style: italic; color: red;'>Include</option>
		<option value='only'>Only</option>
		<option value='none'>Exclude</option>
		</select> 
		<select id='ss".$id."amodal-".$id.$type."-code' class='select ss".$id."amodal_code' name='code' style='width:82px;'>
		<option value=''>Code Docs</option>
		<option value='' style='font-style: italic; color: red;'>Exclude</option>
		<option value='yes'>Include</option>
		</select> ";
		ssfa_helplink('images-code'); 
		echo "</div>
		<div class='ss".$id."amodal_option' style='display:inline-block;'>
		<input type='text' placeholder='Show Only Specific' id='ss".$id."amodal-".$id.$type."-only' class='ss".$id."amodal_only' name='only' value='' /> ";
		ssfa_helplink('only');
		echo "</div>
		<div class='ss".$id."amodal_option' style='display:inline-block;'>
		<input type='text' placeholder='Exclude Specific' id='ss".$id."amodal-".$id.$type."-exclude' class='ss".$id."amodal_exclude' name='exclude' value='' /> ";
		ssfa_helplink('exclude');
		echo "</div>
		<div class='ss".$id."amodal_option' style='display:inline-block;'>
		<input type='text' placeholder='Include Specific' id='ss".$id."amodal-".$id.$type."-include' class='ss".$id."amodal_include' name='include' value='' /> ";
		ssfa_helplink('include');
		echo "</div>";
	endif;
	echo "<div class='ss".$id."amodal_option' style='display:inline-block;'>
	<input type='text' placeholder='Show to Roles' id='ss".$id."amodal-".$id.$type."-showto' class='ss".$id."amodal_showto' name='showto' value='' /> ";
	ssfa_helplink('showto');
	echo "</div>
	<div class='ss".$id."amodal_option' style='display:inline-block;'>
	<input type='text' placeholder='Hide from Roles' id='ss".$id."amodal-".$id.$type."-hidefrom' class='ss".$id."amodal_hidefrom' name='hidefrom' value='' /> ";
	ssfa_helplink('hidefrom');
	echo "</div>";			
if($type === 'u'):
		echo "<div class='ss".$id."amodal_option' style='display:inline-block;'>
		<select id='ss".$id."amodal-".$id.$type."-action' class='select ss".$id."amodal_action' name='action'>
		<option value=''>File Type Action</option>
		<option value='' style='font-style: italic; color: red;'>Permit</option>
		<option value='prohibit'>Prohibit</option>
		</select> ";
		ssfa_helplink('action'); 
		echo "</div>
		<div class='ss".$id."amodal_option' style='display:inline-block;'>
		<input type='text' placeholder='File Types' id='ss".$id."amodal-".$id.$type."-filetypes' class='ss".$id."amodal_filetypes' name='filetypes' value='' /> ";
		ssfa_helplink('filetypes');
		echo "</div>
		<div class='ss".$id."amodal_option' style='display:inline-block;'>
		<select id='ss".$id."amodal-".$id.$type."-filegroups' class='select ss".$id."amodal_filegroups' style='height:110px;' name='filegroups' multiple=multiple>
		<option value=''>File Type Groups</option>";
		foreach($GLOBALS['ssfa_filegroups'] as $k=>$v) echo "<option value='".$k."'>".$v."</option>";
		echo "</select>";
		ssfa_helplink('filegroups'); 
		echo "</div>";
endif;
}
function ssfa_style_properties($id, $type){
	echo 	'<div class="ss'.$id.'amodal_option" style="display:inline-block;">'.
			'<input type="text" placeholder="Width" id="ss'.$id.'amodal-'.$id.$type.'-width" class="ss'.$id.'amodal_width" name="width" value="" maxlength="4" size="4" '.
				'style="width:80px; float:left;" />'.
			'<select id="ss'.$id.'amodal-'.$id.$type.'-perpx" class="select ss'.$id.'amodal_perpx" name="perpx" style="width:77px; margin-left:4px;" disabled>'.
				'<option value="" style="font-style: italic; color: red;">%</option>'.
				'<option value="px">px</option>'.
			'</select>';
			ssfa_helplink('width-perpx');
	echo	'</div>';
	echo 	'<div class="ss'.$id.'amodal_option" style="display:inline-block;">'.
			'<select id="ss'.$id.'amodal-'.$id.$type.'-align" class="select ss'.$id.$type.'amodal_align" style="width:80px; float:left;" name="align">'.
				'<option value="">Align</option>'.
				'<option value="" style="font-style: italic; color: red;">Left</option>'.
				'<option value="right">Right</option>'.
				'<option value="none">None</option>'.
			'</select>'.
			'<select id="ss'.$id.'amodal-'.$id.$type.'-size" class="select ss'.$id.'amodal_size" style="width:77px; margin-left:4px;" name="size">'.
				'<option value="">File Size</option>'.
				'<option value="" style="font-style: italic; color: red;">Show</option>'.
				'<option value="no">Hide</option>'.
			'</select>';
			ssfa_helplink('align-size');
	echo	'</div>';
	if($id !== 'a'):
	echo 	'<div id="ssfa-mod" class="ssfamodal_option" style="display:inline-block;">'.
			'<select id="ssfamodal-f'.$type.'-mod" class="select ssfamodal_mod" name="mod">'.
			'<option value="">Date Modified</option>'.
			'<option value="no">Hide</option>'.
			'<option value="yes">Show</option>'.
			'</select>';
			ssfa_helplink('mod');
	echo	'</div>';
	endif;
}
function ssfa_tablestyle_options($id){
	echo	'<div class="ss'.$id.'a-types ss'.$id.'amodal_option" style="display:inline-block;">'.
				'<select id="ss'.$id.'amodal-'.$id.'t-style" class="select ss'.$id.'amodal_tablestyle" name="style" disabled>'.
					'<option value="">Style</option>'.
					'<option value="" style="font-style: italic; color: red;">Minimalist</option>'.
					'<option value="silver-bullet">Silver Bullet</option>';
					ssfa_custom_selections ($table_classes);
	echo		'</select>';
	echo	'</div>';
	echo 	'<div class="ss'.$id.'a-types ss'.$id.'amodal_option" style="display:inline-block;">'.
				'<select id="ss'.$id.'amodal-'.$id.'t-search" class="select ss'.$id.'amodal_search" name="search" style="width:80px;" disabled>'.
					'<option value="">Filtering</option>'.
					'<option value="" style="font-style: italic; color: red;">On</option>'.
					'<option value="no">Off</option>'.
				'</select>'.
				'<select id="ss'.$id.'amodal-'.$id.'t-icons" class="select ss'.$id.'amodal_tableicons" name="icons" style="width:77px; margin-left:4px;" disabled>'.
					'<option value="">Icons</option>'.
					'<option value="" style="font-style: italic; color: red;">File Type</option>'.
					'<option value="paperclip">Paperclip</option>'.
					'<option value="none">None</option>'.
				'</select>';
				ssfa_helplink('search-icons');
	echo	'</div>';
	if($id === 'f'):
		echo "<div class='sssa-types ssfamodal_option' style='display:inline-block;'>".
		"<select id='ssfamodal-ft-color' class='select ssfamodal_color' name='color' style='width:80px;' disabled>".
		"<option value=''>Link Color</option>
		<option value='' style='font-style: italic; color: red;'>Classic</option>
		<option value='random'>Random</option>
		<option value='black'>Black</option>
		<option value='silver'>Silver</option>
		<option value='red'>Red</option>
		<option value='blue'>Blue</option>
		<option value='green'>Green</option>
		<option value='brown'>Brown</option>
		<option value='orange'>Orange</option>
		<option value='purple'>Purple</option>
		<option value='pink'>Pink</option>";
		ssfa_custom_selections ($color_classes); 
		echo "</select>";
		echo "<select id='ssfamodal-ft-iconcolor' class='select ssfamodal_iconcolor' name='iconcolor' style='width:77px; margin-left:4px;' disabled>".
		"<option value=''>Icon Color</option>
		<option value='' style='font-style: italic; color: red;'>Classic</option>
		<option value='random'>Random</option>
		<option value='black'>Black</option>
		<option value='silver'>Silver</option>
		<option value='red'>Red</option>
		<option value='blue'>Blue</option>
		<option value='green'>Green</option>
		<option value='brown'>Brown</option>
		<option value='orange'>Orange</option>
		<option value='purple'>Purple</option>
		<option value='pink'>Pink</option>";
		ssfa_custom_selections ($color_classes); 
		echo "</select>";
		ssfa_helplink('color-iconcolor');
		echo '</div>';
	endif;
	echo	'<div class="ss'.$id.'a-types ss'.$id.'amodal_option" style="display:inline-block;">'.
				'<select id="ss'.$id.'amodal-'.$id.'t-paginate" class="select ss'.$id.'amodal_paginate" name="paginate" style="width:80px; margin-top:1px; float:left;" disabled>'.
					'<option value="">Paginate</option>'.
					'<option value="" style="font-style: italic; color: red;">Off</option>'.
					'<option value="yes">On</option>'.
				'</select>'.
				'<input type="text" placeholder="# per page" id="ss'.$id.'amodal-'.$id.'t-pagesize" class="ss'.$id.'amodal_pagesize" name="pagesize" '.
					'value="" maxlength="3" size="3" style="width:77px; margin-left:4px;" disabled />';
				ssfa_helplink('paginate-pagesize');
	echo	'</div>'.
			'<div class="ss'.$id.'a-types ss'.$id.'amodal_option" style="display:inline-block;">'.
				'<select id="ss'.$id.'amodal-'.$id.'t-textalign" class="select ss'.$id.'amodal_textalign" name="textalign" disabled>'.
					'<option value="">Text Alignment</option>'.
					'<option value="" style="font-style: italic; color: red;">Center</option>'.
					'<option value="left">Left</option>'.
					'<option value="right">Right</option>'.
				'</select>';
				ssfa_helplink('textalign');
	echo	'</div>';
}
function ssfa_colorselect ($id, $type, $ctype, $cname, $cclass){
	$style = 	($ctype === 'color' ? ' style=\'width:80px;\'' : 
				($ctype === 'accent' ? ' style=\'width:77px; margin-left:4px;\'' : 
				($ctype === 'iconcolor' ? ' style=\'width:77px;\'' : null)));
	echo "<select id='ss".$id."amodal-".$id.$type."-".$ctype."' class='select ss".$id."amodal_".$ctype."' name='".$ctype."'".$style." disabled>
	<option value=''>".$cname."</option>
	<option value='' style='font-style: italic; color: red;'>"; echo ($ctype === 'accent' ? 'Matched' : 'Random'); echo "</option>
	<option value='black'>Black</option>
	<option value='silver'>Silver</option>
	<option value='red'>Red</option>
	<option value='blue'>Blue</option>
	<option value='green'>Green</option>
	<option value='brown'>Brown</option>
	<option value='orange'>Orange</option>
	<option value='purple'>Purple</option>
	<option value='pink'>Pink</option>";
	ssfa_custom_selections ($cclass); 
	echo "</select>";
}
?>
<div id="ssfamodal-form">
<div style="float:right;">
<?php if (current_user_can('manage_options')){ ?>
<a href="admin.php?page=file-away" target="_blank" class="ssfa-selectIt ssfa-config-options-modal" style="padding: 2px 15px;">Configure Options</a>
<?php } ?>
</div> 
<div id="ssfa-banner-anchor-wrap">
<div id="ssfa-banner">
<img src="<?php echo SSFA_IMAGES_URL.'fileaway_banner.png'; ?>" style="margin-left:5px; margin-right: 0px; position:relative; top:4px; width:225px;">
</div>
<div id="ssaa-banner">
<img src="<?php echo SSFA_IMAGES_URL.'attachaway_banner.png'; ?>" style="margin-left:5px; margin-right: 0px; position:relative; top:4px; width:225px;">
</div>
<div id="ssfu-banner">
<img src="<?php echo SSFA_IMAGES_URL.'fileup_banner.png'; ?>" style="margin-left:5px; margin-right: 0px; position:relative; top:4px; width:225px;">
</div>
</div>
<br />
<table id="ssfamodal-table" class="form-table" style="width:100%;">
<tr>
<td>
<table style="width:100%;">
<tr>
<td style="width: 30%; vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-shortcode-type" class="select ssfamodal_shortcode_type" name="shortcode-type">
<option value="null">Select Shortcode</option>
<option value="fileup">File Uploads</option>
<option value="fileaway">Directory Files</option>
<option value="attachaway">Post/Page Attachments</option>
<option value="fileaframe">File Away iFrame</option>
</select>
</div>
</td>
<td style="width: 30%; vertical-align: top;">
<div class="ssfamodal_option" style="display:inline-block; margin-left:1.5px;">
<select id="ssfamodal-type" class="select ssfamodal_type" name="type">
<option value="null">Select Type</option>
<option value="">Alphabetical List</option>
<option value="table">Sortable Data Table</option>
</select>
</div>
</td>
<td style="width: 30%; vertical-align: top;">
<div id="ssfamodal-submit-wrap" class="ssaamodal_option" style="display:inline-block; margin-left:2.5px;">
<input type="button" id="ssfamodal-submit" class="ssfa-selectIt" style="padding-left:0; padding-right:0; width:160px; margin-top:0; cursor:default;" value="Insert Shortcode" name="submit" disabled />
</div>
</td>
</tr>
</table>
<div id="ssfa-anchor-wrap">
<div id="ssfa-fileup-uploads-toggle">
<!------------------------------------------------------- FILEUP UPLOADS COLUMN 1 ------------------------------------------------------->
<?php if ($limited){ ?> 
<table>
<tr>
<td style="width: 30%; vertical-align: top;"> 
To use the Directory Files shortcode you need to assign at least the first base directory path and give it a display name. <a href="<?php echo get_admin_url ().'admin.php?page=file-away';?>" target="_blank">Get Started</a>
</td>
</tr>
</table>
<?php } else { ?> 
<table>
<tr>
<td style="width: 30%; vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Unique Name" id="ssfamodal-fu-name" class="ssfamodal_name" name="name" value="" />
<?php ssfa_helplink('upname') ?>
</div>
<div class="ssfamodal_option" style="display:inline-block;">
<?php ssfa_baseselect('fu') ?>
<!-- Do Not Remove This Space -->
<?php ssfa_helplink('upbase') ?>
</div>
<div id="ssfa-fu-subdir" class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Sub Directory" id="ssfamodal-fu-sub" class="ssfamodal_sub" name="sub" value="" />
<?php ssfa_helplink('sub') ?>
</div>
<div class="ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-fu-fixedlocation" class="select ssfamodal_fixedlocation" name="fixedlocation" disabled>
<option value="">Upload Locations</option>
<option value="" style="font-style: italic; color: red;">Allow Sub-Directory Selection</option>
<option value="true">Fixed</option>
</select>
<?php echo ssfa_helplink('fixedlocation'); ?>
</div>
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Max Size" id="ssfamodal-fu-maxsize" class="ssfamodal_maxsize" name="maxsize" value="" maxlength="4" size="4" style="width:80px; float:left;" />
<select id="ssfamodal-fu-maxsizetype" class="select ssfamodal_maxsizetype" name="maxsizetype" style="width:77px; margin-left:4px;" disabled>
<option value="m" style="font-style: italic; color: red;">MB</option>
<option value="k">KB</option>
<option value="g">GB</option>
</select>
<?php echo ssfa_helplink('maxsize'); ?>
</div>
</div>
</td>
<!------------------------------------------------------- FILEUP UPLOADS COLUMN 2 ------------------------------------------------------->
<td style="width: 30%; vertical-align: top;">
<?php ssfa_inclusionselect ('f', 'u') ?>
</td>
<!------------------------------------------------------- FILEUP UPLOADS COLUMN 3 ------------------------------------------------------->
<td style="width: 30%; vertical-align: top;">
<?php echo 
'<div class="ssfu-types ssfaamodal_option" style="display:inline-block;">'.
'<select id="ssfamodal-fu-style" class="select ssfaamodal_tablestyle" name="style" disabled>'.
'<option value="">Style</option>'.
'<option value="" style="font-style: italic; color: red;">Silver Bullet</option>'.
'<option value="minimalist">Minimalist</option>';
echo ssfa_custom_selections ($table_classes);
echo '</select>'.
'</div>'.
'<div class="ssfa-types ssfamodal_option" style="display:inline-block;">'.
'<select id="ssfamodal-fu-single" class="select ssfamodal_single" name="single" disabled>'.
'<option value="">Uploads at a Time</option>'.
'<option value="" style="font-style: italic; color: red;">Multiple</option>'.
'<option value="true">Single</option>'.
'</select>';
echo ssfa_helplink('uploads'); 
echo '</div>'.
'<div class="ssfamodal_option" style="display:inline-block;">'.
'<select id="ssfamodal-fu-align" class="select ssfamodal_align" style="width:80px; float:left;" name="align" disabled>'.
'<option value="">Align</option>'.
'<option value="" style="font-style: italic; color: red;">None</option>'.
'<option value="left">Left</option>'.
'<option value="right">Right</option>'.
'</select>'.
'<select id="ssfamodal-fu-iconcolor" class="select ssfamodal_iconcolor" name="iconcolor" style="width:77px; margin-left:4px;" disabled>'.
'<option value="">Icon Color</option>'.
'<option value="" style="font-style: italic; color: red;">Classic</option>'.
'<option value="random">Random</option>'.
'<option value="black">Black</option>'.
'<option value="silver">Silver</option>'.
'<option value="red">Red</option>'.
'<option value="blue">Blue</option>'.
'<option value="green">Green</option>'.
'<option value="brown">Brown</option>'.
'<option value="orange">Orange</option>'.
'<option value="purple">Purple</option>'.
'<option value="pink">Pink</option>';
echo ssfa_custom_selections ($color_classes);
echo '</select>';
echo ssfa_helplink('align-iconcolor'); 
echo '</div>'.
'<div class="ssfamodal_option" style="display:inline-block;">'.
'<input type="text" placeholder="Width" id="ssfamodal-fu-width" class="ssfamodal_width" name="width" value="" maxlength="4" size="4" style="width:80px; float:left;" />'.
'<select id="ssfamodal-fu-perpx" class="select ssfamodal_perpx" name="perpx" style="width:77px; margin-left:4px;" disabled>'.
'<option value="" style="font-style: italic; color: red;">%</option>'.
'<option value="px">px</option>'.
'</select>';
echo ssfa_helplink('upwidth-perpx');
echo '</div>'.
'<div class="ssfamodal_option" style="display:inline-block;">'.
'<input type="text" placeholder="Upload Label" id="ssfamodal-fu-uploadlabel" class="ssfamodal_uploadlabel" name="uploadlabel" value="" />';
echo ssfa_helplink('uploadlabel');
echo '</div>'; ?>
</div>
</td>
</tr>
</table>
<?php } ?> 
</div>
<div id="ssfa-fileaway-iframe-toggle">
<!------------------------------------------------------- FILEAWAY IFRAME ------------------------------------------------------->
<?php if ($limited){ ?> 
<table>
<tr>
<td style="vertical-align: top;"> 
To use the File Away iFrame shortcode you need to assign at least the first base directory path and give it a display name. <a href="<?php echo get_admin_url ().'admin.php?page=file-away';?>" target="_blank">Get Started</a>
</td>
</tr>
</table>
<?php } else { ?> 
<table>
<tr>
<td style="width: 30%; vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Unique Name" id="ssfamodal-fi-name" class="ssfamodal_iname" name="name" value="" />
<?php ssfa_helplink('iname') ?>
</div>
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Source URL" id="ssfamodal-fi-source" class="ssfamodal_isource" name="source" value="" />
<?php ssfa_helplink('isource') ?>
</div>
<div class="ssfamodal_option" style="display:inline-block; margin-right:0px;">
<select id="ssfamodal-fi-scroll" class="select ssfamodal_iscroll" name="scroll">
<option value="" style="font-style: italic; color: red;">Scrolling Off</option>
<option value="yes">Scrolling On</option>
<option value="auto">Scrolling Auto</option>
</select>
<?php ssfa_helplink('iscroll') ?>
</div>
</td>
<td style="width: 30%; vertical-align: top;">
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Height" id="ssfamodal-fi-height" class="ssfamodal_iheight" name="height" value="" />
<?php ssfa_helplink('iheight') ?>
</div>
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Width" id="ssfamodal-fi-width" class="ssfamodal_iwidth" name="width" value="" />
<?php ssfa_helplink('iwidth') ?>
</div>
</td>
<td style="width: 30%; vertical-align: top;">
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Margin Height" id="ssfamodal-fi-mheight" class="ssfamodal_imheight" name="mheight" value="" />
<?php ssfa_helplink('imheight') ?>
</div>
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Margin Width" id="ssfamodal-fi-mwidth" class="ssfamodal_imwidth" name="mwidth" value="" />
<?php ssfa_helplink('imwidth') ?>
</div>
</td>
</tr>
</table>
<h3>File Away iFrame Instructions</h3>
<ol style='font-size:11px;'>
<li> Create a new page and using the Template dropdown under Page Attributes, set the template to File Away iFrame.</li>
<li> Under Sortable Data Tables, insert your [fileaway] shortcode with the Directory Tree setting enabled, and assign it a Unique Name.</li>
<li> Save the page and remember the page slug. </li>
<li> Edit another page with your normal template, and insert the above File Away iFrame shortcode, with the page slug from the other page inserted into the Source URL field, and the unique name from the [fileaway] shortcode inserted into the Unique Name field. Click on all the info links to see what each setting does.</li>
<li> Done! Now you've got a Directory Tree table on your front-end page, that will navigate through the directories without refreshing the parent page. </li>
</ol>
<?php } ?> 
</div>
<div id="ssfa-fileaway-list-toggle">
<!------------------------------------------------------- FILEAWAY LIST COLUMN 1 ------------------------------------------------------->
<?php if ($limited){ ?> 
<table>
<tr>
<td style="width: 30%; vertical-align: top;"> 
To use the Directory Files shortcode you need to assign at least the first base directory path and give it a display name. <a href="<?php echo get_admin_url ().'admin.php?page=file-away';?>" target="_blank">Get Started</a>
</td>
</tr>
</table>
<?php } else { ?> 
<table>
<tr>
<td style="width: 30%; vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<?php ssfa_baseselect('fl') ?>
 <!-- Do Not Remove This Space -->
<?php ssfa_helplink('base') ?>
</div>
<div id="ssfa-list-s2skipconfirm" class="ssfamodal_option" style="display:none;">
<select id="ssfamodal-fl-s2skipconfirm" class="select ssfamodal_s2skipconfirm" name="s2skipconfirm">
<option value="">Skip Confirmation</option>
<option value="" style="font-style: italic; color: red;">No</option>
<option value="yes">Yes</option>
</select>
<?php ssfa_helplink('s2skipconfirm') ?>
</div>
<div id="ssfa-list-subdir" class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Sub Directory" id="ssfamodal-fl-sub" class="ssfamodal_sub" name="sub" value="" />
<?php ssfa_helplink('sub') ?>
</div>
<?php ssfa_inclusionselect ('f', 'l') ?>
</td>
<!------------------------------------------------------- FILEAWAY LIST COLUMN 2 ------------------------------------------------------->
<td style="width: 30%; vertical-align: top;">
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Heading" id="ssfamodal-fl-heading" class="ssfamodal_heading" name="heading" value="" />
<?php ssfa_helplink('heading') ?>
</div>
<div class="ssfamodal_option" style="display:inline-block;">
<?php ssfa_colorselect ('f', 'l', 'hcolor', 'Heading Color', $color_classes) ?>
<?php ssfa_helplink('hcolor') ?>
</div>
<?php ssfa_style_properties('f', 'l') ?>
<div id="ssfa-recursive" class="ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-fl-recursive" class="select ssfamodal_recursive" name="recursive">
<option value="">Recursive Iteration</option>
<option value="" style="font-style: italic; color: red;">Disabled</option>
<option value="on">Enabled</option>
</select>
<?php ssfa_helplink('recursive') ?>
</div>
<div class="ssfa-recursive-options" style="display:none;">
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Exclude Directories" id="ssfamodal-fl-excludedirs" class="ssfamodal_excludedirs" name="excludedirs" value="" />
<?php ssfa_helplink('excludedirs') ?>
</div>
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Only These Directories" id="ssfamodal-fl-onlydirs" class="ssfamodal_onlydirs" name="onlydirs" value="" />
<?php ssfa_helplink('onlydirs') ?>
</div>
</div>
</td>
<!------------------------------------------------------- FILEAWAY LIST COLUMN 3 ------------------------------------------------------->
<td style="width: 30%; vertical-align: top;">
<div class="ssfa-types ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-fl-style" class="select ssfamodal_liststyle" name="style" disabled>
<option value="">Style</option>
<option value="" style="font-style: italic; color: red;">Minimal-List</option>
<option value="silk">Silk</option>
<?php ssfa_custom_selections ($list_classes); ?>
</select>
</div>
<div class="ssfa-types ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-fl-corners" class="select ssfamodal_corners" name="corners" disabled>
<option value="">Corners</option>
<option value="" style="font-style: italic; color: red;">Rounded</option>
<option value="sharp">Sharp</option>
<option value="roundtop">Rounded Top</option>
<option value="roundbottom">Rounded Bottom</option>
<option value="roundleft">Rounded Left</option>
<option value="roundright">Rounded Right</option>
<option value="elliptical">Elliptical</option>
</select>
<?php ssfa_helplink('corners') ?>
</div>
<div class="ssfamodal_option" style="display:inline-block;">
<?php ssfa_colorselect ('f', 'l', 'color', 'Link Color', $color_classes) ?>
<?php ssfa_colorselect ('f', 'l', 'accent', 'Accent', $accent_classes) ?>
<?php ssfa_helplink('color-accent') ?>
</div>
<div class="ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-fl-icons" class="select ssfamodal_listicons" name="icons" style="width:80px;" disabled>
<option value="">Icons</option>
<option value="" style="font-style: italic; color: red;">File Type</option>
<option value="paperclip">Paperclip</option>
<option value="none">None</option>
</select>
<?php ssfa_colorselect ('f', 'l', 'iconcolor', 'Icon Color', $color_classes) ?>
<?php ssfa_helplink('icons-iconcolor') ?>
</div> 
<div class="ssfa-types ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-fl-display" class="select ssfamodal_display" name="display" disabled>
<option value="">Display</option>
<option value="" style="font-style: italic; color: red;">Vertical</option>
<option value="inline">Side-by-Side</option>
<option value="2col">Two Columns</option>
</select>
<?php ssfa_helplink('display') ?>
</div>
<div class="ssfa-types ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-fl-nolinks" class="select ssfamodal_nolinks" name="nolinks" disabled>
<option value="">Disable Links</option>
<option value="" style="font-style: italic; color: red;">False</option>
<option value="true">True</option>
</select>
<?php ssfa_helplink('nolinks') ?>
</div>
<div id="ssfa-table-debug" class="ssfamodal_option">
<select id="ssfamodal-fl-debug" class="select ssfamodal_debug" name="debug" style="margin-bottom:0!important;">
<option value="">Debug</option>
<option value="" style="font-style: italic; color: red;">Off</option>
<option value="on">On</option>
</select>
<?php ssfa_helplink('debug') ?>
</div>
</td>
</tr>
</table>
<?php } ?> 
</div>
<div id="ssfa-fileaway-table-toggle">
<!------------------------------------------------------- FILEAWAY TABLE COLUMN 1 ------------------------------------------------------->
<?php if ($limited){ ?> 
<table>
<tr>
<td style="width: 30%; vertical-align: top;"> 
To use the Directory Files shortcode you need to assign at least the first base directory path and give it a display name. <a href="<?php echo get_admin_url ().'admin.php?page=file-away';?>" target="_blank">Get Started</a>
</td>
</tr>
</table>
<?php } else { ?> 
<table>
<tr>
<td style="width: 30%; vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Unique Name" id="ssfamodal-ft-name" class="ssfamodal_name" name="name" value="" />
<?php ssfa_helplink('name') ?>
</div>
<div class="ssfamodal_option" style="display:inline-block;">
<?php ssfa_baseselect('ft') ?>
<!-- Do Not Remove This Space -->
<?php ssfa_helplink('base') ?>
</div>
<div id="ssfa-table-s2skipconfirm" class="ssfamodal_option" style="display:none;">
<select id="ssfamodal-ft-s2skipconfirm" class="select ssfamodal_s2skipconfirm" name="s2skipconfirm">
<option value="">Skip Confirmation</option>
<option value="" style="font-style: italic; color: red;">No</option>
<option value="yes">Yes</option>
</select>
<?php ssfa_helplink('s2skipconfirm') ?>
</div>
<div id="ssfa-table-subdir" class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Sub Directory" id="ssfamodal-ft-sub" class="ssfamodal_sub" name="sub" value="" />
<?php ssfa_helplink('sub') ?>
</div>
<?php ssfa_inclusionselect ('f', 't') ?>
</td>
<!------------------------------------------------------- FILEAWAY TABLE COLUMN 2 ------------------------------------------------------->
<td style="width: 30%; vertical-align: top;">
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Heading" id="ssfamodal-ft-heading" class="ssfamodal_heading" name="heading" value="" />
<?php ssfa_helplink('heading') ?>
</div>
<div class="ssfamodal_option" style="display:inline-block;">
<?php ssfa_colorselect ('f', 't', 'hcolor', 'Heading Color', $color_classes) ?>
<?php ssfa_helplink('hcolor') ?>
</div>
<?php ssfa_style_properties('f', 't') ?>
<div id="ssfa-bulkdownload" class="ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-ft-bulkdownload" class="select ssfamodal_bulkdownload" name="bulkdownload">
<option value="">Bulk Download</option>
<option value="" style="font-style: italic; color: red;">Disabled</option>
<option value="on">Enabled</option>
</select>
<?php ssfa_helplink('bulkdownload') ?>
</div>
<div id="ssfa-recursive" class="ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-ft-recursive" class="select ssfamodal_recursive" name="recursive">
<option value="">Recursive Iteration</option>
<option value="" style="font-style: italic; color: red;">Disabled</option>
<option value="on">Enabled</option>
</select>
<?php ssfa_helplink('recursive') ?>
</div>
<div id="ssfa-directories" class="ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-ft-directories" class="select ssfamodal_directories" name="directories">
<option value="">Directory Tree Navigation</option>
<option value="" style="font-style: italic; color: red;">Disabled</option>
<option value="on">Enabled</option>
</select>
<?php ssfa_helplink('directories') ?>
</div>
<?php if ($mmaccess): ?>
<div id="ssfa-manager" class="ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-ft-manager" class="select ssfamodal_manager" name="manager">
<option value="">Manager Mode</option>
<option value="" style="font-style: italic; color: red;">Disabled</option>
<option value="on">Enabled</option>
</select>
<?php ssfa_helplink('manager') ?>
</div>
<?php endif; ?>
<div id="ssfa-playback" class="ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-ft-playback" class="select ssfamodal_playback" name="playback">
<option value="">Audio Playback</option>
<option value="" style="font-style: italic; color: red;">Disabled</option>
<option value="compact">Compact</option>
<option value="extended">Extended</option>
</select>
<?php ssfa_helplink('playback') ?>
</div>
</td>
<!------------------------------------------------------- FILEAWAY TABLE COLUMN 3 ------------------------------------------------------->
<td style="width: 30%; vertical-align: top;">
<?php ssfa_tablestyle_options('f') ?>
<div id="ssfa-table-thumbnails" class="ssfamodal_option">
<select id="ssfamodal-ft-thumbnails" class="select ssfamodal_thumbnails" name="thumbnails">
<option value="">Image Thumbnails</option>
<option value="" style="font-style: italic; color: red;">Disabled</option>
<option value="transient">Transient</option>
<option value="permanent">Permanent</option>
</select>
<?php ssfa_helplink('thumbnails') ?>
</div>
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Custom Column Name(s)" id="ssfamodal-ft-customdata" class="ssfamodal_customdata" name="customdata" value="" disabled />
<?php ssfa_helplink('customdata') ?>
</div>
<div id="ssfa-table-sortfirst" class="ssfamodal_option">
<select id="ssfamodal-ft-sortfirst" class="select ssfamodal_sortfirst" name="sortfirst">
<option value="">Initial Sort</option>
<option value="" style="font-style: italic; color: red;">Filename (Asc)</option>
<option value="filename-desc">Filename (Desc)</option>
<option value="type">File Type (Asc)</option>
<option value="type-desc">File Type (Desc)</option>
<option value="custom">Custom Column (Asc)</option>
<option value="custom-desc">Custom Column (Desc)</option>
<option value="mod">Date Modified (Asc)</option>
<option value="mod-desc">Date Modified (Desc)</option>
<option value="size">File Size (Asc)</option>
<option value="size-desc">File Size (Desc)</option>
</select>
<?php ssfa_helplink('sortfirst') ?>
</div>
<div class="ssfa-types ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-ft-nolinks" class="select ssfamodal_nolinks" name="nolinks" disabled>
<option value="">Disable Links</option>
<option value="" style="font-style: italic; color: red;">False</option>
<option value="true">True</option>
</select>
<?php ssfa_helplink('nolinks') ?>
</div>
<div id="ssfa-table-debug" class="ssfamodal_option">
<select id="ssfamodal-ft-debug" class="select ssfamodal_debug" name="debug" style="margin-bottom:0!important;">
<option value="">Debug</option>
<option value="" style="font-style: italic; color: red;">Off</option>
<option value="on">On</option>
</select>
<?php ssfa_helplink('debug') ?>
</div>
</td>
</tr>
<!------------------------------------------------------- THUMBNAIL OPTIONS ------------------------------------------------------->
<tr style='display:none;' class='ssfa-thumbnails-options'>
<td  style="vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Max Source Image Bytes" id="ssfamodal-ft-maxsrcbytes" class="ssfamodal_maxsrcbytes" name="maxsrcbytes" value="" disabled />
<?php ssfa_helplink('maxsrcbytes') ?>
</div>
</td>
<td  style="vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Max Source Image Width" id="ssfamodal-ft-maxsrcwidth" class="ssfamodal_maxsrcwidth" name="maxsrcwidth" value="" disabled />
<?php ssfa_helplink('maxsrcwidth') ?>
</div>
</td>
<td  style="vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Max Source Image Height" id="ssfamodal-ft-maxsrcheight" class="ssfamodal_maxsrcheight" name="maxsrcheight" value="" disabled />
<?php ssfa_helplink('maxsrcheight') ?>
</div>
</td>
</tr>
<tr style='display:none;' class='ssfa-thumbnails-options-more'>
<td style="vertical-align: top;"> 
<div id="ssfa-table-thumbstyle" class="ssfamodal_option">
<select id="ssfamodal-ft-thumbstyle" class="select ssfamodal_thumbstyle" name="thumbstyle">
<option value="">Thumbnail Style</option>
<option value="" style="font-style: italic; color: red;">Wide-Rounded</option>
<option value="widesharp">Wide-Sharp</option>
<option value="squarerounded">Square-Rounded</option>
<option value="squaresharp">Square-Sharp</option>
<option value="oval">Oval</option>
<option value="circle">Circle</option>
</select>
<?php ssfa_helplink('thumbstyle') ?>
</td>
<td style="vertical-align: top;"> 
</div>
<div id="ssfa-table-graythumbs" class="ssfamodal_option">
<select id="ssfamodal-ft-graythumbs" class="select ssfamodal_graythumbs" name="graythumbs">
<option value="">Thumbnail Color Filter</option>
<option value="" style="font-style: italic; color: red;">None</option>
<option value="true">Grayscale</option>
</select>
<?php ssfa_helplink('graythumbs') ?>
</div>
</td>
</tr>
<!------------------------------------------------------- AUDIO PLAYBACK OPTIONS ------------------------------------------------------->
<tr style='display:none;' class='ssfa-playback-options'>
<td  style="vertical-align: top;"> 
<div id="ssfa-table-onlyaudio" class="ssfamodal_option">
<select id="ssfamodal-ft-onlyaudio" class="select ssfamodal_onlyaudio" name="onlyaudio">
<option value="">Audio Files Only</option>
<option value="" style="font-style: italic; color: red;">No</option>
<option value="true">Yes</option>
</select>
<?php ssfa_helplink('onlyaudio') ?>
</div>
<div id="ssfa-table-loopaudio" class="ssfamodal_option">
<select id="ssfamodal-ft-loopaudio" class="select ssfamodal_loopaudio" name="loopaudio">
<option value="">Loop Audio</option>
<option value="" style="font-style: italic; color: red;">No</option>
<option value="true">Yes</option>
</select>
<?php ssfa_helplink('loopaudio') ?>
</div>
</td>
<td  style="vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Playback Path" id="ssfamodal-ft-playbackpath" class="ssfamodal_playbackpath" name="playbackpath" value="" disabled />
<?php ssfa_helplink('playbackpath') ?>
</div>
</td>
<td  style="vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Playback Column Label" id="ssfamodal-ft-playbacklabel" class="ssfamodal_playbacklabel" name="playbacklabel" value="" disabled />
<?php ssfa_helplink('playbacklabel') ?>
</div>
</td>
</tr>
<!------------------------------------------------------- DIRECTORY ADDITIONAL OPTIONS ------------------------------------------------------->
<tr style='display:none;' class='ssfa-directory-tree-options'>
<td  style="vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<select id="ssfamodal-ft-drawericon" class="select ssfamodal_drawericon" name="drawericon" style="margin-bottom:0!important;">
<option value="">Directory Icon</option>
<option value="" style="font-style: italic; color: red;">Drawer</option>
<option value="drawer-2">Drawer Alt</option>
<option value="book">Book</option>
<option value="cabinet">Cabinet</option>
<option value="console">Console</option>
</select>
<?php ssfa_helplink('drawericon') ?>
</div>
</td>
<td  style="vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Drawer Column Label" id="ssfamodal-ft-drawerlabel" class="ssfamodal_drawerlabel" name="drawerlabel" value="" />
<?php ssfa_helplink('drawerlabel') ?>
</div>
</td>
</tr>
<!------------------------------------------------------- DIRECTORY / RECURSIVE ADDITIONAL OPTIONS ------------------------------------------------------->
<tr style='display:none;' class='ssfa-directory-recursive-options'>
<td  style="vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Exclude Directories" id="ssfamodal-ft-excludedirs" class="ssfamodal_excludedirs" name="excludedirs" value="" />
<?php ssfa_helplink('excludedirs') ?>
</div>
</td>
<td  style="vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Only These Directories" id="ssfamodal-ft-onlydirs" class="ssfamodal_onlydirs" name="onlydirs" value="" />
<?php ssfa_helplink('onlydirs') ?>
</div>
</td>
</tr>
<!------------------------------------------------------- MANAGER MODE ADDITIONAL OPTIONS ------------------------------------------------------->
<?php if ($mmaccess): ?>
<tr style='display:none;' class='ssfa-manager-mode-options'>
<td  style="vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Role Access Override" id="ssfamodal-ft-role_override" class="ssfamodal_role_override" name="role_override" value="" />
<?php ssfa_helplink('role_override') ?>
</div>
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Directory Management Access" id="ssfamodal-ft-dirman_access" class="ssfamodal_dirman_access" name="dirman_access" value="" />
<?php ssfa_helplink('dirman_access') ?>
</div>
</td>
<td  style="vertical-align: top;"> 
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="User Access Override" id="ssfamodal-ft-user_override" class="ssfamodal_user_override" name="user_override" value="" />
<?php ssfa_helplink('user_override') ?>
</div>
</td>
<td  style="vertical-align: top;">
<div class="ssfamodal_option" style="display:inline-block;">
<input type="text" placeholder="Override Password" id="ssfamodal-ft-password" class="ssfamodal_password" name="password" value="" />
<?php ssfa_helplink('password') ?>
</div>
</td>
</tr>
<?php endif; ?>
</table>
<?php } ?> 
</div>
<div id="ssfa-attachaway-list-toggle">
<!------------------------------------------------------- ATTACHAWAY LIST COLUMN 1 ------------------------------------------------------->
<table>
<tr>
<td style="width: 30%; vertical-align: top;">
<div class="ssaamodal_option" style="display:inline-block;">
<input type="text" placeholder="Post ID" id="ssaamodal-al-postid" class="ssaamodal_postid" name="postid" value="" style="width:45px;" /> 
<span style="font-size:10px; color:gray;">Optional</span>
<?php ssfa_helplink('postid') ?>
</div>
<?php ssfa_inclusionselect ('a', 'l') ?>
<div id="ssaa-list-debug" class="ssfamodal_option">
<select id="ssaamodal-al-debug" class="select ssaamodal_debug" name="debug" style="margin-bottom:0!important;">
<option value="">Debug</option>
<option value="" style="font-style: italic; color: red;">Off</option>
<option value="on">On</option>
</select>
<?php ssfa_helplink('debug') ?>
</div>
</td>
<!------------------------------------------------------- ATTACHAWAY LIST COLUMN 2 ------------------------------------------------------->
<td style="width: 30%; vertical-align: top;">
<div class="ssaamodal_option" style="display:inline-block;">
<input type="text" placeholder="Heading" id="ssaamodal-al-heading" class="ssaamodal_heading" name="heading" value="" />
<?php ssfa_helplink('heading') ?>
</div>
<div class="ssaamodal_option" style="display:inline-block;">
<?php ssfa_colorselect ('a', 'l', 'hcolor', 'Heading Color', $color_classes) ?>
<?php ssfa_helplink('hcolor') ?>
</div>
<?php ssfa_style_properties('a', 'l') ?>
<div class="ssaamodal_option" style="display:inline-block;">
<select id="ssaamodal-al-orderby" class="select ssaamodal_orderby" style="width:80px; float:left;" name="orderby">
<option value="">Order By</option>
<option value="" style="font-style: italic; color: red;">Title</option>
<option value="menu_order">Menu Order</option>
<option value="ID">ID</option>
<option value="date">Date</option>
<option value="modified">Modified</option>
<option value="rand">Random</option>
</select>
<select id="ssaamodal-al-desc" class="select ssaamodal_desc" style="width:77px; margin-left:4px;" name="desc">
<option value="">Desc</option>
<option value="" style="font-style: italic; color: red;">No</option>
<option value="yes">Yes</option>
</select>
<?php ssfa_helplink('orderby-desc') ?>
</div>
</td>
<!------------------------------------------------------- ATTACHAWAY LIST COLUMN 3 ------------------------------------------------------->
<td style="width: 30%; vertical-align: top;">
<div class="ssaa-types ssaamodal_option" style="display:inline-block;">
<select id="ssaamodal-al-style" class="select ssaamodal_liststyle" name="style" disabled>
<option value="">Style</option>
<option value="" style="font-style: italic; color: red;">Minimal-List</option>
<option value="silk">Silk</option>
<?php ssfa_custom_selections ($list_classes); ?>
</select>
</div>
<div class="ssaa-types ssaamodal_option" style="display:inline-block;">
<select id="ssaamodal-al-corners" class="select ssaamodal_corners" name="corners" disabled>
<option value="">Corners</option>
<option value="" style="font-style: italic; color: red;">Rounded</option>
<option value="sharp">Sharp</option>
<option value="roundtop">Rounded Top</option>
<option value="roundbottom">Rounded Bottom</option>
<option value="roundleft">Rounded Left</option>
<option value="roundright">Rounded Right</option>
<option value="elliptical">Elliptical</option>
</select>
<?php ssfa_helplink('corners') ?>
</div>
<div class="ssaamodal_option" style="display:inline-block;">
<?php ssfa_colorselect ('a', 'l', 'color', 'Link Color', $color_classes) ?>
<?php ssfa_colorselect ('a', 'l', 'accent', 'Accent', $accent_classes) ?>
<?php ssfa_helplink('color-accent') ?>
</div>
<div class="ssaamodal_option" style="display:inline-block;">
<select id="ssaamodal-al-icons" class="select ssaamodal_listicons" name="icons" style="width:80px;" disabled>
<option value="">Icons</option>
<option value="" style="font-style: italic; color: red;">File Type</option>
<option value="paperclip">Paperclip</option>
<option value="none">None</option>
</select>
<?php ssfa_colorselect ('a', 'l', 'iconcolor', 'Icon Color', $color_classes) ?>
<?php ssfa_helplink('icons-iconcolor') ?>
</div> 
<div class="ssaa-types ssaamodal_option" style="display:inline-block;">
<select id="ssaamodal-al-display" class="select ssaamodal_display" name="display" disabled>
<option value="">Display</option>
<option value="" style="font-style: italic; color: red;">Vertical</option>
<option value="inline">Side-by-Side</option>
<option value="2col">Two Columns</option>
</select>
<?php ssfa_helplink('display') ?>
</div>
</td>
</tr>
</table>
</div>
<div id="ssfa-attachaway-table-toggle">
<!------------------------------------------------------- ATTACHAWAY TABLE COLUMN 1 ------------------------------------------------------->
<table>
<tr>
<td style="width: 30%; vertical-align: top;">
<div class="ssaamodal_option" style="display:inline-block;">
<input type="text" placeholder="Post ID" id="ssaamodal-at-postid" class="ssaamodal_postid" name="postid" value="" style="width:45px;" /> <span style="font-size:10px; color:gray;">Optional</span>
<?php ssfa_helplink('postid') ?>
</div>
<?php ssfa_inclusionselect ('a', 't') ?>
<div id="ssaa-table-debug" class="ssfamodal_option">
<select id="ssaamodal-at-debug" class="select ssaamodal_debug" name="debug" style="margin-bottom:0!important;">
<option value="">Debug</option>
<option value="" style="font-style: italic; color: red;">Off</option>
<option value="on">On</option>
</select>
<?php ssfa_helplink('debug') ?>
</div>
</td>
<!------------------------------------------------------- ATTACHAWAY TABLE COLUMN 2 ------------------------------------------------------->
<td style="width: 30%; vertical-align: top;">
<div class="ssaamodal_option" style="display:inline-block;">
<input type="text" placeholder="Heading" id="ssaamodal-at-heading" class="ssaamodal_heading" name="heading" value="" />
<?php ssfa_helplink('heading') ?>
</div>
<div class="ssaamodal_option" style="display:inline-block;">
<?php ssfa_colorselect ('a', 't', 'hcolor', 'Heading Color', $color_classes) ?>
<?php ssfa_helplink('hcolor') ?>
</div>
<?php ssfa_style_properties('a', 't') ?>
</td>
<!------------------------------------------------------- ATTACHAWAY TABLE COLUMN 3 ------------------------------------------------------->
<td style="width: 30%; vertical-align: top;">
<?php ssfa_tablestyle_options('a') ?>
<div class="ssaamodal_option" style="display:inline-block;">
<input type="text" placeholder="Caption Column Name" id="ssaamodal-at-capcolumn" class="ssaamodal_capcolumn" name="capcolumn" value="" disabled />
<?php ssfa_helplink('capcolumn') ?>
</div>
<div class="ssaamodal_option" style="display:inline-block;">
<input type="text" placeholder="Description Column Name" id="ssaamodal-at-descolumn" class="ssaamodal_descolumn" name="descolumn" value="" disabled />
<?php ssfa_helplink('descolumn') ?>
</div>
<div id="ssaa-table-sortfirst" class="ssaa-types ssaamodal_option">
<select id="ssaamodal-at-sortfirst" class="select ssaamodal_sortfirst" name="sortfirst" style="margin-bottom:0!important;">
<option value="">Initial Sort</option>
<option value="" style="font-style: italic; color: red;">Filename (Asc)</option>
<option value="filename-desc">Filename (Desc)</option>
<option value="type">File Type (Asc)</option>
<option value="type-desc">File Type (Desc)</option>
<option value="caption">Caption (Asc)</option>
<option value="caption-desc">Caption (Desc)</option>
<option value="description">Description (Asc)</option>
<option value="description-desc">Description (Desc)</option>
<option value="size">File Size (Asc)</option>
<option value="size-desc">File Size (Desc)</option>
</select>
<?php ssfa_helplink('sortfirst') ?>
</div>
</td>
</tr>
</table> 
</div>
</div>
<script>
jQuery(document).ready(function($) {
	function colorizeSelect(){
	    if ($(this).prop('selectedIndex') === 0) $(this).addClass("empty");
	    else $(this).removeClass("empty")
	}
	$(".select").on('change keyup', colorizeSelect).change();
	$listbase = $('select#ssfamodal-fl-base');
	$tablebase = $('select#ssfamodal-ft-base');
	$thumbops = $('tr.ssfa-thumbnails-options');
	$morethumbops = $('tr.ssfa-thumbnails-options-more');
	$dirtreeops = $('tr.ssfa-directory-tree-options');
	$dirrecurseops = $('tr.ssfa-directory-recursive-options');
	$manmodeops = $('tr.ssfa-manager-mode-options');
	$playbackops = $('tr.ssfa-playback-options');
	$listrecurse = $('div.ssfa-recursive-options');
	$listskipconfirm = $('div#ssfa-list-s2skipconfirm');
	$tableskipconfirm = $('div#ssfa-table-s2skipconfirm');	
	// Thumbnails
	$thumbs = $('select#ssfamodal-ft-thumbnails');
	$srcbytes = $('input#ssfamodal-ft-maxsrcbytes');
	$srcwidth = $('input#ssfamodal-ft-maxsrcwidth');
	$srcheight = $('input#ssfamodal-ft-maxsrcheight');
	$thumbstyle = $('select#ssfamodal-ft-thumbstyle');
	$graythumbs = $('select#ssfamodal-ft-graythumbs');
	// Audio
	$playback = $('select#ssfamodal-ft-playback');
	$onlyaudio = $('select#ssfamodal-ft-onlyaudio');
	$loopaudio = $('select#ssfamodal-ft-loopaudio');
	$playbackpath = $('input#ssfamodal-ft-playbackpath');
	$playbacklabel = $('input#ssfamodal-ft-playbacklabel');
	// Directories
	$directories = $('select#ssfamodal-ft-directories');
	$drawericon = $('select#ssfamodal-ft-drawericon');
	$drawerlabel = $('input#ssfamodal-ft-drawerlabel');
	// Directories / Recursive
	$recursive = $('select#ssfamodal-ft-recursive');
	$excludedirs = $('input#ssfamodal-ft-excludedirs');
	$onlydirs = $('input#ssfamodal-ft-onlydirs');
	$listrecursive = $('select#ssfamodal-fl-recursive');
	$listexcludedirs = $('input#ssfamodal-fl-excludedirs');
	$listonlydirs = $('input#ssfamodal-fl-onlydirs');
	// Manager Mode
	$managermode = $('select#ssfamodal-ft-manager');
	$roleoverride = $('input#ssfamodal-ft-role_override');
	$useroverride = $('input#ssfamodal-ft-user_override');
	$password = $('input#ssfamodal-ft-password');
	$thumbs.on('change', function(){
		$thumbsetting = this.value;
		if($thumbsetting === 'transient'){ 
			$thumbops.fadeIn(1000); $morethumbops.fadeIn(1000);
		}else if($thumbsetting === 'permanent'){
			$thumbops.fadeOut(1000); $morethumbops.fadeIn(1000);
			$srcbytes.val(''); $srcwidth.val(''); $srcheight.val('');
		}else{
			$thumbstyle.val('').prop('selectedIndex',0).addClass("empty");
			$graythumbs.val('').prop('selectedIndex',0).addClass("empty");		
			$srcbytes.val(''); $srcwidth.val(''); $srcheight.val('');
			$thumbops.fadeOut(1000); $morethumbops.fadeOut(1000);
		}
	});
	$directories.on('change', function(){
		$dirtree = this.value;
		$dirrecurse = $('select#ssfamodal-ft-recursive').val();		
		if($dirtree !== ''){
			$dirtreeops.fadeIn(1000); 
			$dirrecurseops.fadeIn(1000);
			$recursive.val('').prop('selectedIndex',0).addClass("empty");
		}else{
			$drawericon.val('').prop('selectedIndex',0).addClass("empty");
			$drawerlabel.val('');
			$dirtreeops.fadeOut(1000);			
			if($dirrecurse === ''){
				$excludedirs.val('');
				$onlydirs.val('');
				$dirrecurseops.fadeOut(1000);
			}
		}
	});
	$recursive.on('change', function(){
		$recurse = this.value;
		$dirtrees = $('select#ssfamodal-ft-directories').val();
		if($recurse !== ''){
			$dirrecurseops.fadeIn(1000);
			$directories.val('').prop('selectedIndex',0).addClass("empty");
			$drawericon.val('').prop('selectedIndex',0).addClass("empty");
			$drawerlabel.val('');
			$managermode.val('').prop('selectedIndex',0).addClass("empty");			
			$roleoverride.val('');
			$useroverride.val('');
			$password.val('');
			$dirtreeops.fadeOut(1000);
			$manmodeops.fadeOut(1000);
		}else{
			if($dirtrees === ''){
				$excludedirs.val('');
				$onlydirs.val('');
				$dirrecurseops.fadeOut(1000);
			}
		}
	});	
	$listrecursive.on('change', function(){
		$lrecurse = this.value;
		if($lrecurse !== ''){
			$listrecurse.fadeIn(1000);
		}else{
			if($lrecurse === ''){
				$listexcludedirs.val('');
				$listonlydirs.val('');
				$listrecurse.fadeOut(1000);
			}
		}
	});	
	$managermode.on('change', function(){
		$manmode = this.value;
		if($manmode !== ''){ 
			$manmodeops.fadeIn(1000);
			$recursive.val('').prop('selectedIndex',0).addClass("empty");
			if($directories.val() === ''){
				$excludedirs.val('');
				$onlydirs.val('');
				$dirrecurseops.fadeOut(1000);
			}
			$playback.val('').prop('selectedIndex',0).addClass("empty");
			$onlyaudio.val('').prop('selectedIndex',0).addClass("empty");
			$playbackpath.val('');
			$playbacklabel.val('');
			$playbackops.fadeOut(1000);
		} else {
			$roleoverride.val('');
			$useroverride.val('');
			$password.val('');
			$manmodeops.fadeOut(1000);		
		}
	});
	$playback.on('change', function(){
		$hymnalmode = this.value;
		if($hymnalmode !== ''){ 
			$playbackops.fadeIn(1000);
			$managermode.val('').prop('selectedIndex',0).addClass("empty");
			$manmodeops.fadeOut(1000);
		} else {
			$onlyaudio.val('').prop('selectedIndex',0).addClass("empty");
			$loopaudio.val('').prop('selectedIndex',0).addClass("empty");		
			$playbackpath.val('');
			$playbacklabel.val('');
			$playbackops.fadeOut(1000);
		}
	});
	$listbase.on('change', function(){
		$base = this.value;
		if($base === 's2member-files'){
			$('div#ssfa-list-subdir').hide();
			$('div#ssfa-list-subdir input').val('');
			$listskipconfirm.fadeIn(1000);
			$listrecursive.val('').prop('selectedIndex',0).addClass("empty");
			$('div#ssfa-recursive').fadeOut(1000);
			$listexcludedirs.val('');
			$listonlydirs.val('');
			$listrecurse.fadeOut(1000);
		} else {
			$('select#ssfamodal-fl-s2skipconfirm').val('').prop('selectedIndex',0).addClass("empty");
			$listskipconfirm.hide();
			$('div#ssfa-list-subdir').fadeIn(1000);
			$('div#ssfa-recursive').fadeIn(1000);
		}
	});
	$tablebase.on('change', function(){
		$base = this.value;
		if($base === 's2member-files'){
			$('div#ssfa-table-subdir').hide();
			$('div#ssfa-table-subdir input').val('');
			$tableskipconfirm.fadeIn(1000);
			$recursive.val('').prop('selectedIndex',0).addClass("empty");
			$directories.val('').prop('selectedIndex',0).addClass("empty");
			$managermode.val('').prop('selectedIndex',0).addClass("empty");
			$('div#ssfa-recursive').fadeOut(1000);
			$('div#ssfa-directories').fadeOut(1000);
			$('div#ssfa-manager').fadeOut(1000);
			$excludedirs.val('');
			$onlydirs.val('');
			$drawericon.val('').prop('selectedIndex',0).addClass("empty");
			$drawerlabel.val('');
			$roleoverride.val('');
			$useroverride.val('');
			$password.val('');
			$dirtreeops.fadeOut(1000);
			$manmodeops.fadeOut(1000);
			$dirrecurseops.fadeOut(1000);
		} else {
			$('select#ssfamodal-ft-s2skipconfirm').val('').prop('selectedIndex',0).addClass("empty");
			$tableskipconfirm.hide();
			$('div#ssfa-table-subdir').fadeIn(1000);
			$('div#ssfa-recursive').fadeIn(1000);
			$('div#ssfa-directories').fadeIn(1000);
			$('div#ssfa-manager').fadeIn(1000);
		}
	});	
	$('#ssfamodal-type, #ssfamodal-shortcode-type').bind('change', function(event){
		$("#ssfa-fileaway-list-toggle .select").addClass("empty");
		$("#ssfa-fileaway-table-toggle .select").addClass("empty");
		$("#ssfa-fileup-uploads-toggle .select").addClass("empty");
		$("#ssfa-fileaway-iframe-toggle .select").addClass("empty");
		$("#ssfa-attachaway-list-toggle .select").addClass("empty");
		$("#ssfa-attachaway-table-toggle .select").addClass("empty");
		$thumbops.fadeOut(1000); $morethumbops.fadeOut(1000); $manmodeops.fadeOut(1000); 
		$dirtreeops.fadeOut(1000); $dirrecurseops.fadeOut(1000); $playbackops.fadeOut(1000); $listrecurse.fadeOut(1000);
		$('div#ssfa-table-s2skipconfirm').hide(); $('div#ssfa-list-s2skipconfirm').hide(); $('div#ssfa-list-subdir').fadeIn(1000);
		$('div#ssfa-table-subdir').fadeIn(1000); $('div#ssfa-recursive').fadeIn(1000); $('div#ssfa-directories').fadeIn(1000); $('div#ssfa-manager').fadeIn(1000);
	});
	$('#ssfamodal-shortcode-type').bind('change', function(event){
		var $st = $('#ssfamodal-shortcode-type').val(); 
		if ($st == "null" || $st == 'fileaway' || $st == 'fileaframe'){
			$('#ssfu-banner').css({opacity : '0', 'z-index' : '-1', transition : 'all 1s ease-out'});
			$('#ssaa-banner').css({opacity : '0', 'z-index' : '-1', transition : 'all 1s ease-out'});
			$('#ssfa-banner').delay(1000).queue(function(next){ 
				$(this).css({opacity : '1', 'z-index' : '1', transition : 'all 1s ease-in'}); next(); 
			});
		}
		else if ($st == "attachaway"){
			$('#ssfu-banner').css({opacity : '0', 'z-index' : '-1', transition : 'all 1s ease-out'});
			$('#ssfa-banner').css({opacity : '0', 'z-index' : '-1', transition : 'all 1s ease-out'});
			$('#ssaa-banner').delay(1000).queue(function(next){
				$(this).css({opacity : '1', 'z-index' : '1', transition : 'all 1s ease-in'}); next();
			});
		}
		else if ($st == "fileup"){
			$('#ssaa-banner').css({opacity : '0', 'z-index' : '-1', transition : 'all 1s ease-out'});
			$('#ssfa-banner').css({opacity : '0', 'z-index' : '-1', transition : 'all 1s ease-out'});
			$('#ssfu-banner').delay(1000).queue(function(next){
				$(this).css({opacity : '1', 'z-index' : '1', transition : 'all 1s ease-in'}); next();
			});
		}			 
 	});
	$('#ssfamodal-shortcode-type, #ssfamodal-type').bind('change', function(event){
		var $sct = $('#ssfamodal-shortcode-type').val(); 
		var $t = $('#ssfamodal-type').val();
		var $ts = $('#ssfamodal-type');				   
		if ($sct !== "fileaframe" && $sct !== "fileup") $ts.fadeIn(1000);
		if ($sct == "null" || $t == 'null'){
			$('#ssfamodal-submit-wrap, #ssfa-attachaway-table-toggle, #ssfa-fileaway-list-toggle, #ssfa-fileaway-table-toggle, #ssfa-fileaway-iframe-toggle, #ssfa-attachaway-list-toggle, #ssfa-fileup-uploads-toggle')
			.css({opacity : '0', 'z-index' : '-1', transition : 'all 1s ease-out'});
			$('#ssfamodal-submit-wrap input:button').attr('disabled', 'disabled').css({cursor : 'default'});
			$('#ssfa-attachaway-table-toggle input:text, #ssfa-attachaway-table-toggle select, #ssfa-fileaway-list-toggle input:text, #ssfa-fileaway-list-toggle select, #ssfa-fileaway-table-toggle input:text,	#ssfa-fileaway-table-toggle select, #ssfa-fileaway-iframe-toggle input:text, #ssfa-fileaway-iframe-toggle select, #ssfa-attachaway-list-toggle input:text, #ssfa-attachaway-list-toggle select, #ssfa-fileup-uploads-toggle input:text, #ssfa-fileup-uploads-toggle select').val('').prop('selectedIndex',0).attr('disabled', 'disabled');
		}
        if ($sct=="fileaway" && $t==""){
			$('#ssfamodal-submit-wrap, #ssfa-fileaway-table-toggle, #ssfa-attachaway-table-toggle, #ssfa-fileaway-iframe-toggle, #ssfa-attachaway-list-toggle, #ssfa-fileup-uploads-toggle')
			.css({opacity : '0', 'z-index' : '-1', transition : 'all 1s ease-out'});
			$('#ssfamodal-submit-wrap, #ssfa-fileaway-list-toggle').delay(1000)
				.queue(function(next){ $(this).css({opacity : '1', 'z-index' : '1', transition : 'all 1s ease-in'}); next(); });
			$('#ssfamodal-submit-wrap input:button').attr('disabled', 'disabled').css({cursor : 'default'});
			$('#ssfa-fileaway-table-toggle input:text, #ssfa-fileaway-table-toggle select, #ssfa-fileaway-iframe-toggle input:text, #ssfa-fileaway-iframe-toggle select, #ssfa-attachaway-table-toggle input:text, #ssfa-attachaway-table-toggle select, #ssfa-attachaway-list-toggle input:text, #ssfa-attachaway-list-toggle select, #ssfa-fileup-uploads-toggle input:text, #ssfa-fileup-uploads-toggle select')
			.val('').prop('selectedIndex',0).attr('disabled', 'disabled');
			$('#ssfamodal-submit-wrap input:button').removeAttr('disabled').css({cursor : 'pointer'});
			$('#ssfa-fileaway-list-toggle input:text, #ssfa-fileaway-list-toggle select').removeAttr('disabled');
			$('#ssfamodal-fl-corners').prop('selectedIndex',0).attr('disabled', 'disabled');
			$('#ssfamodal-fl-perpx').prop('selectedIndex',0).attr('disabled', 'disabled');
		}
	    if ($sct=="fileaway" && $t=="table"){
			$('#ssfamodal-submit-wrap, #ssfa-fileaway-list-toggle, #ssfa-attachaway-table-toggle, #ssfa-fileaway-iframe-toggle, #ssfa-attachaway-list-toggle, #ssfa-fileup-uploads-toggle')
			.css({opacity : '0', 'z-index' : '-1', transition : 'all 1s ease-out'});
			$('#ssfamodal-submit-wrap, #ssfa-fileaway-table-toggle').delay(1000)
				.queue(function(next){ $(this).css({opacity : '1', 'z-index' : '1', transition : 'all 1s ease-in'}); next(); });			  
			$('#ssfamodal-submit-wrap input:button').attr('disabled', 'disabled').css({cursor : 'default'});
			$('#ssfa-fileaway-list-toggle input:text, #ssfa-fileaway-list-toggle select, #ssfa-fileaway-iframe-toggle input:text, #ssfa-fileaway-iframe-toggle select, #ssfa-attachaway-table-toggle input:text, #ssfa-attachaway-table-toggle select, #ssfa-attachaway-list-toggle input:text, #ssfa-attachaway-list-toggle select, #ssfa-fileup-uploads-toggle input:text, #ssfa-fileup-uploads-toggle select')
			.val('').prop('selectedIndex',0).attr('disabled', 'disabled');
			$('#ssfamodal-submit-wrap input:button').removeAttr('disabled').css({cursor : 'pointer'});
			$('#ssfa-fileaway-table-toggle input:text, #ssfa-fileaway-table-toggle select').removeAttr('disabled');
			$('#ssfamodal-ft-pagesize').val('').attr('disabled', 'disabled');
			$('#ssfamodal-ft-perpx').prop('selectedIndex',0).attr('disabled', 'disabled');
		}
		if ($sct=="attachaway" && $t==""){
			$('#ssfamodal-submit-wrap, #ssfa-fileaway-table-toggle, #ssfa-attachaway-table-toggle, #ssfa-fileaway-iframe-toggle, #ssfa-fileaway-list-toggle, #ssfa-fileup-uploads-toggle')
			.css({opacity : '0', 'z-index' : '-1', transition : 'all 1s ease-out'});
			$('#ssfamodal-submit-wrap, #ssfa-attachaway-list-toggle').delay(1000)
				.queue(function(next){ $(this).css({opacity : '1', 'z-index' : '1', transition : 'all 1s ease-in'}); next(); }); 		
			$('#ssfamodal-submit-wrap input:button').attr('disabled', 'disabled').css({cursor : 'default'});	
			$('#ssfa-fileaway-table-toggle input:text, #ssfa-fileaway-table-toggle select, #ssfa-attachaway-table-toggle input:text, #ssfa-attachaway-table-toggle select, #ssfa-fileaway-iframe-toggle input:text, #ssfa-fileaway-iframe-toggle select, #ssfa-fileaway-list-toggle input:text, #ssfa-fileaway-list-toggle select, #ssfa-fileup-uploads-toggle input:text, #ssfa-fileup-uploads-toggle select')
			.val('').prop('selectedIndex',0).attr('disabled', 'disabled');
			$('#ssfamodal-submit-wrap input:button').removeAttr('disabled').css({cursor : 'pointer'});
			$('#ssfa-attachaway-list-toggle input:text, #ssfa-attachaway-list-toggle select').removeAttr('disabled');
			$('#ssaamodal-al-corners').prop('selectedIndex',0).attr('disabled', 'disabled');
			$('#ssaamodal-al-perpx').prop('selectedIndex',0).attr('disabled', 'disabled');				
		}
		if ($sct=="attachaway" && $t=="table"){
			$('#ssfamodal-submit-wrap, #ssfa-fileaway-list-toggle, #ssfa-fileaway-table-toggle, #ssfa-fileaway-iframe-toggle, #ssfa-attachaway-list-toggle, #ssfa-fileup-uploads-toggle')
			.css({opacity : '0', 'z-index' : '-1', transition : 'all 1s ease-out'});
			$('#ssfamodal-submit-wrap, #ssfa-attachaway-table-toggle').delay(1000)
				.queue(function(next){ $(this).css({opacity : '1', 'z-index' : '1', transition : 'all 1s ease-in'}); next(); }); 				  
			$('#ssfamodal-submit-wrap input:button').attr('disabled', 'disabled').css({cursor : 'default'});
			$('#ssfa-fileaway-list-toggle input:text, #ssfa-fileaway-list-toggle select, #ssfa-fileaway-table-toggle input:text, #ssfa-fileaway-table-toggle select, #ssfa-fileaway-iframe-toggle input:text, #ssfa-fileaway-iframe-toggle select, #ssfa-attachaway-list-toggle input:text, #ssfa-attachaway-list-toggle select, #ssfa-fileup-uploads-toggle input:text, #ssfa-fileup-uploads-toggle select')
			.val('').prop('selectedIndex',0).attr('disabled', 'disabled');
			$('#ssfamodal-submit-wrap input:button').removeAttr('disabled').css({cursor : 'pointer'});
			$('#ssfa-attachaway-table-toggle input:text, #ssfa-attachaway-table-toggle select').removeAttr('disabled');
			$('#ssaamodal-at-pagesize').val('').attr('disabled', 'disabled');
			$('#ssaamodal-at-perpx').prop('selectedIndex',0).attr('disabled', 'disabled');
		}
	    if ($sct=="fileup"){
			$ts.fadeOut(1000);
			$('#ssfamodal-submit-wrap, #ssfa-fileaway-list-toggle, #ssfa-fileaway-table-toggle, #ssfa-attachaway-table-toggle, #ssfa-attachaway-list-toggle, #ssfa-fileaway-iframe-toggle')
			.css({opacity : '0', 'z-index' : '-1', transition : 'all 1s ease-out'});
			$('#ssfamodal-submit-wrap, #ssfa-fileup-uploads-toggle').delay(1000)
				.queue(function(next){ $(this).css({opacity : '1', 'z-index' : '1', transition : 'all 1s ease-in'}); next(); });			  
			$('#ssfamodal-submit-wrap input:button').attr('disabled', 'disabled').css({cursor : 'default'});
			$('#ssfa-fileaway-list-toggle input:text, #ssfa-fileaway-list-toggle select, #ssfa-fileaway-table-toggle input:text, #ssfa-fileaway-table-toggle select, #ssfa-attachaway-table-toggle input:text, #ssfa-attachaway-table-toggle select, #ssfa-attachaway-list-toggle input:text, #ssfa-attachaway-list-toggle select, #ssfa-fileaway-iframe-toggle input:text, #ssfa-fileaway-iframe-toggle select')
			.val('').prop('selectedIndex',0).attr('disabled', 'disabled');
			$('#ssfamodal-submit-wrap input:button').removeAttr('disabled').css({cursor : 'pointer'});
			$('#ssfa-fileup-uploads-toggle input:text, #ssfa-fileup-uploads-toggle select').removeAttr('disabled');
		}		
	    if ($sct=="fileaframe"){
			$ts.fadeOut(1000);
			$('#ssfamodal-submit-wrap, #ssfa-fileaway-list-toggle, #ssfa-fileaway-table-toggle, #ssfa-attachaway-table-toggle, #ssfa-attachaway-list-toggle, #ssfa-fileup-uploads-toggle')
			.css({opacity : '0', 'z-index' : '-1', transition : 'all 1s ease-out'});
			$('#ssfamodal-submit-wrap, #ssfa-fileaway-iframe-toggle').delay(1000)
				.queue(function(next){ $(this).css({opacity : '1', 'z-index' : '1', transition : 'all 1s ease-in'}); next(); });			  
			$('#ssfamodal-submit-wrap input:button').attr('disabled', 'disabled').css({cursor : 'default'});
			$('#ssfa-fileaway-list-toggle input:text, #ssfa-fileaway-list-toggle select, #ssfa-fileaway-table-toggle input:text, #ssfa-fileaway-table-toggle select, #ssfa-attachaway-table-toggle input:text, #ssfa-attachaway-table-toggle select, #ssfa-attachaway-list-toggle input:text, #ssfa-attachaway-list-toggle select, #ssfa-fileup-uploads-toggle input:text, #ssfa-fileup-uploads-toggle select')
			.val('').prop('selectedIndex',0).attr('disabled', 'disabled');
			$('#ssfamodal-submit-wrap input:button').removeAttr('disabled').css({cursor : 'pointer'});
			$('#ssfa-fileaway-iframe-toggle input:text, #ssfa-fileaway-iframe-toggle select').removeAttr('disabled');
		}
	});
	var $width_al = $('input#ssaamodal-al-width');
	var $width_at = $('input#ssaamodal-at-width');
	var $width_fl = $('input#ssfamodal-fl-width');
	var $width_ft = $('input#ssfamodal-ft-width');
	var $width_fu = $('input#ssfamodal-fu-width');	
	var $perpx_al = $('select#ssaamodal-al-perpx');
	var $perpx_at = $('select#ssaamodal-at-perpx');
	var $perpx_fl = $('select#ssfamodal-fl-perpx');
	var $perpx_ft = $('select#ssfamodal-ft-perpx');
	var $perpx_fu = $('select#ssfamodal-fu-perpx');	
	var $corners_al = $('select#ssaamodal-al-corners');
	var $corners_fl = $('select#ssfamodal-fl-corners');
	var $style_al = $('select#ssaamodal-al-style');
	var $style_fl = $('select#ssfamodal-fl-style');
	var $style_fu = $('select#ssfamodal-fu-style');	
	var $pagination_at = $('select#ssaamodal-at-paginate');
	var $pagination_ft = $('select#ssfamodal-ft-paginate');
	var $pagenum_at = $('input#ssaamodal-at-pagesize');
	var $pagenum_ft = $('input#ssfamodal-ft-pagesize');	
	$width_al.on('input', function(){
		if ($(this).val() !== ''){
			$perpx_al.removeAttr('disabled');
		} else {
			$perpx_al.attr('disabled', 'disabled').val('').prop('selectedIndex',0).addClass("empty");
		}
	});
	$width_at.on('input', function(){
		if ($(this).val() !== ''){
			$perpx_at.removeAttr('disabled');
		} else {
			$perpx_at.attr('disabled', 'disabled').val('').prop('selectedIndex',0).addClass("empty");
		}
	});
	$width_fl.on('input', function(){
		if ($(this).val() !== ''){
			$perpx_fl.removeAttr('disabled');
		} else {
			$perpx_fl.attr('disabled', 'disabled').val('').prop('selectedIndex',0).addClass("empty");
		}
	}); 
	$width_ft.on('input', function(){
		if ($(this).val() !== ''){
			$perpx_ft.removeAttr('disabled');
		} else {
			$perpx_ft.attr('disabled', 'disabled').val('').prop('selectedIndex',0).addClass("empty");
		}
	});			
	$width_fu.on('input', function(){
		if ($(this).val() !== ''){
			$perpx_fu.removeAttr('disabled');
		} else {
			$perpx_fu.attr('disabled', 'disabled').val('').prop('selectedIndex',0).addClass("empty");
		}
	});			
	$style_al.change(function(){
	   	if ($style_al.val() !== ''){
	       	$corners_al.removeAttr('disabled');
		} else {
			$corners_al.attr('disabled', 'disabled').val('');
		}
	}).trigger('change');	
	$style_fl.change(function(){	
		if ($style_fl.val() !== ''){
			$corners_fl.removeAttr('disabled');
		} else {
			$corners_fl.attr('disabled', 'disabled').val('');
		}	
	}).trigger('change');
//	$pagination_at.change(function(){
//		if ($pagination_at.val() !== ''){
//			$pagenum_at.removeAttr('disabled');
//		} else {
//			$pagenum_at.attr('disabled', 'disabled').val('');
//		}
//	}).trigger('change');
	$pagination_at.on('change', function (e) {
	    $optionSelected = $("option:selected", this);
	    $apval = this.value;
		if ($apval !== '') $pagenum_at.removeAttr('disabled');
		else $pagenum_at.attr('disabled', 'disabled').val('');
	});
	$pagination_ft.on('change', function (e) {
	    $optionSelected = $("option:selected", this);
	    $pval = this.value;
		if ($pval !== '') $pagenum_ft.removeAttr('disabled');
		else $pagenum_ft.attr('disabled', 'disabled').val('');
	});
	var	con = $('.ssfamodal-help-content'),
		wba = $('.better-attachments'),
		fao = $('.feature-options');		
	var innerlink = $('.inner-link'); innerlink.on('click', function(ev){ ev.preventDefault(); var url = $(this).attr('href'); window.open(url, '_blank'); });									
	$('div[id^=ssfamodal-help-]').each(function(){
		var sfx = this.id,
			mdl = $(this),
			cls = $('.ssfamodal-help-close'),			
			lnk = $('.link-' + sfx);
		lnk.click(function(){
			mdl.fadeIn('fast');
		});
		mdl.click(function(){
			mdl.fadeOut('fast');
		});
		cls.click(function(){
			mdl.fadeOut('fast');
		});
	});
		con.click(function(){
			return false;
		});
		wba.click(function(){
			window.open('http://wordpress.org/plugins/wp-better-attachments/', '_blank');
		});
		fao.click(function(){
			window.open('admin.php?page=file-away#options', '_blank');
		});				
});
</script>
<?php ssfa_helpmodal('base'); ?>
<h4>Base Directory</h4>
Begin with one of the base directories you set up in the Configuration page. You can extend this path using the Sub Directory option.
<br />
<br />
Defaults to the first option if left blank.
</div></div>
<?php ssfa_helpmodal('sub'); ?>
<h4>Sub Directory</h4>
Optional: Define a sub-directory to extend the path of your selected base directory. It can be one or more levels deep. You can leave out leading and trailing slashes. I.e., <code>uploads/2010</code> rather than <code>/uploads/2010/</code>
<br />
<br />
You can also use one or more of the four dynamic path codes: <code>fa-firstlast</code> <code>fa-userid</code> <code>fa-username</code> and <code>fa-userrole</code>. If you've created directories that are named for your users' first and last names (e.g., jackhandy), userid (e.g., 15), username (e.g., admin), or user role (e.g., subscriber), the codes will dynamically point whoever is logged in to their appropriate folder. The directories you create for your users must be all lowercase with no spaces. If the username is 'JoanJett,' the directory should be: <code>joanjett</code>
<br />
<br />
For example: <code>uploads/fa-userrole/fa-firstlastfa-userid</code> will point dynamically, depending on who is logged in, to directories like: <code>uploads/editor/jackhandy15</code> or <code>uploads/subscriber/joanjett58</code>.
</div></div>
<?php ssfa_helpmodal('upbase'); ?>
<h4>Base Directory</h4>
Choose one of the base directories you set up in the Configuration page. This is the initial folder to which a user may upload files. They will be able to upload to any subdirectories, but not to any parent directories of the initial directory specified. You can extend this path using the Sub Directory option.
<br />
<br />
Defaults to the first option if left blank.
</div></div>
<?php ssfa_helpmodal('images-code'); ?>
<h4>Images</h4>
Optional: If left blank, the default behavior is to list image files along with all other files. You can alternatively choose to exclude all image types from your display, or to show only image types in your display. Image types are: .bmp, .gif, .jpg, .jpeg, .png, .tif, .tiff
<br />
<br />
<h4>Code Documents</h4>
By default, and for security, web code documents are excluded from file displays. If you have a directory or attachment page with some code docs that you want to include in your display, you can choose to include them along with any/all other file types. Code file types excluded by default are: .asp, .cfm, .cgi, .class, .cpp, .css, .htm, .html, .java, .js, .less, .php, .pl, .py, .rb, .sass, .scss, .shtm, .shtml, .xhtm, .xhtml, and .yml. The one exception is index.htm/l and index.php files, which are always excluded, and will not be included if Code Docs are enabled.
</div></div>
<?php ssfa_helpmodal('only'); ?>
<h4>Show Only Specific</h4>
If you'd like, you can enter a comma-separated list of filenames and/or file extensions here. Doing this will filter out anything not here entered. Do not use quotation marks. Just separate each item with a comma. 
<br />
<br />
Example: 
<br />
<br />
<code>My Polished Essay, .mp3, Gertrude Stein Essay, .jpg</code>
<br />
<br />
This will tell the shortcode only to ouput files that have the string 'My Polished Essay' or 'Gertrude Stein Essay', and any file with the extension .mp3 or .jpg
</div></div>
<?php ssfa_helpmodal('exclude'); ?>
<h4>Exclude Specific</h4>
Here you can enter a comma-separated list of filenames or file extensions to exclude from your list. Example: 
<br />
<br />
<code>.doc, .ppt, My Unfinished Draft Essay, Embarrassing Photo Name</code> 
<br />
<br />
This will exclude all .doc and .ppt files from your list, as well as your ugly first draft and that photo of you after that party.
</div></div>
<?php ssfa_helpmodal('action'); ?>
<h4>File Type Action</h4>
If you specify any file types or file groups, the action you select here will determine whether the specified file types are prohibited, or the only permitted file types. If left blank, the default option will be permit.
</div></div>
<?php ssfa_helpmodal('filetypes'); ?>
<h4>File Types</h4>
This option takes a comma-separated list of file extensions (do not precede the extension with a period). These file types will be either permitted or prohibited, depending on the action you select. If you also specify file groups, the file types associated with the selected groups will be added to the list here.
</div></div>
<?php ssfa_helpmodal('filegroups'); ?>
<h4>File Type Groups</h4>
CTRL+Click to select multiple (or deselect) from the list of available file groups. All file types associated with the selected file groups will be either permitted or prohibited, depending on the action you select. If you also specify a list of individual file types, they will be added to the list here.<br /><br />
<?php
foreach($GLOBALS['ssfa_filegroups'] as $group => $discard):
	echo '<span style="color:red;">'.$group.':</span> ['.implode(', ', $GLOBALS['ssfa_'.$group]).']<br>';
endforeach;
?>
</div></div>
<?php ssfa_helpmodal('include'); ?>
<h4>Include Specific</h4>
This option also takes a comma-separated list of files or file extensions, but it is primarily for correcting / fine tuning. For instance, if you excluded '.doc' in the above field, you may want to include '.docx' here, so it isn't filtered out, if that's your fancy.
</div></div>
<?php ssfa_helpmodal('heading'); ?>
<h4>Heading</h4>
Optional: Give your list or table a nice title.
</div></div>
<?php ssfa_helpmodal('hcolor'); ?>
<h4>Heading Color</h4>
Defaults to random color if left blank.
</div></div>
<?php ssfa_helpmodal('width-perpx'); ?>
<h4>Width</h4>
Optional: If left blank, will default to auto-width if the type is set as 'Alphabetical List,' and to 100% if the type is set as 'Sortable Data Table.' If less than 100%, text will wrap around your list or table to the left or right, depending upon your alignment setting.
<br />
<br />
<h4>Width Type</h4>
Specify whether your width integer should be processed as a percentage or in pixels. Default: %
</div></div>
<?php ssfa_helpmodal('upwidth-perpx'); ?>
<h4>Width</h4>
Optional: If left blank, will default to 100%. If less than 100%, text will wrap around your upload form to the left or right, depending upon your alignment setting.
<br />
<br />
<h4>Width Type</h4>
Specify whether your width integer should be processed as a percentage or in pixels. Default: %
</div></div>
<?php ssfa_helpmodal('uploads'); ?>
<h4>Single or Multiple Uploads</h4>
Optional: If left blank, will default to multiple. If single is selected, a user may only upload one file at a time.
</div></div>
<?php ssfa_helpmodal('align-iconcolor'); ?>
<h4>Alignment</h4>
Defaults to 'None' if blank. Use in combination with the width setting to float your upload form to the left or right of the page, to allow other page content to wrap around it. Choose 'None' to prevent wrapping.
<br />
<br />
<h4>Icon Color</h4>
Defaults to classic if left blank.
</div></div>
<?php ssfa_helpmodal('align'); ?>
<h4>Alignment</h4>
Defaults to 'Left' if blank. Use in combination with the width setting to float your list or table to the left or right of the page, to allow other page content to wrap around it. Choose 'None' to prevent wrapping.
</div></div>
<?php ssfa_helpmodal('size'); ?>
<h4>File Size</h4>
Will show the file size by default if left blank. In tables, you'll be able to sort by file size.
</div></div>
<?php ssfa_helpmodal('align-size'); ?>
<h4>Alignment</h4>
Defaults to 'Left' if blank. Use in combination with the width setting to float your list or table to the left or right of the page, to allow other page content to wrap around it. Choose 'None' to prevent wrapping.<br /><br />
<h4>File Size</h4>
Will show the file size by default if left blank. In tables, you'll be able to sort by file size.
</div></div>
<?php ssfa_helpmodal('corners'); ?>
<h4>Corners</h4>
Defaults to all corners rounded if not used. Does not apply to the minimal-list style, or to tables.
</div></div>
<?php ssfa_helpmodal('mod'); ?>
<h4>Date Modified</h4>
If left blank, will show by default in tables, as a sortable column, and will hide by default in lists. (Note: This option is not available for Post / Page Attachments.)
</div></div>
<?php ssfa_helpmodal('bulkdownload'); ?>
<h4>Bulk Download</h4>
If enabled, users will be able to select specific files, or select all files, in a table, then click on the download button at the bottom of the table in order to download a zip file containing their selections. Note that Bulk Downloads are automatically enabled in Manager Mode, but can be enabled here for any other table type (regular, recursive, directory tree, or audio playback). 
</div></div>
<?php ssfa_helpmodal('recursive'); ?>
<h4>Recusrive Directory Iteration</h4>
If left blank, only the files in the single directory specified will be displayed. If 'Yessireee, Bob,' the files from all subdirectories will be displayed as well. If Directory Tree mode is enabled, Recursive Directory Iteration will be disabled. (Note: This option is not available for Post / Page Attachments.)
</div></div>
<?php ssfa_helpmodal('directories'); ?>
<h4>Directory Tree Mode</h4>
If left blank, your File Away table will display only the single directory specified in your Base and Sub attributes. If Directory Tree mode is enabled, the directory specified will be the starting off point, but the user will be able to navigate through any subsequent directories as well. It is recommended that you use this mode in conjunction with the File Away iFrame shortcode (see instructions under that shortcode option). (Note: This option is not available for Post / Page Attachments.)
</div></div>
<?php ssfa_helpmodal('manager'); ?>
<h4>Manager Mode</h4>
If enabled, users with access privileges will be able to manage files from the front-end. Users without access privileges will still see the table, but the management features will not be output to the page. Manager Mode currently includes the ability to rename and delete files individually, and to copy, move, and delete files in bulk.<br /><br />
If custom columns are included in the table, the Rename feature will provide additional fields for each visible custom column, and will automatically format the filename for use with File Away custom columns.<br /><br />
See the Manager Mode tab on the File Away options page to set access privileges and/or use the Manager Mode options below to fine tune privileges on a per-shortcode basis. If Manager Mode is enabled, Directory Tree Mode will also be enabled automatically. (Note: This option is not available for Post / Page Attachments.)
</div></div>
<?php ssfa_helpmodal('role_override'); ?>
<h4>Manager Mode: User Role Access Override</h4>
If the Override Password is provided in the password field, and it matches the Override Password established in the File Away Options page, then any user roles specified here (in addition to the user roles set in the permanent settings) will have Manager Mode privileges for this shortcode only. Enter a comma-separated list of user roles, like so: <code>author,subscriber,townidiot</code>.<br /><br />
Alternatively, in place of specifying actual roles, you can elect to enter the dynamic code: <code>fa-userrole</code> into the Role Access Override field. Be aware that doing this will effectively grant Manager Mode access to all logged in users. Thus, the dynamic role code should only be used on File Away tables where the directory paths are also dynamic. This will grant users access to rename, copy, move, and delete files within the confines of their of own subdirectories. <br /><br />
For your reference, a list of your site's user roles is provided in the dropdown here:
<?php
	$current_user = wp_get_current_user();
	global $wp_roles;
	$all_roles = $wp_roles->roles; 
	$editable_roles = apply_filters('editable_roles', $all_roles); 
	echo '<select style="min-width:135px;">';
	foreach($editable_roles as $role=>$theroles){echo '<option>'.$role.'</option>';}
	echo '</select>';
?>
</div></div>
<?php ssfa_helpmodal('dirman_access'); ?>
<h4>Manager Mode: Directory Management Access</h4>
If left blank, all users otherwise able to access manager mode will have the ability to create/delete/rename sub-directories of the established parent directory. If you wish to limit access to sub-directory management, include a comma-separated list of user roles here. Only those roles listed here will have access to directory management.<br /><br />
For your reference, a list of your site's user roles is provided in the dropdown here:
<?php
	$current_user = wp_get_current_user();
	global $wp_roles;
	$all_roles = $wp_roles->roles; 
	$editable_roles = apply_filters('editable_roles', $all_roles); 
	echo '<select style="min-width:135px;">';
	foreach($editable_roles as $role=>$theroles){echo '<option>'.$role.'</option>';}
	echo '</select>';
?>
</div></div>
<?php ssfa_helpmodal('user_override'); ?>
<h4>Manager Mode: User Access Override</h4>
If the Override Password is provided in the password field, and it matches the Override Password established in the File Away Options page, then any user IDs specified here (in addition to the users set in the permanent settings) will have Manager Mode privileges for this shortcode only. Enter a comma-separated list of user IDs, like so: <code>20,217,219</code>.<br /><br />
Alternatively, in place of specifying actual user IDs, you can elect to enter the dynamic code: <code>fa-userid</code> into the User Access Override field. Be aware that doing this will effectively grant Manager Mode access to all logged in users. Thus, the dynamic user ID code should only be used on File Away tables where the directory paths are also dynamic. This will grant users access to rename, copy, move, and delete files within the confines of their of own subdirectories. <br /><br />
For your reference, a list of your site's users with their respective user IDs is provided in the dropdown here:
<?php				
	$users = get_users('blog_id='.$GLOBALS['blog_id'].'&orderby=nicename');
	echo '<select style="min-width:135px;">';
	foreach($users as $user):
		echo '<option>'.$user->display_name.' ('.$user->ID.')</option>';
	endforeach;
	echo '</select>';
?>
</div></div>
<?php ssfa_helpmodal('password'); ?>
<h4>Manager Mode: Override Password</h4>
Enter the Override Password here, and if it matches the Override Password established in the File Away Options page, then any user IDs or user roles specified in the prior fields (in addition to the roles and users set in the permanent settings) will have Manager Mode privileges for this shortcode only. 
</div></div>
<?php ssfa_helpmodal('color-accent'); ?>
<h4>Link Color</h4>
The color of primary links and styles. Default for lists: Random. Default for tables: Classic.
<br />
<br />
<h4>Accent</h4>
Defaults to random if left blank.
</div></div>
<?php ssfa_helpmodal('color-iconcolor'); ?>
<h4>Link Color</h4>
The color of primary links and styles. Default for lists: Random. Default for tables: Classic.
<br />
<br />
<h4>Icon Color</h4>
Default for lists: Random. Default for tables: Classic.
</div></div>
<?php ssfa_helpmodal('icons-iconcolor'); ?>
<h4>Icons</h4>
Defaults to File Type icons if left blank.
<br />
<br />
<h4>Icon Color</h4>
Defaults to random if left blank.
</div></div>
<?php ssfa_helpmodal('display'); ?>
<h4>Display Style</h4>
Alphabetical Lists default to vertical layout by default.
</div></div>
<?php ssfa_helpmodal('debug'); ?>
<h4>Debug</h4>
If nothing is showing up on the page when you insert the shortcode, it's either because there are no files in the directory (or attached to the page) that you're pointing to, or because you've excluded anything that's in the directory (or attached to the page) that you're pointing to. Activating the debug feature will display a box in the page content that will tell you the directory or the attachment page to which your shortcode is pointing.
</div></div>
<?php ssfa_helpmodal('search-icons'); ?>
<h4>Filtering</h4>
By default, a search icon will be placed at the top-right of the table, which allows users to filter out table content to find what they're looking for. You can disable it if desired.
<br />
<br />
<h4>Icons</h4>
Defaults to File Type icons if left blank.
</div></div>
<?php ssfa_helpmodal('paginate-pagesize'); ?>
<h4>Pagination</h4>
By default, pagination on tables is disabled. Recommended only for large file directories.
<br />
<br />
<h4>Number Per Page</h4>
If pagination is on, you can set the number of files to show per page. Default is 15.
</div></div>
<?php ssfa_helpmodal('textalign'); ?>
<h4>Text Alignment</h4>
Defaults to Center. (Applies only to tables.)
</div></div>
<?php ssfa_helpmodal('customdata'); ?>
<h4>Custom Column</h4>
You can add multiple custom columns to your table and add custom data to any file you want. Name the columns here, e.g., <code>Artist</code>, then to add data to your files, just put the data in between square brackets [ ] at the *end* of your file name, *before* the extension. If you want to add more than one column, separate the column names here with a comma (e.g., <code>Artist, Album, Label, Year</code>), and separate the corresponding data in the fileneames with a comma. Example filenames: 
<br />
<br />
<code>My Funny Valentine [Chet Baker, My Funny Valentine, Blue Note, 1994].mp3</code><br />
<code>So What [Miles Davis, Kind of Blue, Columbia, 1959].mp3</code><br />
<code>Birdland [Weather Report, Heavy Weather, Columbia, 1977].mp3</code>
<br />
<br />
The data in square brackets will be automatically added to the column(s) that you create here. This feature can be used for any purpose you like.
<br />
<br />
Note that anything in square brackets will only show up in Data Tables, and, in that case, only if you name your custom column(s) here. 
</div></div>
<?php ssfa_helpmodal('postid'); ?>
<h4>Post / Page ID</h4>
If left blank, by default the shortcode will grab the attachments from the page or post where the shortcode is inserted (the current page). Alternatively, you can specify a post/page ID here, and the shortcode will grab the attachments from that one instead.
<br />
<br />
If you don't know the ID, Attach Away has added an 'ID' column to your 'All Pages' and 'All Posts' pages. <?php if (current_user_can('manage_options')){ ?>This column can be enabled or disabled in File Away > <a href="admin.php?page=file-away#options" class="feature-options" target="_blank">Feature Options</a><?php } ?>
</div></div>
<?php ssfa_helpmodal('capcolumn'); ?>
<h4>Caption Column</h4>
You can add a custom column to your table and add custom data to any attachment file you want. For this particular column, the data will be pulled from the attachment's 'Caption' field. Name the column here, anything you want, e.g., <code>Artist</code>. Then just add the specific data to the Caption field for each attachment file. Example:
<br />
<br />
<code>Caption Column Name: Artist</code><br />
<code>Attachment 1 Caption: Jon Bon Jovi</code><br />
<code>Attachment 2 Caption: Michael J. Iafrate</code>
<br />
<br />
For easy management of your attachments without leaving the page editor, File Away recommends the <a href="#" class="better-attachments" target="_blank">WP Better Attachments</a> plugin by Dan Holloran.
</div></div>
<?php ssfa_helpmodal('descolumn'); ?>
<h4>Description Column</h4>
You can add a second custom column to your table and add custom data to any attachment file you want. For this column, the data will be pulled from the attachment's 'Description' field. Name the column here, anything you want, e.g., <code>Author</code>. Then just add the specific data to the Description field for each attachment file. Example:
<br />
<br />
<code>Description Column Name: Author</code><br />
<code>Attachment 1 Description: Vaclav Havel</code><br />
<code>Attachment 2 Description: Terry Eagleton</code>
<br />
<br />
For easy management of your attachments without leaving the page editor, File Away recommends the <a href="#" class="better-attachments" target="_blank">WP Better Attachments</a> plugin by Dan Holloran.
</div></div>
<?php ssfa_helpmodal('sortfirst'); ?>
<h4>Initial Sorting</h4>
Choose the column by which to sort your table on initial page load. You can choose to sort in ascending or descending order for each column. Defaults to Filename (Asc) if left blank.
<br /><br />
Note: If you are using multiple custom columns in a [fileaway] table, and you wish to sort initially by one of those custom columns, set your Initial Sorting to either Custom Column (Asc) or Custom Column (Desc) here, then in the Custom Column Name(s) field above, put an asterisk(*) next to the name of the column by which you wish to sort initially. Don't worry. The asterisk will be removed before it gets to the page. 
</div></div>
<?php ssfa_helpmodal('nolinks'); ?>
<h4>Disable Links</h4>
Defaults to false. If Disable Links is set to 'True', the hypertext reference is removed from the &#60;a&#62; tag. This is in case you want, for instance, to display successful uploads without providing links to the files. You'll still want to style your links using the shortcode options, but the link functionality will be removed. 
</div></div>
<?php ssfa_helpmodal('showto'); ?>
<h4>Show to Roles</h4>
Takes a comma-separated list of user roles. If used, only those users with one of the user roles specified in this field will have access to the file/attachment display or file upload form. For your convenience, a list of your site's user roles is provided in the dropdown below:<br /><br />
<?php
	$current_user = wp_get_current_user();
	global $wp_roles;
	$all_roles = $wp_roles->roles; 
	$editable_roles = apply_filters('editable_roles', $all_roles); 
	echo '<select style="min-width:135px;">';
	foreach($editable_roles as $role=>$theroles){echo '<option value="'.$role.'">'.$role.'</option>';}
	echo '</select>';
?>
</div></div>
<?php ssfa_helpmodal('hidefrom'); ?>
<h4>Hide from Roles</h4>
Takes a comma-separated list of user roles. If used, those users with one of the user roles specified in this field will <em>not</em> have access to the file/attachment display or file upload form. If this attribute is used, logged-out users are also prevented from seeing the file/attachment display. For your convenience, a list of your site's user roles is provided in the dropdown below:<br /><br />
<?php
	$current_user = wp_get_current_user();
	global $wp_roles;
	$all_roles = $wp_roles->roles; 
	$editable_roles = apply_filters('editable_roles', $all_roles); 
	echo '<select style="min-width:135px;">';
	foreach($editable_roles as $role=>$theroles){echo '<option value="'.$role.'">'.$role.'</option>';}
	echo '</select>';
?>
</div></div>
<?php ssfa_helpmodal('maxsize'); ?>
<h4>Max Size and Max Size Type</h4>
The maximum allowed file size for each individual uploaded file. Enter an integer (e.g., 20), and specify MB, KB, or GB from the dropdown. If left blank, the default will be 10MB. Note that the system will also check the post_max_size and upload_max_filesize settings from your php.ini file, and if either is smaller than the size you specify here, that one will override your specification. Here are your current php.ini settings for your reference:<br /><br />
post_max_size: <?php echo ssfa_phpini('post_max_size', false, 'Not Set'); ?> <br />
upload_max_filesize: <?php echo ssfa_phpini('upload_max_filesize', false, 'Not Set'); ?>
</div></div>
<?php ssfa_helpmodal('name'); ?>
<h4>Unique Name</h4>
Required if in use with a corresponding iFrame shortcode, otherwise optional. Assign a unique name. One word, no spaces. You will assign the same unique name to the corresponding File Away iFrame shortcode. This will (1) enable the iframe to scroll to the top of the table when a new page is clicked, and (2) allow for easier reference when multiple iframed tables are on the same page.  
</div></div>
<?php ssfa_helpmodal('upname'); ?>
<h4>Unique Name</h4>
Completely optional. Assign a unique name. One word, no spaces. If no name is assigned, a random unique name will be generated on each pageload.
</div></div>
<?php ssfa_helpmodal('iname'); ?>
<h4>Unique Name</h4>
Required. Assign a unique name. One word, no spaces. You will assign the same unique name to the corresponding File Away shortcode. This will (1) enable the iframe to scroll to the top of the table when a new page is clicked, and (2) allow for easier reference when multiple iframed tables are on the same page.  
</div></div>
<?php ssfa_helpmodal('isource'); ?>
<h4>Source Slug/URL</h4>
Required. Enter the full URL, or just the page slug (like this: <code>/my-page-slug/</code>, of the iframed-templated page where you put your [fileaway] shortcode. To apply the File Away iFrame template to that page, select "File Away iFrame" from the Page Template dropdown on the WordPress page editor. 
</div></div>
<?php ssfa_helpmodal('iscroll'); ?>
<h4>Scrolling</h4>
Defaults to 'Off' if left blank. You will want to set your height attribute to a sufficient integer, and compensate by activating pagination on your [fileaway] table, and setting the pagination pagesize to a small number such as 10 or 20. 
</div></div>
<?php ssfa_helpmodal('iheight'); ?>
<h4>Height</h4>
Required. Enter an integer. The height attribute does not permit percentages. It is automatically in pixels so only the number is required. It is recommended to set it to a sufficient height such as 1000. If the height attribute is not set, well, your thing will look funny. 
</div></div>
<?php ssfa_helpmodal('iwidth'); ?>
<h4>Width</h4>
Defaults to 100% if left blank. Otherwise, specify a pixel width by entering only the number desired. E.g., 800.</div></div>
<?php ssfa_helpmodal('imheight'); ?>
<h4>Margin Height</h4>
Defaults to 0 if left blank.</div></div>
<?php ssfa_helpmodal('imwidth'); ?>
<h4>Margin Width</h4>
Defaults to 0 if left blank.</div></div>
<?php ssfa_helpmodal('drawericon'); ?>
<h4>Directory Icon</h4>
The icon used for directories in Directory Tree mode. Default: <code>Drawer</code></div></div>
<?php ssfa_helpmodal('drawerlabel'); ?>
<h4>Directory Column Label</h4>
The column heading for the Directory Names and File Names. Default: <code>File/Drawer</code></div></div>
<?php ssfa_helpmodal('excludedirs'); ?>
<h4>Exclude Directories</h4>
In addition to any permanent directory exclusions specified on the File Away Options config tab, here you can include a comma-separated list of directory names you wish to exclude from this specific Directory Tree table or Recursive table/list. Do not include the forward slashes ("/"). The names listed here must match your directory names exactly, and are case-sensitive. Example:<br /><br /> 
<code>My Private Files, Weird_Server_Directory_Name, etc.</code>
</div></div>
<?php ssfa_helpmodal('onlydirs'); ?>
<h4>Only These Directories</h4>
For your Directory Tree tables or Recursive tables/lists, here you can specify a comma-separated list of the only directory names you want to include in this table. All other sibling directories will be excluded. These directories must be found in the parent directory to which your shortcode is pointing (ie, your Base Directory and Sub Directory shortcode settings).<br /><br />
Note: If you specify a directory "My Files," any subdirectories of "My Files" will also be included. Example:<br /><br /> 
<code>My Public Files, Public Records, etc.</code>
</div></div>
<?php ssfa_helpmodal('playback'); ?>
<h4>Audio Playback</h4>
Please read these notes carefully:<br /><br />
You have two activation options: compact, and extended. Compact will put a small play/stop button in your filetype column. Extended will put a full-featured audio controller, with play/pause, draggable progress bar, track time, and volume, in your filename column.<br /><br />
The audio player is compatible with mp3, ogg, and wav. If any of those file types are found, the player will be added to the column. Note that if you have multiple types with the same filename, then only one will show in the table, and the other file types will be added to the player as fallbacks for greater cross-browser compatibility. For instance: <br /><br />
"My Song.mp3", "My Song.ogg", and "My Song.wav" will only show once on the table, but each file will be nested in the audio player as fallbacks for each other. If you only have one or two of those types in the directory, then only those found will be added to the player. One is sufficient. <br /><br />
Note that any other audio file types that have the same filename will appear as download links under the File Name in the File Name column. (See <a class="inner-link" href="https://wordpress.org/plugins/file-away/screenshots/" target="_blank">screenshots</a> for clarity.) For instance:<br /><br />
If you have "My Song.mp3", "My Song.ogg", "My Song.aiff", "My Song.rx2" in the directory, then the mp3 and ogg files will be nested in the player, and each of the four matching audio files will be given their own download link in the second column, specifying their file type. The system searches for the following file types with matching file names, and will add them automatically: <code><?php echo implode(', ', $GLOBALS['ssfa_audio']) ?></code><br /><br />
If no mp3, ogg, or wav file exists for that file name, then the files will appear in the table as any other file type, with no audio player. <br /><br />
Note that you can also place your sample/playback files (mp3, ogg, wav) in a separate directory from the downloadable files (any audio file type), and specify the playback file directory using the "playbackpath" shortcode attribute. See the info link next to "Playback Path" for more info on that.<br /><br />
Finally, note that Audio Playback mode is compatible with regular tables, Directory Tree tables, and Recursive tables, but is not compatible with Manager Mode.
</div></div>
<?php ssfa_helpmodal('onlyaudio'); ?>
<h4>Audio Files Only</h4>
Activate this option and only audio files will be shown in the table. Disabled, all otherwise-not-excluded files will be shown, but only audio files will get the playback button.
</div></div>
<?php ssfa_helpmodal('loopaudio'); ?>
<h4>Loop Audio</h4>
Activate this option to play audio files in a continuous loop.
</div></div>
<?php ssfa_helpmodal('playbackpath'); ?>
<h4>Playback Path</h4>
Optional. By default, the Playback system will search for mp3, ogg, and wav files in the directory specified by your Base Directory and Sub Directory shortcode attributes. If, however, you wish to store your playback files in a separate location from your download files, you can specify that location here. Rules:<br /><br />
Do NOT include opening and closing forward slashes. Correct: <code>Files/Audio/Samples</code>. Incorrect: <code>/Files/Audio/Samples/</code><br /><br />
Note: You must include the entire path beginning from your WordPress installation directory or site root. The Playback Path is ignorant of your specified base directory. So, let's say Base Directory 1 equals "Files":<br /><br />
<code>[fileaway base="1" sub="Audio/Downloads" playbackpath="Files/Audio/Samples" playback="yes"]</code><br /><br />
If you have Directory Tree mode or Recursive mode enabled, you will probably want to be sure that your Playback folder is not a subdirectory of your Downloads folder.<br /><br />
Finally, you can only specify one playback path for any given File Away table. It will not recurse into subdirectories looking for playback files. 
</div></div>
<?php ssfa_helpmodal('playbacklabel'); ?>
<h4>Playback Column Label</h4>
When Audio Playback is not enabled, this column heading is fixed to "Type". When Playback is enabled, you can specify a different column label if desired. E.g., "Sample"
</div></div>
<?php ssfa_helpmodal('orderby-desc'); ?>
<h4>Order By</h4>
Choose whether to order your page attachments by title, menu order, post id, date, date modified, or random.
<br />
<br />
<h4>Desc</h4>
Omit for ascending order; 'Yes' for descending order.
</div></div>
<?php ssfa_helpmodal('s2skipconfirm'); ?>
<h4>S2Members Skip Confirmation</h4>
Deactivates the javascript confirm dialogue on S2Member download links.
</div></div>
<?php ssfa_helpmodal('fixedlocation'); ?>
<h4>Upload Locations Options</h4>
If set to fixed, the only upload directory will be the path you specify with the base+sub attributes. By default, a user will be able to select subdirectories of that specified path from a dropdown.
</div></div>
<?php ssfa_helpmodal('uploadlabel'); ?>
<h4>Uploadl Label</h4>
Change the text on the upload button. 
</div></div>
<?php ssfa_helpmodal('thumbnails'); ?>
<h4>Image Thumbnails</h4>
You have two options for jpg/jpeg, gif, and png thumbnails: transient and permanent. Transient requires resources every time the page loads, as it generates a thumbnail for each image, but only temporarily. It does it all over again the next time the page loads. Permanent will create a permanent thumbnail image the first time the page loads. The next time the page loads, if that thumbnail already exists, it doesn't have to create it again. Permanent thumbnails are prefixed by <code>_thumb_wd_</code> or <code>_thumb_sq_</code>, followed by the filename.<br /><br /> 
Since transient thumbnails require more resources, there are other options to determine how to skip over images that are too large for your server to handle. See the info links for the Max Source Bytes, Max Source Width, and Max Source Height options that will appear below when the Transient option is selected. 
</div></div>
<?php ssfa_helpmodal('thumbstyle'); ?>
<h4>Thumbnail Style</h4>
The cropped dimensions and aesthetics of your generated thumbnails. The dimensions (wide/oval, square/circle) are fed into the server-side script that generates the thumbnails. The sharp/rounded specification is handled by the CSS on the client-side. 
</div></div>
<?php ssfa_helpmodal('graythumbs'); ?>
<h4>Thumbnail Grayscale Filter</h4>
If set to Grayscale, the css will apply a grayscale filter to your thumbnails for all browsers that can handle it. 
</div></div>
<?php ssfa_helpmodal('maxsrcbytes'); ?>
<h4>Max Image Source Size in Bytes</h4>
Default: <code>1887436.8</code> (i.e., 1.8M)<br /><br />
If the pixel dimensions and/or filesize of your image are too large for your server to handle, the script will fail and return a broken image graphic in place of your thumbnail. To prevent this, we set the maximum size in bytes, maximum width in pixels, and maximum height in pixels, of the source image. If the source image is greater than any one of these, the filetype icon will be output instead of attempting to generate a thumbnail. 
<br /><br />Tweak these three settings to suit your server and find the right balance. Find the lowest threshold for an image where the server can easily handle generating the thumbnail, and set it there. <br /><br />You can also adjust your <code>memory_limit</code> setting in your php.ini file, but be very careful about making this limit too large, which might create other problems for you.  
</div></div>
<?php ssfa_helpmodal('maxsrcwidth'); ?>
<h4>Max Image Source Width in Pixels</h4>
Default: <code>3000</code><br /><br />
If the pixel dimensions and/or filesize of your image are too large for your server to handle, the script will fail and return a broken image graphic in place of your thumbnail. To prevent this, we set the maximum size in bytes, maximum width in pixels, and maximum height in pixels, of the source image. If the source image is greater than any one of these, the filetype icon will be output instead of attempting to generate a thumbnail. 
<br /><br />Tweak these three settings to suit your server and find the right balance. Find the lowest threshold for an image where the server can easily handle generating the thumbnail, and set it there. <br /><br />You can also adjust your <code>memory_limit</code> setting in your php.ini file, but be very careful about making this limit too large, which might create other problems for you.  
</div></div>
<?php ssfa_helpmodal('maxsrcheight'); ?>
<h4>Max Image Source Height in Pixels</h4>
Default: <code>2500</code><br /><br />
If the pixel dimensions and/or filesize of your image are too large for your server to handle, the script will fail and return a broken image graphic in place of your thumbnail. To prevent this, we set the maximum size in bytes, maximum width in pixels, and maximum height in pixels, of the source image. If the source image is greater than any one of these, the filetype icon will be output instead of attempting to generate a thumbnail. 
<br /><br />Tweak these three settings to suit your server and find the right balance. Find the lowest threshold for an image where the server can easily handle generating the thumbnail, and set it there. <br /><br />You can also adjust your <code>memory_limit</code> setting in your php.ini file, but be very careful about making this limit too large, which might create other problems for you.  
</div></div>
<br />
</td>
</tr>
</table>
</div>