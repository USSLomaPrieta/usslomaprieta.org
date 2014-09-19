
    <div class="span-24">
		<div id="footer">Copyright &copy; <a href="<?php bloginfo('home'); ?>"><strong><?php bloginfo('name'); ?></strong></a>  - <?php bloginfo('description'); ?></div>
        
        <div id="credits">Design: <a href="http://www.newwpthemes.com" target="_blank">NewWpThemes</a> | <?php 
/* This theme is powered by free-premium-wordpress-themes.com, please do NOT remove the comment or anything below. */
			wp_theme_powered_by();
/* This theme is powered by free-premium-wordpress-themes.com, please do NOT remove the comment or anything below. */ ?></div>
    </div>
</div>

</div>
<?php
	 wp_footer();
	echo get_theme_option("footer")  . "\n";
?>
</body>
</html>