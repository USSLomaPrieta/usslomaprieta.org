<?php get_header(); ?>
<!-- container start -->
	<div id="container" class="clearfix">
		<?php get_sidebars(); ?>
<!-- content start -->
		<div id="content" class="clearfix">
		<?php if(have_posts()) : ?>
			<?php while(have_posts()) : the_post(); ?>
			<div class="post">
				<div class="post_header_bg"><h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2></div>
                <div class="postmetadata">Posted in <?php the_category(', ') ?></div>
<div class="post_date"><?php the_time('M') ?><div class=" day"><?php the_time('d') ?></div></div>
                <div class="entry"><?php the_excerpt(); ?></div>
				<div class="endline"></div>
                <?php if ( $user_ID ) : ?>
					<div class="edit_post"><?php edit_post_link(__('Edit this post')); ?> (Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>)</div>
				<?php endif; ?>
				<div class="bookmark"><?php include(TEMPLATEPATH . '/bookmark.php'); ?></div>
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