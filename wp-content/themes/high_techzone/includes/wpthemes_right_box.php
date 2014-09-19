<?php
if (!is_admin()) add_action( 'wp_print_scripts', 'wpthemes_add_javascript' );
function wpthemes_add_javascript() {
wp_enqueue_script('jquery');
wp_enqueue_script('wpthemes_box', get_bloginfo('template_directory').'/includes/js/wpthemes_box.js', array( 'jquery' ) );
}
?>