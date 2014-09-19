<form method="get" action="<?php bloginfo('url'); ?>">
					<input name="s" type="text" class="searchtext" id="s" value="Search..." onblur="if (this.value == '') {this.value = 'Search...';}" onfocus="if (this.value == 'Search...') {this.value = '';}" />
					<input type="image" src="<?php bloginfo('stylesheet_directory'); ?>/images/spacer.gif" id="searchsubmit" alt="Search" value="" />
				</form>