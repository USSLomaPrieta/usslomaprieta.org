<?php
defined('SSFA_FILE') or die("Shirley, you can't be serious.");
$type = 'table'; 
$recursive = false;
$basecheck = trim("$dir",'/');
if(strpos("$basecheck", '/') !== false):
	$subbase = strrchr("$basecheck", "/"); 
	$basebase = str_replace("$subbase", '', "$basecheck"); 
else: 
	$basebase = "$basecheck";
	$subbase = "$basebase";
endif;
if(isset($_REQUEST['drawer'])): 
	$rawdrawer = $_GET['drawer'];
	$aposdrawer = stripslashes("$rawdrawer");
	if($aposdrawer === "/") $aposdrawer = trim($start, '/');
	$dir = "$basebase"."/"."$aposdrawer"; 
	$dir = str_replace('*', '/', "$dir");
	if ($rawdrawer === '') $dir = "$start";
	if (!is_dir("$dir")) $dir = "$start";
	if (strpos("$dir", '..') !== false) $dir = "$start";
endif;
if($private_content):
	if($fa_firstlast_used && stripos("$dir", "$fa_firstlast") === false) $dir = "$start"; 
	if($fa_userid_used && strpos("$dir", "$fa_userid") === false) $dir = "$start";
	if($fa_username_used && stripos("$dir", "$fa_username") === false) $dir = "$start"; 
	if($fa_userrole_used && stripos("$dir", "$fa_userrole") === false) $dir = "$start"; 
endif; 
$baselessdir = ssfa_replace_first("$basebase", '', "$dir");
if ($basebase !== $basecheck) $crumbs = explode('/', ltrim("$baselessdir", '/'));
else $crumbs = explode('/', trim("$dir", '/'));		
$crumblink = array();
if (!$heading) $addclass = '-noheading';
$thefiles .= "<div class='ssfa-crumbs$addclass'>";
foreach ($crumbs as $k => $crumb):
	$prettycrumb = str_replace(array('~', '--', '_', '.', '*'), ' ', $crumb); 
	$prettycrumb = preg_replace('/(?<=\D)-(?=\D)/', ' ', $prettycrumb);
	$prettycrumb = preg_replace('/(?<=\d)-(?=\D)/', ' ', $prettycrumb);
	$prettycrumb = preg_replace('/(?<=\D)-(?=\d)/', ' ', $prettycrumb);
	$prettycrumb = ssfa_strtotitle($prettycrumb);
	if($crumb !== ''):
		$i = 0; while ($i <= $k): if ($i == 0) $comma = null; else $comma ="*"; $crumblink[$k] .= $comma."$crumbs[$i]"; $i++; endwhile;
		if ($basebase === $basecheck): $crumblink[$k] = ltrim(ssfa_replace_first("$basebase", '', "$crumblink[$k]"), '*'); endif;
		$thefiles .= '<a href="'.add_query_arg( array( 'drawer' => $crumblink[$k] ), get_permalink()).'">'."$prettycrumb".'</a> / ';
	endif;
endforeach;
$thefiles .= "</div>";