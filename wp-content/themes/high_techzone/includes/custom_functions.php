<?php

include(TEMPLATEPATH . '/includes/widgets/' . 'widget-flickr.php');
include(TEMPLATEPATH . '/includes/widgets/' . 'widget-twitter.php');
require_once (TEMPLATEPATH . '/includes/' . 'layout.php');
require_once (TEMPLATEPATH . '/includes/' . 'set_value.php');

/* -------------------------------------------------
    Recent Comments
----------------------------------------------------*/
function get_recent_comments($args) {
	global $wpdb, $comments, $comment;
	extract($args, EXTR_SKIP);

	$themePath = get_bloginfo('template_url');
	$imageLink = '<h2>Recent Comments</h2>';

	$options = get_option('widget_recent_comments');
	$title = empty($options['title']) ? __($imageLink) : apply_filters('widget_title', $options['title']);
	if ( $number < 1 )
		$number = 1;
	else if ( $number > 15 )
		$number = 15;
	if ( !$format )
		$format = '%2$s';
	if ( !$comments = wp_cache_get( 'recent_comments', 'widget' ) ) {
		$comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' ORDER BY comment_date_gmt DESC LIMIT $number");
		wp_cache_add( 'recent_comments', $comments, 'widget' );
	}

		 echo $before_widget;
			echo $before_title . $title . $after_title;
			echo '<ul id="recentcomments">';
			if ( $comments ) : foreach ( (array) $comments as $comment) :
			echo  '<li class="recentcomments">' . sprintf(__($format), get_comment_author_link(), '<a href="'. get_comment_link($comment->comment_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
			endforeach; endif;
		echo '</ul>';
		echo $after_widget; 

}


/* -------------------------------------------------
    Recent Comments - Thumbnail
----------------------------------------------------*/
function get_recent_comments_thumb($args) {
	global $wpdb, $comments, $comment, $wp_version;
	extract($args, EXTR_SKIP);

	$themePath = get_bloginfo('template_url');
	$imageLink = '<h2>Recent Comments</h2>';
	

	$options = get_option('widget_recent_comments');
	$title = empty($options['title']) ? __($imageLink) : apply_filters('widget_title', $options['title']);
	if ( $number < 1 )
		$number = 1;
	else if ( $number > 15 )
		$number = 15;
	if ( !$format )
		$format = '%2$s';
	if ( !$comments = wp_cache_get( 'recent_comments', 'widget' ) ) {
		$comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' ORDER BY comment_date_gmt DESC LIMIT $number");
		wp_cache_add( 'recent_comments', $comments, 'widget' );
	}

		 echo $before_widget;
			echo $before_title . $title . $after_title;
			if ( $comments ) : foreach ( (array) $comments as $comment) :
			if ( $thumb_img == 1 ) {
				if ( has_post_thumbnail($comment->comment_post_ID)) {
					setup_postdata($comment);
					if ( version_compare( $wp_version, '2.9', '>=' ) ) {
						$gallery_img = get_the_post_thumbnail($comment->comment_post_ID,'homepage-thumb', array('class' => 'thumbnail'));
						$gallery_thumb_img = get_the_post_thumbnail($comment->comment_post_ID,array(70,40));
					} else {                         
						$gallery_img_src = get_post_meta($comment->comment_post_ID, 'featured', true);
						$gallery_img = '<img src="'.$gallery_img_src.'" class="thumbnail" />';
					}
				} else {
					$gallery_img = '<img src="'.get_bloginfo('template_url').'/images/no_image.gif" class="thumbnail" />';
				}
			} else {
				$gallery_img = '';
			}
			echo '<div class="sidebar_post"><div class="entry"><a href="'. get_comment_link($comment->comment_ID) . '">'.$gallery_img.'</a><dl id="recentcomments">';
			echo '<dt>' . sprintf(__('%1$s'), get_comment_author_link(), '</dt>');
			echo  '<dd class="recentcomments">' . sprintf(__('%2$s'), get_comment_author_link(), '<a href="'. get_comment_link($comment->comment_ID) . '">' . csubstr(get_the_title($comment->comment_post_ID), 40) . '</a>') . '</dd>';
			echo '</dl></div></div>';
			endforeach; endif;
		echo $after_widget; 

}


/* -------------------------------------------------
   Activation Thumbnail Set
----------------------------------------------------*/

if ( function_exists("add_theme_support") ) {
	add_theme_support("post-thumbnails");
	add_image_size( 'homepage-thumb', 75, 55, true );
}


/* -------------------------------------------------
    Twitter
----------------------------------------------------*/

if ( !function_exists( 'my_twitter_script') ) {
	function my_twitter_script($unique_id,$username,$limit) {
	?>
	<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	
	    function twitterCallback2(twitters) {
	    
	      var statusHTML = [];
	      for (var i=0; i<twitters.length; i++){
	        var username = twitters[i].user.screen_name;
	        var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
	          return '<a href="'+url+'">'+url+'</a>';
	        }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
	          return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
	        });
	        statusHTML.push( '<li><span class="content">'+status+'</span> <a style="font-size:85%" class="time" href="http://twitter.com/'+username+'/statuses/'+twitters[i].id_str+'">'+relative_time(twitters[i].created_at)+'</a></li>' );
	      }
	      document.getElementById( 'twitter_update_list_<?php echo $unique_id; ?>').innerHTML = statusHTML.join( '' );
	    }
	    
	    function relative_time(time_value) {
	      var values = time_value.split( " " );
	      time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
	      var parsed_date = Date.parse(time_value);
	      var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
	      var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
	      delta = delta + (relative_to.getTimezoneOffset() * 60);
	    
	      if (delta < 60) {
	        return 'less than a minute ago';
	      } else if(delta < 120) {
	        return 'about a minute ago';
	      } else if(delta < (60*60)) {
	        return (parseInt(delta / 60)).toString() + ' minutes ago';
	      } else if(delta < (120*60)) {
	        return 'about an hour ago';
	      } else if(delta < (24*60*60)) {
	        return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
	      } else if(delta < (48*60*60)) {
	        return '1 day ago';
	      } else {
	        return (parseInt(delta / 86400)).toString() + ' days ago';
	      }
	    }
	//-->!]]>
	</script>
	<script type="text/javascript" src="http://api.twitter.com/1/statuses/user_timeline/<?php echo $username; ?>.json?callback=twitterCallback2&amp;count=<?php echo $limit; ?>&amp;include_rts=t"></script>
	<?php
	}
}

?>