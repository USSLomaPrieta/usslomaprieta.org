<?php if ( version_compare( $wp_version, '2.9', '>=' ) ) {
  if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) { the_post_thumbnail(array(200,150), array("class" => "alignleft-img post_thumbnail")); }
  } else {
  if ( get_post_meta($post->ID, 'featured', true) ) { $image = get_post_meta($post->ID, 'featured', true); echo "<img class=\"alignleft-img post_thumbnail\" width=\"200\" src=" . $image . " />"; }
  }
?>