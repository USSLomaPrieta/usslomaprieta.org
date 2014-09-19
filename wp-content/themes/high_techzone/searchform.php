<?php $searchform_text = empty($_GET['s']) ? "" : get_search_query(); ?> 
<div id="search-wrap" class="clearfix">
	<span>Search</span>
    <form method="get" action="<?php bloginfo('url'); ?>">
        <input name="s" type="text" class="search-text" id="s" value="<?php echo $searchform_text; ?>"  onblur="if (this.value == '')  {this.value = '<?php echo $searchform_text; ?>';}" onfocus="if (this.value == '<?php echo $searchform_text; ?>') {this.value = '';}" />
        <input type="image" src="<?php bloginfo('stylesheet_directory'); ?>/images/search_btn.jpg" id="search-submit" alt="Search" value="" title="search_button" />
    </form>
</div>