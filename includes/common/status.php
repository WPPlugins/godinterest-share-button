<?php
function godinterest_share_button_get_page_details() {
	global $post;
	$page_details = array(
		'type' => 'POST',
		'ID' => $post->ID
	);
	if(is_home() || is_front_page()) {
		$page_details['type'] = 'HOME';
	} else if(is_category()) {
		$page_details['type'] = 'CATEGORY';
		$page_details['ID'] = get_query_var('cat');
	} else if(is_archive()) {
		$page_details['type'] = 'ARCHIVE';
	} else if(is_search()) {
		$page_details['type'] = 'SEARCH';
	} else if(is_page()) {
		$page_details['type'] = 'PAGE';
	} else if(is_single()) {
		if(is_singular('post')) {
			$page_details['type'] = 'POST';
			$page_details['categories'] = wp_get_post_categories($page_details['ID']);
		} else {
			$page_details['type'] = 'CUSTOM';
			$page_details['type_name'] = $post->post_type;
		}
	}
	
	return $page_details;
}

function godinterest_share_button_get_ad_status($rules) {
	if(!isset($rules)) { return false; }
	
	$page_details = godinterest_share_button_get_page_details();
	switch($page_details['type']) {
		case 'HOME':
			if($rules['rules_exclude_home']) {
				return false;
			}
			break;
		case 'ARCHIVE':
			if($rules['rules_exclude_archives']) {
				return false;
			}
			break;
		case 'CATEGORY':
			if($rules['rules_exclude_categories']) {
				return false;
			} else if($rules['rules_categories_exceptions']) {
				return false;
			}
			break;
		case 'SEARCH':
			if($rules['rules_exclude_search']) {
				return false;
			}
			break;
		case 'PAGE':
			if($rules['rules_exclude_page']) {
				return false;
			} else if($rules['rules_page_exceptions']) {
				return false;
			}
			break;
		case 'POST':
			if($rules['rules_exclude_post']) {
				return false;
			} else if($rules['rules_post_exceptions'] && (in_array($page_details['ID'], split(',', $rules['rules_post_exceptions'])))) {
				return false;
			} else if($rules['rules_categories_post_exceptions'] && is_array($page_details['categories']) && (count(array_intersect(array_unique($page_details['categories']), array_unique(split(',', $rules['rules_categories_post_exceptions'])))) > 0)) {
				return false;
			}
			break;
	}
	return true;
}
?>