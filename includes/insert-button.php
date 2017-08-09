<?php
add_filter('the_content', 'godinterest_share_button_the_content');
function godinterest_share_button_the_content($content) {
	$data = get_option('godinterest_share_button_options');
	global $post;
	if($data['status'] && godinterest_share_button_get_ad_status($data)) {
		if(($data['where_to_display'] == 'posts' && $post->post_type == 'post') || ($data['where_to_display'] == 'pages' && $post->post_type == 'page') || ($data['where_to_display'] == 'both')) {
			if($data['how_to_display'] == 'above') {
				$content = do_shortcode('[godinterest button="'.$data['button'].'"]').$content;
			} else {
				$content .= do_shortcode('[godinterest button="'.$data['button'].'"]');
			}
		}
	}
	return $content;
}

add_shortcode('godinterest', 'godinterest_share_button_godinterest_shortcode');
function godinterest_share_button_godinterest_shortcode($atts) {
	global $post;
	$atts = shortcode_atts(array('button' => '1_dark'), $atts);
	return '<img style="cursor: pointer;" onclick="godinterest_share_button_trigger(\''.get_permalink($post->ID).'\')" src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_'.$atts['button'].'.png" />';
}

add_action('wp_footer', 'godinterest_share_button_wp_footer');
function godinterest_share_button_wp_footer() {
	echo '<script type="text/javascript">';
		echo 'function godinterest_share_button_trigger(url) {';
			echo 'var e = document.createElement("script");';
			echo 'e.setAttribute("class", "revolution-bookmarklet");';
			echo 'e.setAttribute("type", "text/javascript");';
			echo 'e.setAttribute("charset", "UTF-8");';
			echo 'e.setAttribute("rel", "http://godinterest.com/");';
			echo 'e.setAttribute("src", "http://d3rtbvczwo197u.cloudfront.net/scripts/bookmarklet.js?url="+escape(url)+"&"+Math.round(Math.random()*1000000));';
			echo 'document.body.appendChild(e);';
		echo '}';
	echo '</script>';
}
?>