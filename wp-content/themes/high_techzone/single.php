<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
wp_get_header();
?>
<?php get_sidebars(); ?>
			<div id="content" class="span-13">
            	<div class="content-box clearfix">
					<?php if (have_posts()) : ?>	
						<?php while (have_posts()) : the_post(); ?>
						<?php if ( version_compare( $wp_version, '2.7', '>=' ) ) { ?>
								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php } else { ?>
								<div id="post-<?php the_ID(); ?>" class="post post-<?php the_ID(); ?>">
							<?php } ?>
							<h1 class="title"><?php the_title(); ?></h1>
							<div class="postmetadata"><span class="post_date ico"><?php the_time('F jS, Y') ?></span>, <span class="post_author ico"><?php the_author() ?></span><?php if (current_user_can('edit_post', $post->ID)) { ?>, <span class="post_edit ico"><?php edit_post_link('Edit', '', ''); } ?></span></div>
							<div class="entry clearfix">
								<?php the_content(); ?>
								<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
							</div>
							<div class="postmetadata"><span class="post_cat ico">Posted in <?php the_category(', ') ?></span><?php if(get_the_tags()) { ?>, <span class="post_tags ico"><?php  the_tags('Tags: ', ', '); } ?></span></div>
							<div class="post_nav clearfix">
								<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
								<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
							</div>
						</div>
				<?php endwhile; ?>
				<?php 
					if (function_exists('wp_list_comments')) {
						comments_template('/comments.php', true);
					}
					else {
						comments_template('/comments-old.php');
					}
					?>
				<?php endif; ?>
                </div>
			</div>
<?php wp_get_footer(); ?>
