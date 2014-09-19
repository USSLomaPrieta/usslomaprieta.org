<?php
if(wpthemes_options('top_gallery_posts') != '') {
?>
<!-- Initialization of SmoothGallery-->
<script type="text/javascript">
	function startGallery() {
		var myGallery = new gallery($('myGallery'), {
			timed: true,
			delay: 6000,
			slideInfoZoneOpacity: 0.8,
			showCarousel: false 
		});
	}
	window.addEvent('domready', startGallery);
</script>
<div class="fullbox_excerpt">
	<div class="fullbox_content">
		<div class="smooth_gallery">
			<div id="myGallery">
				
				
				<?php if(wpthemes_options('top_gallery_category') == '0' || wpthemes_options('top_gallery_category') == '' ) { ?>
	<?php  
	global $post, $wp_version;
	$postslist = query_posts("showposts=5");
	$num = 1;
	foreach ($postslist as $post) :       
	setup_postdata($post);  
		$gallery_data['src' . $num] = $gallery_img_src[0];
		$gallery_data['src_thumb' . $num] = $gallery_img_thumb_src[0];
		$gallery_data['title' . $num] = get_the_title();
		$gallery_data['permalink' . $num] = get_permalink();
		$gallery_data['category' . $num] = get_the_category();
		$gallery_data['content' . $num] = wpthemes_post_content(180, 1, "", 0);
	$num++;
	endforeach; ?>
	<?php $num=1; while($num <= 5) { ?>
							<div class="imageElement" style="display: none;">
								<h3><?php echo csubstr($gallery_data['title' . $num], 70); ?></h3>
								<p>
								<em>Posted by <?php the_author(); ?> on <?php the_time('F jS, Y'); ?></em><br />
								<?php echo $gallery_data['content' . $num]; ?>
								</p>
								<a class="open" href="<?php echo $gallery_data['permalink' . $num]; ?>" title="<?php echo $gallery_data['title' . $num]; ?>"></a>
								<img class="full" src="<?php bloginfo('template_url'); ?>/jdgallery/slides/<?php echo $num; ?>.jpg" title="#htmlcaption<?php echo $num; ?>" <?php if ($num>1) echo 'style="display:none"'; ?> />
							</div>
						<?php $num++; } ?>
						
	<?php } else { 
	global $post, $wp_version, $num_sum, $gallery_data;
	$num = 1;
	$num_sum = wpthemes_options('featured_num');
	$gallery_category = wpthemes_options('top_gallery_category');
	$top_gallery_posts = query_posts("showposts=$num_sum&cat=$gallery_category");
	foreach($top_gallery_posts as $post) {
		if ( has_post_thumbnail($thumbnail->ID)) {
			setup_postdata($post);
			if ( version_compare( $wp_version, '2.9', '>=' ) ) {
				$gallery_img = get_the_post_thumbnail($post->ID,'large', array('class' => 'full'));
				$gallery_thumb_img = get_the_post_thumbnail($post->ID,'thumbnail');
				$gallery_img_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
				$gallery_img_thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
			} else {                         
				$gallery_img_src = get_post_meta($post->ID, 'featured', true);
				$gallery_img_thumb_src = get_post_meta($post->ID, 'featured', true);
				$gallery_img = '<img src="$gallery_img_src" class="full" />';
				$gallery_thumb_img = '<img src="$gallery_img_src" class="post_thumbnail" />';
			}
		}
		$gallery_data['src' . $num] = $gallery_img_src[0];
		$gallery_data['src_thumb' . $num] = $gallery_img_thumb_src[0];
		$gallery_data['title' . $num] = get_the_title();
		$gallery_data['permalink' . $num] = get_permalink();
		$gallery_data['category' . $num] = get_the_category();
		$gallery_data['content' . $num] = wpthemes_post_content(180, 1, "", 0);
		$num++;
	} ?>
		<?php $num=1; while($num <= $num_sum) { ?>
					  <div class="imageElement" style="display: none;">
							<h3><?php echo csubstr($gallery_data['title' . $num], 60); ?></h3>
							<p>
							<em>Posted by <?php the_author(); ?> on <?php the_time('F jS, Y'); ?></em><br />
							<?php echo $gallery_data['content' . $num]; ?>
							</p>
							<a class="open" href="<?php echo $gallery_data['permalink' . $num]; ?>" title="<?php echo $gallery_data['title' . $num]; ?>"></a>
							<img class="full" src="<?php echo $gallery_data['src' . $num]; ?>" title="#htmlcaption<?php echo $num; ?>" <?php if ($num>1) echo 'style="display:none"'; ?> />
							
						</div>
		<?php $num++; } ?>
		<?php } ?>
			</div>
			
		</div>
	</div>
</div>
<?php } ?>
<?php wp_reset_query();?>