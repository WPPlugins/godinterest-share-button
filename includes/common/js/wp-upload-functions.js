jQuery(document).ready(function() {	
	jQuery('.godinterest_share_button_uploader_button').click(function() {
		formfield = jQuery(this).prev().attr("name");
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		return false;
	});
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		jQuery("input[name=\'"+formfield+"\']").val(imgurl);
		tb_remove();
	}
});