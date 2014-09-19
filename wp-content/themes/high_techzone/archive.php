<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
wp_get_header();
?>
			<div id="content" class="span-13">
            	<div class="content-box clearfix">
					<?php if (have_posts()) : ?>
                    	<p class="my_path"><strong>You are here:</strong> <a href="<?php echo get_option('home'); ?>/" title="Home"><?php bloginfo('name'); ?></a> &raquo; <?php /* If this is a category archive */ if (is_category()) { ?>
		Archive for the &#8216;<span class="my_path_sp"><?php single_cat_title(); ?></span>&#8217; Category
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		Posts Tagged &#8216;<span class="my_path_sp"><?php single_tag_title(); ?></span>&#8217;
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		Archive for <span class="my_path_sp"><?php the_time('F jS, Y'); ?></span>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		Archive for <span class="my_path_sp"><?php the_time('F, Y'); ?></span>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		Archive for <span class="my_path_sp"><?php the_time('Y'); ?></span>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		Author Archive
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		Blog Archives
 	  <?php } ?></p>
						<?php while (have_posts()) : the_post(); ?>
                        	<?php if ( version_compare( $wp_version, '2.7', '>=' ) ) { ?>
								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php } else { ?>
								<div id="post-<?php the_ID(); ?>" class="post post-<?php the_ID(); ?>">
							<?php } ?>
							<h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<div class="postmetadata"><span class="post_date ico"><?php the_time('F jS, Y') ?></span>, <span class="post_author ico"><?php the_author() ?></span><?php if (current_user_can('edit_post', $post->ID)) { ?>, <span class="post_edit ico"><?php edit_post_link('Edit', '', ''); } ?></span></div>
							<div class="entry clearfix">
                            	<?php include(TEMPLATEPATH . '/thumbnail.php'); ?>
                                <?php the_excerpt() ?>
							</div>
							<div class="postmetadata"><span class="post_cat ico">Posted in <?php the_category(', ') ?></span><?php if(get_the_tags()) { ?>, <span class="post_tags ico"><?php  the_tags('Tags: ', ', '); } ?></span>, <span class="post_comments ico"><?php comments_popup_link('No Comments &#187;', '<srong>1</strong> Comment &#187;', '<strong>%</strong> Comments &#187;'); ?></span></div>
						</div>
				
				<?php endwhile; ?>
                <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
					<div class="wp-pagenavi">
					<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
					<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
					</div>
				<?php } ?>
                <?php else : ?>
					<div class="notfound"><p>Content Not Found!</p><p>Please try again.</p></div>
				<?php endif; ?>
                </div>
			</div>
            <?php get_sidebars(); ?>
<?php wp_get_footer(); ?>
