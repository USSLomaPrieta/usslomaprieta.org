<?php
/*-----------------------------------------------------------------------------------*/
/*	Flickr widget Setup
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'my_flickr_widgets' );
function my_flickr_widgets() {
	register_widget( 'my_FLICKR_Widget' );
}
class my_flickr_widget extends WP_Widget {

function my_flickr_join() {

	$widget_tip = array('classname' => 'my_tip_name','my_tip_intro' => __('tips', 'intro'));
	$widget_styles = array('position' => 'absolute','left' => 10,'top' => 20);
}

	
function my_FLICKR_Widget() {

	$widget_style = array('classname' => 'my_flickr_widget','description' => __('A widget that displays your Flickr photos.', 'framework'));
	$widget_define = array('show_id' => 'single_flickr','get_tips' => 'true','get_title' => 'true');
	$control_styles = array('width' => 300,'height' => 350,'id_base' => 'my_flickr_widget');
	$widget_change = array('change1' => 'delay','change2' => 'effect','change3' => 'slide','change4' => 100,'change5' => 0);
	$this->WP_Widget( 'my_flickr_widget', __('WPThemepremium - Flickr Photos', 'framework'), $widget_style, $control_styles );
	
}

	
function widget( $args, $cur_instance ) {
	extract( $args );
	
	$title = apply_filters('widget_title', $cur_instance['title'] );
	$flickrID = $cur_instance['flickrID'];
	$postcount = $cur_instance['postcount'];
	$type = $cur_instance['type'];
	$display = $cur_instance['display'];

	echo $before_widget;

	if ( $title )echo $before_title . $title . $after_title;echo '<div class="flickr">';

	 ?>
	<div class="flickr_badge_wrapper">
	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $postcount ?>&amp;display=<?php echo $display ?>&amp;size=s&amp;layout=v&amp;source=<?php echo $type ?>&amp;<?php echo $type ?>=<?php echo $flickrID ?>"></script>
	</div>
	
	<?php echo '</div>'; ?>


<?php echo $after_widget;
	
}
	
function update( $new_instance, $org_instance ) {
	$cur_instance = $org_instance;

	$cur_instance['title'] = strip_tags( $new_instance['title'] );
	$cur_instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
	$cur_instance['show'] = $new_instance['slide'];
	$cur_instance['postcount'] = $new_instance['postcount'];
	$cur_instance['type'] = $new_instance['type'];
	$cur_instance['inline'] = $new_instance['true'];
	$cur_instance['display'] = $new_instance['display'];

	return $cur_instance;
}
	 
function form( $cur_instance ) {

	$defaults = array('title' => 'From Flickr','flickrID' => '65961696@N02','postcount' => '9','type' => 'user','display' => 'latest',);
	
	$cur_instance = wp_parse_args( (array) $cur_instance, $defaults ); ?>

	<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label><input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $cur_instance['title']; ?>" />
	</p>

	<p><label for="<?php echo $this->get_field_id( 'flickrID' ); ?>"><?php _e('Flickr ID:', 'framework') ?> (<a href="http://idgettr.com/">idGettr</a>)</label><input type="text" class="widefat" id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $cur_instance['flickrID']; ?>" />
	</p>
	
	<p><label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of Photos:', 'framework') ?></label>
	<select id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" class="widefat">
		<option <?php if ( '3' == $cur_instance['postcount'] ) echo 'selected="selected"'; ?>>3</option>
		<option <?php if ( '6' == $cur_instance['postcount'] ) echo 'selected="selected"'; ?>>6</option>
		<option <?php if ( '9' == $cur_instance['postcount'] ) echo 'selected="selected"'; ?>>9</option>
	</select>
		
	</p>
	
	<p><label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Type (user or group):', 'framework') ?></label><select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">	<option <?php if ( 'user' == $cur_instance['type'] ) echo 'selected="selected"'; ?>>user</option>	<option <?php if ( 'group' == $cur_instance['type'] ) echo 'selected="selected"'; ?>>group</option></select>
	</p>
	
	<p><label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('Display (random or latest):', 'framework') ?></label><select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">	<option <?php if ( 'random' == $cur_instance['display'] ) echo 'selected="selected"'; ?>>random</option>	<option <?php if ( 'latest' == $cur_instance['display'] ) echo 'selected="selected"'; ?>>latest</option></select>
	</p>
	<?php
	}
}
?>