<!-- sidebar start -->
		<div id="sidebar">
        	<div id="searchform"><?php include(TEMPLATEPATH . '/searchform.php'); ?></div>
			<div id="welcome"><p><?php include(TEMPLATEPATH . '/welcome.php'); ?></p></div>
			<div id="sidebar_main" class="clearfix">
            <ul>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>
                <li>
                    <h2>Categories</h2>
                    <ul>
                        <?php wp_list_cats('sort_column=name&optioncount=0&hierarchical=0'); ?>
                    </ul>
                </li>
                <li>
                    <h2>Archives</h2>
                    <ul>
                        <?php wp_get_archives('type=monthly'); ?>
                    </ul>
                </li>
                <li>
                    <?php get_friend_links(array('title')); ?>
                </li>
                <li>
                    <h2>Meta</h2>
                    <ul>
                        <?php wp_register(); ?>
                        <li><?php wp_loginout(); ?></li>
                        <li><a href="http://validator.w3.org/check/referer">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
                        <li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
                        <?php wp_meta(); ?>
                    </ul>
                </li>
             <?php endif; ?>
             </ul>
			 </div>
		</div>
<!-- sidebar end -->
