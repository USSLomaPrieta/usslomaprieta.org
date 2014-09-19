<div id="featCategories">
<?php
if(wpthemes_options('home_cat1') != '' && wpthemes_options('home_cat1_num') > 0 && wpthemes_options('home_cat1') <> 'none') {
?>
<?php $cat = get_category(wpthemes_options('home_cat1')); ?>
<?php $recent = new WP_Query("cat=".wpthemes_options('home_cat1')."&showposts=".wpthemes_options('home_cat1_num'));?>
        <div class="category clearfix">
			  <div class="home-title"><a href="<?php echo get_category_link(wpthemes_options('home_cat1')); ?>" rel="bookmark"><?php echo wpthemes_options('home_cat1_text'); ?></a></div>
              <?php if (have_posts()) : ?>
				<?php while($recent->have_posts()) : $recent->the_post(); ?>
			  <div class="post span-6">
				<div class="entry clearfix">
					<?php if ( version_compare( $wp_version, '2.9', '>=' ) ) : ?>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>
                        	<?php the_post_thumbnail(array(90,90), array("class" => "alignleft-img post_thumbnail")); ?>
                        <?php else : ?>
                        	<img class="alignleft-img post_thumbnail" width="90" src="<?php bloginfo('template_url'); ?>/images/no_image.gif" />
                        <?php endif; ?>
                    <?php else : ?>
       					<?php if ( get_post_meta($post->ID, 'featured', true) ) : ?> 
       						<?php $image = get_post_meta($post->ID, 'featured', true); echo "<img class=\"alignleft-img post_thumbnail\" width=\"100\" src=" . $image . " />"; ?>
                        <?php else : ?>
                        	<img class="alignleft-img post_thumbnail notavailable" width="100" src="<?php bloginfo('template_url'); ?>/images/no_image.gif" />
       					<?php endif; ?>
                    <?php endif; ?>
				<h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php echo csubstr(the_title('','',0), 26); ?></a></h2>
				<?php wpthemes_post_content(60, 1, '[...]'); ?></div>
			  </div>
			  <?php endwhile; ?>
              <?php else : ?>
				<div class="notfound"><p>Content Not Found!</p><p>Please try again.</p></div>
			<?php endif; ?>
			  </div>

<?php } ?>


<?php
if(wpthemes_options('home_cat2') != '' && wpthemes_options('home_cat2_num') > 0 && wpthemes_options('home_cat2') <> 'none') {
?>
<?php $cat = get_category(wpthemes_options('home_cat2')); ?>
<?php $recent = new WP_Query("cat=".wpthemes_options('home_cat2')."&showposts=".wpthemes_options('home_cat2_num'));?>
<div class="category clearfix">
			  <div class="home-title"><a href="<?php echo get_category_link(wpthemes_options('home_cat2')); ?>" rel="bookmark"><?php echo wpthemes_options('home_cat2_text'); ?></a></div>
              <?php if (have_posts()) : ?>
				<?php while($recent->have_posts()) : $recent->the_post(); ?>
			  <div class="post span-6">
				<div class="entry clearfix">
					<?php if ( version_compare( $wp_version, '2.9', '>=' ) ) : ?>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>
                        	<?php the_post_thumbnail(array(90,90), array("class" => "alignleft-img post_thumbnail")); ?>
                        <?php else : ?>
                        	<img class="alignleft-img post_thumbnail" width="90" src="<?php bloginfo('template_url'); ?>/images/no_image.gif" />
                        <?php endif; ?>
                    <?php else : ?>
       					<?php if ( get_post_meta($post->ID, 'featured', true) ) : ?> 
       						<?php $image = get_post_meta($post->ID, 'featured', true); echo "<img class=\"alignleft-img post_thumbnail\" width=\"100\" src=" . $image . " />"; ?>
                        <?php else : ?>
                        	<img class="alignleft-img post_thumbnail notavailable" width="100" src="<?php bloginfo('template_url'); ?>/images/no_image.gif" />
       					<?php endif; ?>
                    <?php endif; ?>
				<h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php echo csubstr(the_title('','',0), 26); ?></a></h2>
				<?php wpthemes_post_content(60, 1, '[...]'); ?></div>
			  </div>
			  <?php endwhile; ?>
			<?php else : ?>
				<div class="notfound"><p>Content Not Found!</p><p>Please try again.</p></div>
			<?php endif; ?>
			  </div>

<?php } ?>

<?php
if(wpthemes_options('home_cat3') != '' && wpthemes_options('home_cat3_num') > 0 && wpthemes_options('home_cat3') <> 'none') {
?>
<?php $cat = get_category(wpthemes_options('home_cat3')); ?>
<?php $recent = new WP_Query("cat=".wpthemes_options('home_cat3')."&showposts=".wpthemes_options('home_cat3_num'));?>
<div class="category clearfix">
			  <div class="home-title"><a href="<?php echo get_category_link(wpthemes_options('home_cat3')); ?>" rel="bookmark"><?php echo wpthemes_options('home_cat3_text'); ?></a></div>
              <?php if (have_posts()) : ?>
				<?php while($recent->have_posts()) : $recent->the_post(); ?>
			  <div class="post span-6">
				<div class="entry clearfix">
					<?php if ( version_compare( $wp_version, '2.9', '>=' ) ) : ?>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>
                        	<?php the_post_thumbnail(array(90,90), array("class" => "alignleft-img post_thumbnail")); ?>
                        <?php else : ?>
                        	<img class="alignleft-img post_thumbnail" width="90" src="<?php bloginfo('template_url'); ?>/images/no_image.gif" />
                        <?php endif; ?>
                    <?php else : ?>
       					<?php if ( get_post_meta($post->ID, 'featured', true) ) : ?> 
       						<?php $image = get_post_meta($post->ID, 'featured', true); echo "<img class=\"alignleft-img post_thumbnail\" width=\"100\" src=" . $image . " />"; ?>
                        <?php else : ?>
                        	<img class="alignleft-img post_thumbnail notavailable" width="100" src="<?php bloginfo('template_url'); ?>/images/no_image.gif" />
       					<?php endif; ?>
                    <?php endif; ?>
				<h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php echo csubstr(the_title('','',0), 26); ?></a></h2>
				<?php wpthemes_post_content(60, 1, '[...]'); ?></div>
			  </div>
			  <?php endwhile; ?>
			<?php else : ?>
				<div class="notfound"><p>Content Not Found!</p><p>Please try again.</p></div>
			<?php endif; ?>
			  </div>

<?php } ?>

</div>