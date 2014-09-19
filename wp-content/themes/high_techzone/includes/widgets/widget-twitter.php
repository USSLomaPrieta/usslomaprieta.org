<?php
/*---------------------------------------------------------------------------------*/
/* Twitter widget */
/*---------------------------------------------------------------------------------*/
class my_Twitter extends WP_Widget {

   function my_Twitter() {
	   $widget_ops = array( 'description' => 'Add your Twitter feed to your sidebar with this widget.' );parent::WP_Widget(false, __( 'WPThemepremium - Twitter Stream', 'WPThemepremium' ),$widget_ops);      
   }
   
   function widget($args, $instance) {  
    extract( $args );
   	$title = $instance['title'];
	$type = $instance['type'];
	$show = $cur_instance['show'];
    $limit = $instance['limit']; if (!$limit) $limit = 5;
	$username = $instance['username'];
	$unique_id = $args['widget_id'];
	?>
		<?php echo $before_widget; ?> <?php if ($title) echo $before_title . $title . $after_title; else { ?> <h3 class="tlogo"><img src="<?php bloginfo( 'template_directory' ); ?>/images/twitter.png" /></h3>
		<?php } ?>         <div class="twitter_back"><ul id="twitter_update_list_<?php echo $unique_id; ?>"><li></li></ul> <p class="follow_twitter"><?php _e( 'Follow', 'WPThemepremium' ); ?> <a href="http://twitter.com/<?php echo $username; ?>"><strong>@<?php echo $username; ?></strong></a> <?php _e( 'on Twitter', 'WPThemepremium' ); ?></p></div><div class="clear"></div> <?php echo my_twitter_script($unique_id,$username,$limit); //Javascript output function ?>	  <?php echo $after_widget; ?> 
   		
	<?php
   }

   function update($new_instance, $old_instance) {
   		return $new_instance;
   }

   function form($instance) {        
   $title = esc_attr($instance['title']);$limit = esc_attr($instance['limit']);
	   $username = esc_attr($instance['username']);?><p>
	   	   <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (optional):', 'WPThemepremium' ); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>"  value="<?php if ($title == '') { echo wpthemes_options('twitter_text'); } else { echo $title; } ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" /></p><p>
	   	   <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username:', 'WPThemepremium' ); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name( 'username' ); ?>"  value="<?php if ($username == '') { echo wpthemes_options('twitter_account'); } else { echo $username; } ?>" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" /></p><p>
	   	   <label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:', 'WPThemepremium' ); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name( 'limit' ); ?>"  value="<?php echo $limit; ?>" class="" size="3" id="<?php echo $this->get_field_id( 'limit' ); ?>" />
</p>
      <?php }
} 
register_widget( 'my_Twitter' );
?>