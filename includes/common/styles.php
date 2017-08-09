<?php
function godinterest_share_button_admin_styles() {	
	wp_enqueue_style('godinterest-share-button-styles', GODINTEREST_SHARE_BUTTON_URL.'/includes/common/css/style.css', false);
	wp_enqueue_style('thickbox');
	wp_enqueue_script('common');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('colorbox', GODINTEREST_SHARE_BUTTON_URL.'/includes/common/js/jquery.colorbox-min.js', array('jquery'));
	wp_enqueue_script('iphone-checkboxes', GODINTEREST_SHARE_BUTTON_URL.'/includes/common/js/iphone-style-checkboxes.js', array('jquery'));
	wp_enqueue_script('better-checkboxes', GODINTEREST_SHARE_BUTTON_URL.'/includes/common/js/jquery.tzCheckbox.js', array('jquery'));
	wp_enqueue_script('image-uploader', GODINTEREST_SHARE_BUTTON_URL.'/includes/common/js/wp-upload-functions.js', array('jquery'));	
	wp_enqueue_script('nicEdit', GODINTEREST_SHARE_BUTTON_URL.'/includes/common/js/nicEdit-latest.js', array('jquery'));
	wp_enqueue_script('minicolors', GODINTEREST_SHARE_BUTTON_URL.'/includes/common/js/jquery.miniColors.js', array('jquery'));
}
?>