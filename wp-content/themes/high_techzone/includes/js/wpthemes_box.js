jQuery(document).ready(function(){
var tag_cloud_class = '#tagcloud'; 
var tag_cloud_height = jQuery('#tagcloud').height();
jQuery('.inside ul li:last-child').css('border-bottom','0px') 
jQuery('.wpthemesBox li a:first').addClass('selected'); 
jQuery('.inside > *').hide();
jQuery('.inside > *:first').show();
jQuery('.wpthemesBox li a').click(function(evt){ 
var clicked_tab_ref = jQuery(this).attr('href'); 
jQuery('.wpthemesBox li a').removeClass('selected'); 
jQuery(this).addClass('selected');
jQuery('.inside > *').fadeOut(100);
jQuery('.inside ' + clicked_tab_ref).fadeIn(500);
evt.preventDefault();
})
})