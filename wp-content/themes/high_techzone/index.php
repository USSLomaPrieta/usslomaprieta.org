<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
wp_get_header();
?>
			<div id="content" class="span-13">
<?php if(is_home()) { include (TEMPLATEPATH . '/gallery.php'); } ?>
<?php if(is_home()) { include (TEMPLATEPATH . '/homepage_cat.php'); } ?>
<div id="home_posts">
<div class="article-title">Articles</div>
<div class="content-box-index clearfix">
<?php
		if(wpthemes_options('featured_articles_enable') != '' && wpthemes_options('featured_articles_num') > 0) {
		?>
			<?php $paged = (get_query_var('paged')); ?>
			<?php query_posts("cat=" . wpthemes_options('featured_articles') . "&paged=" . $paged . "&showposts=" . wpthemes_options('featured_articles_num')); ?>
			<?php if (have_posts()) : ?>
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
        <?php } ?>
	<?php wp_reset_query(); ?>
    </div>
    </div>
    <?php get_sidebars(); ?>
<?php wp_get_footer(); ?>
