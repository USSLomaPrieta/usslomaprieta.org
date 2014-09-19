<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
?>
<!-- begin sidebar -->
<div id="sidebar-wrapper" class="clearfix">
    <div id="left-sidebar" class="sidebar span-6">
            <ul>
                <?php 
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Sidebar') ) : ?>
                <li>
                	<h2 class="sidebar-h2-first"><?php _e('Recent Posts'); ?></h2>
                   <ul>
					<?php wp_get_archives('type=postbypost&limit=5'); ?>  
                   </ul>
				</li>
				<li>
                    <h2>Recent Comments</h2>
                    <ul>
                        <?php include(TEMPLATEPATH . '/recent-comments.php'); ?>
                    </ul>
                </li>
                <li>
                	<h2>Meta</h2>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
						<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
						<?php wp_meta(); ?>
					</ul>
                </li>
                <li> 
					<h2>Calendar</h2>
					<?php get_calendar(); ?> 
				</li>
                <li id="tag_cloud"><h2>Tags</h2>
					<div><?php wp_tag_cloud('largest=16&format=flat&number=20'); ?></div>
				</li>  
            <?php endif; ?>
            </ul>
    </div>
    <?php include(TEMPLATEPATH . '/sidebar2.php'); ?>
</div>
<!-- end sidebar -->

