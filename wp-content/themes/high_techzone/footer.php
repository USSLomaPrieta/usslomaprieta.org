<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
?>
</div>
</div>
<!-- begin footer -->
	<div id="footer-bg">
		<div id="footer">
			<div class="credit">
				Copyright &copy; <?php echo date('Y'); ?> <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>. All rights reserved.
				<div class="credit_t">Design: <a href="http://www.wpthemepremium.com">Wpthemepremium.com</a> | <?php 
/* This theme is powered by free-premium-wordpress-themes.com, please do NOT remove the comment or anything below. */
			wp_theme_powered_by();
/* This theme is powered by free-premium-wordpress-themes.com, please do NOT remove the comment or anything below. */ ?></div>
			</div>
			<?php 
            if(wpthemes_options('footer_code') != '') {
            echo wpthemes_options("footer_code")  . "\n"; 
            }
            ?>
            <?php wp_footer(); ?>
		</div>
     </div>
</div>
</div>
</body>
</html>