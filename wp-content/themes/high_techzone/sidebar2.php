<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
?>
<!-- begin sidebar -->
<div id="right-sidebar" class="sidebar span-6 last">
		<?php if(wpthemes_options('ad125_location1') != '' || wpthemes_options('ad125_location2') != '' || wpthemes_options('ad125_location3') != '' || wpthemes_options('ad125_location4') != '' || wpthemes_options('ad125_location5') != '' || wpthemes_options('ad125_location6') != '' || wpthemes_options('ad125_location7') != '' || wpthemes_options('ad125_location8') != '') { ?>
        <div class="sidebarad-wrap border-radius">
            <?php if(wpthemes_options('ad125_location1') != '') { ?>
					<a href="<?php echo wpthemes_options('ad125_url1'); ?>"><img src="<?php echo wpthemes_options('ad125_location1'); ?>" /></a>
			<?php } ?>
			<?php if(wpthemes_options('ad125_location2') != '') { ?>
					<a href="<?php echo wpthemes_options('ad125_url2'); ?>"><img src="<?php echo wpthemes_options('ad125_location2'); ?>" /></a>
			<?php } ?>
			<?php if(wpthemes_options('ad125_location3') != '') { ?>
					<a href="<?php echo wpthemes_options('ad125_url3'); ?>"><img src="<?php echo wpthemes_options('ad125_location3'); ?>" /></a>
			<?php } ?>
			<?php if(wpthemes_options('ad125_location4') != '') { ?>
					<a href="<?php echo wpthemes_options('ad125_url4'); ?>"><img src="<?php echo wpthemes_options('ad125_location4'); ?>" /></a>
			<?php } ?>
			<?php if(wpthemes_options('ad125_location5') != '') { ?>
					<a href="<?php echo wpthemes_options('ad125_url5'); ?>"><img src="<?php echo wpthemes_options('ad125_location5'); ?>" /></a>
			<?php } ?>
			<?php if(wpthemes_options('ad125_location6') != '') { ?>
					<a href="<?php echo wpthemes_options('ad125_url6'); ?>"><img src="<?php echo wpthemes_options('ad125_location6'); ?>" /></a>
			<?php } ?>
			<?php if(wpthemes_options('ad125_location7') != '') { ?>
					<a href="<?php echo wpthemes_options('ad125_url7'); ?>"><img src="<?php echo wpthemes_options('ad125_location7'); ?>" /></a>
			<?php } ?>
			<?php if(wpthemes_options('ad125_location8') != '') { ?>
					<a href="<?php echo wpthemes_options('ad125_url8'); ?>"><img src="<?php echo wpthemes_options('ad125_location8'); ?>" /></a>
			<?php } ?>
        
        </div>
        <?php } ?>
		<ul>
			<?php 
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Sidebar') ) : ?>
				<li>
                    <h2 class="sidebar-h2-first">Archives</h2>
                    <ul>
                    <?php wp_get_archives('type=monthly'); ?>
                    </ul>
                </li>
                <?php wp_list_categories('hide_empty=0&depth=1&show_count=1&title_li=<h2>Categories</h2>'); ?>		
                <?php wp_list_bookmarks(); ?>			
			<?php endif; ?>
		</ul>
        <?php if(wpthemes_options('sidebar_video_box') != '') {
			?>
			<div class="sidebarvideo">
				<ul> <li><h2 style="margin-bottom: 10px;">Featured Video</h2>
				<object width="90%"><param name="movie" value="http://www.youtube.com/v/<?php echo wpthemes_options('sidebar_featured_video'); ?>&hl=en&fs=1&rel=0&border=1"></param>
					<param name="allowFullScreen" value="true"></param>
					<param name="allowscriptaccess" value="always"></param>
					<embed src="http://www.youtube.com/v/<?php echo wpthemes_options('sidebar_featured_video'); ?>&hl=en&fs=1&rel=0&border=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="90%"></embed>
				</object>
				</li>
				</ul>
			</div>
		<?php
		}
		?>
        
</div>
<!-- end sidebar -->
