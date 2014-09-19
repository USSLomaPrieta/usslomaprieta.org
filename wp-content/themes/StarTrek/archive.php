<?php get_header(); ?>
<!-- container start -->
	<div id="container" class="clearfix">
		<?php get_sidebars(); ?>
<!-- content start -->
		<div id="content" class="clearfix">
		<?php if(have_posts()) : ?>
                <div class="post_path">You are here: <a href="<?php bloginfo('url'); ?>">Home</a> &gt;<?php
		// If this is a category archive
		if (is_category()) {
			printf( __('Archive for the &#8216;<span>%1$s</span>&#8217; Category', 'ezwpthemes'), single_cat_title('', false) );
		// If this is a tag archive
		} elseif (is_tag()) {
			printf( __('Posts Tagged &#8216;<span>%1$s</span>&#8217;', 'ezwpthemes'), single_tag_title('', false) );
		// If this is a daily archive
		} elseif (is_day()) {
			printf( __('Archive for <span>%1$s</span>', 'ezwpthemes'), get_the_time(__('F jS, Y', 'ezwpthemes')) );
		// If this is a monthly archive
		} elseif (is_month()) {
			printf( __('Archive for <span>%1$s</span>', 'ezwpthemes'), get_the_time(__('F, Y', 'ezwpthemes')) );
		// If this is a yearly archive
		} elseif (is_year()) {
			printf( __('Archive for <span>%1$s</span>', 'ezwpthemes'), get_the_time(__('Y', 'ezwpthemes')) );
		// If this is an author archive
		} elseif (is_author()) {
			_e('Author Archive', 'ezwpthemes');
		// If this is a paged archive
		} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
			_e('Blog Archives', 'ezwpthemes');
		}
		?></div>
			<?php while(have_posts()) : the_post(); ?>
			<div class="post">
				<div class="post_header_bg"><h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2></div>
                <div class="postmetadata">Posted in <?php the_category(', ') ?></div>
<div class="post_date"><?php the_time('M') ?><div class=" day"><?php the_time('d') ?></div></div>
                <div class="entry"><?php the_excerpt(); ?></div>
				<div class="endline"></div>
				<?php the_tags('<p class="tags"><strong>Tags:</strong> ', ', ', '</p>'); ?>
				<div class="bookmark"><?php include(TEMPLATEPATH . '/bookmark.php'); ?></div>
<div class="read_comments"><a href="<?php comments_link(); ?>">Read User's Comments<span><?php comments_number('0','1','%'); ?></span></a></div>
                <?php if ( $user_ID ) : ?>
					<div class="edit_post"><?php edit_post_link(__('Edit this post')); ?> (Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>)</div>
				<?php endif; ?>
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
<!-- content end -->
	</div>
<!-- container end -->
<?php get_footer(); ?>