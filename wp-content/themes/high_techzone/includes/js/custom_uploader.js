jQuery(document).ready(function() {
	var InputText = '';
	jQuery('.upload_image_button').click(function() {
		InputText = jQuery(this).parent().parent().find("input[type=text]");
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){
		if (InputText) {
			InputURL = jQuery('img',html).attr('src');
			InputText.val(InputURL);
			tb_remove();
		} else {
			window.original_send_to_editor(html);
		}
	};
});