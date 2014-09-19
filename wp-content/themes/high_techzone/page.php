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
						<?php while (have_posts()) : the_post(); ?>
						<?php if ( version_compare( $wp_version, '2.7', '>=' ) ) { ?>
								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php } else { ?>
								<div id="post-<?php the_ID(); ?>" class="page post-<?php the_ID(); ?>">
							<?php } ?>
							<h1 class="title"><?php the_title(); ?></h1>
							<div class="entry clearfix">
                                <?php if ( version_compare( $wp_version, '2.9', '>=' ) ) {
								if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) { the_post_thumbnail(array(200,150), array("class" => "alignleft post_thumbnail")); }
								} else {
								if ( get_post_meta($post->ID, 'featured', true) ) { $image = get_post_meta($post->ID, 'featured', true); echo "<img class=\"alignleft post_thumbnail\" width=\"200\" src=" . $image . " />"; }
								}
							?>
								<?php the_content(__('Read entire Article &raquo;','cover-wp')); ?>
								<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
							</div>
                            <?php if ( $user_ID ) : ?><p><?php edit_post_link(__('Edit this entry')); ?></p><?php endif; ?>
						</div>
				<?php endwhile; ?>
				<?php endif; ?>
               </div>
			</div>
            <?php get_sidebars(); ?>
<?php wp_get_footer(); ?>
