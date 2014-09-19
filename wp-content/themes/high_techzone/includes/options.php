<?php 

$this_wptheme_name = "High-techzone";
$theme_options_prefix = str_replace(' ', '_', strtolower($this_wptheme_name));


/* -------------------------------------------------
   Regster Multiple Sidebar
----------------------------------------------------*/
if (function_exists('register_sidebar'))
{
	register_sidebar(
		array(
			'name'          => 'Left Sidebar',
	        'before_widget' => '<li>',
    	    'after_widget'  => '</li>',
        	'before_title'  => '<h2>',
        	'after_title'   => '</h2>'
		)
	);
	register_sidebar(
		array(
			'name'          => 'Right Sidebar',
	        'before_widget' => '<li>',
    	    'after_widget'  => '</li>',
        	'before_title'  => '<h2>',
        	'after_title'   => '</h2>'
		)
	);
}
?>
<?php
    if ( function_exists( 'register_nav_menus' ) ) {
    	register_nav_menus(
    		array(
    		  'menu_1' => 'Menu 1',
    		  'menu_2' => 'Menu 2'
    		)
    	);
    }
?>