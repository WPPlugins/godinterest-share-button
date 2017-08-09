<?php
add_action('admin_menu', 'godinterest_share_button_add_menu');
function godinterest_share_button_add_menu() {
	$page = add_options_page('Godinterest Share', 'Godinterest Share', 'manage_options', 'godinterest-share-button', 'godinterest_share_button_settings_page');
}

add_action('admin_init', 'wp_ad_rotator_admin_init');
function wp_ad_rotator_admin_init() {	
	register_setting('godinterest_share_button_options', 'godinterest_share_button_options');
    add_settings_section('godinterest_share_button_main', '', 'godinterest_share_button_section_text', 'godinterest-share-button');

	add_meta_box('godinterest_share_button_meta_box_main_setup', 'Exit Popup Setup', 'godinterest_share_button_meta_box_main_setup_content', 'godinterest-share-button', 'normal', 'default');
	add_meta_box('godinterest_share_button_meta_box_rules', 'Fine Tune Where to display the Share Button', 'godinterest_share_button_meta_box_rules_content', 'godinterest-share-button', 'normal', 'default');
	godinterest_share_button_get_jquery();
	godinterest_share_button_admin_styles();
}


function godinterest_share_button_settings_page() { ?>
    <div class="wrap godinterest-share-button">
		<h2>Exit Popup</h2>
		<form method="post" action="options.php" name="wp_auto_commenter_form" id="wp_insert_form">
			<?php settings_fields('godinterest_share_button_options'); ?>
			<div id="poststuff" class="metabox-holder has-right-sidebar wp-insert-plugin">
				<div id="side-info-column" class="inner-sidebar">
					<p class="submit">
						<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
					</p>
				</div>
				<div id="post-body" class="has-sidebar">				
					<div id="post-body-content" class="has-sidebar-content">
						<?php do_settings_sections('godinterest-share-button'); ?>
					</div>
				</div>
				<br class="clear"/>			
			</div>
			<?php
			wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false);
			wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false);
			?>
			<script type="text/javascript">
			jQuery(document).ready( function($) {
				jQuery('.if-js-closed').removeClass('if-js-closed').addClass('closed');
				postboxes.add_postbox_toggles('<?php echo $sectionName; ?>');
			});
			</script>
		</form>
    </div>
<?php
}


function godinterest_share_button_section_text() {
	$data = get_option('godinterest_share_button_options');
	do_meta_boxes('godinterest-share-button', 'normal', $data);
}

function godinterest_share_button_meta_box_main_setup_content($data) {
	wp_nonce_field(plugin_basename( __FILE__ ), 'godinterest_share_button_noncename');
	
	$controls['status'] = godinterest_share_button_get_control('tz-checkbox', false, 'godinterest_share_button_options[status]', 'godinterest_share_button_options_status', ((isset($data['status']))?$data['status']:''));
	$whereToDisplay = array(
		array('value' => 'both', 'text' => 'Posts and Pages'),
		array('value' => 'posts', 'text' => 'Posts'),
		array('value' => 'pages', 'text' => 'Pages')
	);
	$controls['where_to_display'] = godinterest_share_button_get_control('select', false, 'godinterest_share_button_options[where_to_display]', 'godinterest_share_button_options_where_to_display', ((isset($data['where_to_display']))?$data['where_to_display']:''), 'Where to display the Share Button:', '', $whereToDisplay);

	$howToDisplay = array(
		array('value' => 'above', 'text' => 'Above Post / Page Content'),
		array('value' => 'below', 'text' => 'Below Post / Page Content')
	);
	$controls['how_to_display'] = godinterest_share_button_get_control('select', false, 'godinterest_share_button_options[how_to_display]', 'godinterest_share_button_options_how_to_display', ((isset($data['how_to_display']))?$data['how_to_display']:''), 'How to display the Share Button:', '', $howToDisplay);

	echo $controls['status']['html'];
	echo '<div style="margin: 15px 0; padding: 5px; border: 1px solid #ddd; border-radius: 5px; position: relative;">';
		echo '<label style="font-weight: bold; position: absolute; left: 15px; top: -10px; background: #FFF; padding: 0px 10px;">Configuration</label>';
		echo '<div style="background: #DDDDDD; margin: 10px 0; padding: 10px; position: relative;">';
			echo $controls['where_to_display']['html'].$controls['how_to_display']['html'];
			echo '<label for="godinterest_share_button_options[button]">Select Sharing Button:</label><br />';
			echo '<table>';
				echo '<tr>';
					echo '<td>';
						if(!isset($data['button'])) { $data['button'] = '1_dark'; }
						echo '<input type="radio" name="godinterest_share_button_options[button]" value="1_dark" '.checked($data['button'], '1_dark', false).'/>';
					echo '</td>';
					echo '<td>';
						echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_1_dark.png" />';
					echo '</td>';
					echo '<td width="20px"></td>';
					echo '<td>';
						echo '<input type="radio" name="godinterest_share_button_options[button]" value="1_light" '.checked($data['button'], '1_light', false).'/>';
					echo '</td>';
					echo '<td>';
						echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_1_light.png" />';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td>';
						echo '<input type="radio" name="godinterest_share_button_options[button]" value="2_dark" '.checked($data['button'], '2_dark', false).'/>';
					echo '</td>';
					echo '<td>';
						echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_2_dark.png" />';
					echo '</td>';
					echo '<td width="20px"></td>';
					echo '<td>';
						echo '<input type="radio" name="godinterest_share_button_options[button]" value="2_light" '.checked($data['button'], '2_light', false).'/>';
					echo '</td>';
					echo '<td>';
						echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_2_light.png" />';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td>';
						echo '<input type="radio" name="godinterest_share_button_options[button]" value="3_dark" '.checked($data['button'], '3_dark', false).'/>';
					echo '</td>';
					echo '<td>';
						echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_3_dark.png" />';
					echo '</td>';
					echo '<td width="20px"></td>';
					echo '<td>';
						echo '<input type="radio" name="godinterest_share_button_options[button]" value="3_light" '.checked($data['button'], '3_light', false).'/>';
					echo '</td>';
					echo '<td>';
						echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_3_light.png" />';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td>';
						echo '<input type="radio" name="godinterest_share_button_options[button]" value="4_dark" '.checked($data['button'], '4_dark', false).'/>';
					echo '</td>';
					echo '<td>';
						echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_4_dark.png" />';
					echo '</td>';
					echo '<td width="20px"></td>';
					echo '<td>';
						echo '<input type="radio" name="godinterest_share_button_options[button]" value="4_light" '.checked($data['button'], '4_light', false).'/>';
					echo '</td>';
					echo '<td>';
						echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_4_light.png" />';
					echo '</td>';
				echo '</tr>';
			echo '</table>';
		echo '</div>';
	echo '</div>';
	
	echo '<div style="margin: 15px 0; padding: 5px; border: 1px solid #ddd; border-radius: 5px; position: relative;">';
		echo '<label style="font-weight: bold; position: absolute; left: 15px; top: -10px; background: #FFF; padding: 0px 10px;">Shortcode</label>';
		echo '<div style="background: #DDDDDD; margin: 10px 0; padding: 10px; position: relative;">';
			echo '<p>You can use the following shortcodes to display the share button within the content area</p>';
				echo '<table>';
					echo '<tr>';
						echo '<td>';
							echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_1_dark.png" />';
						echo '</td>';
						echo '<td>';
							echo '<code>[godinterest button="1_dark"]</code>';
						echo '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td>';
							echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_1_light.png" />';
						echo '</td>';
						echo '<td>';
							echo '<code>[godinterest button="1_light"]</code>';
						echo '</td>';
					echo '</tr>';
					echo '<tr><td>&nbsp;</td></tr>';
					echo '<tr>';
						echo '<td>';
							echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_2_dark.png" />';
						echo '</td>';
						echo '<td>';
							echo '<code>[godinterest button="2_dark"]</code>';
						echo '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td>';
							echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_2_light.png" />';
						echo '</td>';
						echo '<td>';
							echo '<code>[godinterest button="2_light"]</code>';
						echo '</td>';
					echo '</tr>';
					echo '<tr><td>&nbsp;</td></tr>';
					echo '<tr>';
						echo '<td>';
							echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_3_dark.png" />';
						echo '</td>';
						echo '<td>';
							echo '<code>[godinterest button="3_dark"]</code>';
						echo '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td>';
							echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_3_light.png" />';
						echo '</td>';
						echo '<td>';
							echo '<code>[godinterest button="3_light"]</code>';
						echo '</td>';
					echo '</tr>';
					echo '<tr><td>&nbsp;</td></tr>';
					echo '<tr>';
						echo '<td>';
							echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_4_dark.png" />';
						echo '</td>';
						echo '<td>';
							echo '<code>[godinterest button="4_dark"]</code>';
						echo '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td>';
							echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_4_light.png" />';
						echo '</td>';
						echo '<td>';
							echo '<code>[godinterest button="4_light"]</code>';
						echo '</td>';
					echo '</tr>';
				echo '</table>';
		echo '</div>';		
	echo '</div>';
	
	echo godinterest_share_button_get_script_tag($controls);	
	echo '<script type="text/javascript">';
	echo 'jQuery(document).ready(function(){';
		echo 'jQuery("#godinterest_share_button_options_split_testing").change(function() {';
			echo 'if(jQuery("#godinterest_share_button_options_split_testing").val() == "enable") {';
				echo 'jQuery(".godinterest_share_button_split_testing_controls_wrapper").show();';
			echo '} else {';
				echo 'jQuery(".godinterest_share_button_split_testing_controls_wrapper").hide();';
			echo '}';
		echo '});';
	echo '});';
	echo '</script>';
}
	
function godinterest_share_button_meta_box_rules_content($data) {
	$controls['rules_exclude_home'] = godinterest_share_button_get_control('ip-checkbox', false, 'godinterest_share_button_options[rules_exclude_home]', 'godinterest_share_button_options_rules_exclude_home', ((isset($data['rules_exclude_home']))?$data['rules_exclude_home']:''), '', '', null, '', false);
	$controls['rules_exclude_archives'] = godinterest_share_button_get_control('ip-checkbox', false, 'godinterest_share_button_options[rules_exclude_archives]', 'godinterest_share_button_options_rules_exclude_archives', ((isset($data['rules_exclude_archives']))?$data['rules_exclude_archives']:''), '', '', null, '', false);
	$controls['rules_exclude_categories'] = godinterest_share_button_get_control('ip-checkbox', false, 'godinterest_share_button_options[rules_exclude_categories]', 'godinterest_share_button_options_rules_exclude_categories', ((isset($data['rules_exclude_categories']))?$data['rules_exclude_categories']:''), '', '', null, '', false);
	$controls['rules_categories_exceptions'] = godinterest_share_button_get_control('popup', false, 'godinterest_share_button_options[rules_categories_exceptions]', 'godinterest_share_button_options_rules_categories_exceptions', ((isset($data['rules_categories_exceptions']))?$data['rules_categories_exceptions']:''), '', '', array('type' => 'categories'), '', false);
	$controls['rules_categories_post_exceptions'] = godinterest_share_button_get_control('popup', false, 'godinterest_share_button_options[rules_categories_post_exceptions]', 'godinterest_share_button_options_rules_categories_post_exceptions', ((isset($data['rules_categories_post_exceptions']))?$data['rules_categories_post_exceptions']:''), '', '', array('type' => 'categories'), '', false);
	$controls['rules_exclude_search'] = godinterest_share_button_get_control('ip-checkbox', false, 'godinterest_share_button_options[rules_exclude_search]', 'godinterest_share_button_options_rules_exclude_search', ((isset($data['rules_exclude_search']))?$data['rules_exclude_search']:''), '', '', null, '', false);
	$controls['rules_exclude_page'] = godinterest_share_button_get_control('ip-checkbox', false, 'godinterest_share_button_options[rules_exclude_page]', 'godinterest_share_button_options_rules_exclude_page', ((isset($data['rules_exclude_page']))?$data['rules_exclude_page']:''), '', '', null, '', false);
	$controls['rules_page_exceptions'] = godinterest_share_button_get_control('popup', false, 'godinterest_share_button_options[rules_page_exceptions]', 'godinterest_share_button_options_rules_page_exceptions', ((isset($data['rules_page_exceptions']))?$data['rules_page_exceptions']:''), '', '', array('type' => 'pages'), '', false);
	$controls['rules_exclude_post'] = godinterest_share_button_get_control('ip-checkbox', false, 'godinterest_share_button_options[rules_exclude_post]', 'godinterest_share_button_options_rules_exclude_post', ((isset($data['rules_exclude_post']))?$data['rules_exclude_post']:''), '', '', null, '', false);
	$controls['rules_post_exceptions'] = godinterest_share_button_get_control('popup', false, 'godinterest_share_button_options[rules_post_exceptions]', 'godinterest_share_button_options_rules_post_exceptions', ((isset($data['rules_post_exceptions']))?$data['rules_post_exceptions']:''), '', '', array('type' => 'posts'), '', false);
	
	echo godinterest_share_button_rules_content($controls);
	echo godinterest_share_button_get_script_tag($controls);
}

function godinterest_share_button_rules_content($controls) {
	$rulesTable = array(
		'class' => 'rules',
		'rows' => array()
	);
	array_push(
		$rulesTable['rows'],
		array(
			'cells' => array(
				array('style' => 'text-align: left;', 'colspan' => '3', 'type' => 'th', 'content' => 'Home')
			)
		),
		array(
			'cells' => array(
				array('content' => 'Status'),
				array('content' => '&nbsp;:&nbsp;'),
				array('content' => $controls['rules_exclude_home']['html'])
			)
		)
	);
	array_push(
		$rulesTable['rows'], 
		array(
			'cells' => array(
				array('colspan' => '3', 'content' => '&nbsp;')
			)
		),
		array(
			'cells' => array(
				array('style' => 'text-align: left;', 'colspan' => '3', 'type' => 'th', 'content' => 'Archives')
			)
		),
		array(
			'cells' => array(
				array('content' => 'Status'),
				array('content' => '&nbsp;:&nbsp;'),
				array('content' => $controls['rules_exclude_archives']['html'])
			)
		)
	);
	array_push(
		$rulesTable['rows'], 
		array(
			'cells' => array(
				array('colspan' => '3', 'content' => '&nbsp;')
			)
		),
		array(
			'cells' => array(
				array('style' => 'text-align: left;', 'colspan' => '3', 'type' => 'th', 'content' => 'Categories')
			)
		),
		array(
			'cells' => array(
				array('content' => 'Status'),
				array('content' => '&nbsp;:&nbsp;'),
				array('content' => $controls['rules_exclude_categories']['html'])
			)
		),
		array(
			'cells' => array(
				array('content' => 'Exceptions'),
				array('content' => '&nbsp;:&nbsp;'),
				array('content' => $controls['rules_categories_exceptions']['html'])
			)
		),
		array(
			'cells' => array(
				array('content' => 'Post Exceptions'),
				array('content' => '&nbsp;:&nbsp;'),
				array('content' => $controls['rules_categories_post_exceptions']['html'])
			)
		)
	);
	array_push(
		$rulesTable['rows'], 
		array(
			'cells' => array(
				array('colspan' => '3', 'content' => '&nbsp;')
			)
		),
		array(
			'cells' => array(
				array('style' => 'text-align: left;', 'colspan' => '3', 'type' => 'th', 'content' => 'Search Results')
			)
		),
		array(
			'cells' => array(
				array('content' => 'Status'),
				array('content' => '&nbsp;:&nbsp;'),
				array('content' => $controls['rules_exclude_search']['html'])
			)
		)
	);
	array_push(
		$rulesTable['rows'], 
		array(
			'cells' => array(
				array('colspan' => '3', 'content' => '&nbsp;')
			)
		),
		array(
			'cells' => array(
				array('style' => 'text-align: left;', 'colspan' => '3', 'type' => 'th', 'content' => 'Single Page')
			)
		),
		array(
			'cells' => array(
				array('content' => 'Status'),
				array('content' => '&nbsp;:&nbsp;'),
				array('content' => $controls['rules_exclude_page']['html'])
			)
		),
		array(
			'cells' => array(
				array('content' => 'Exceptions'),
				array('content' => '&nbsp;:&nbsp;'),
				array('content' => $controls['rules_page_exceptions']['html'])
			)
		)
	);
	array_push(
		$rulesTable['rows'], 
		array(
			'cells' => array(
				array('colspan' => '3', 'content' => '&nbsp;')
			)
		),
		array(
			'cells' => array(
				array('style' => 'text-align: left;', 'colspan' => '3', 'type' => 'th', 'content' => 'Single Blog Post')
			)
		),
		array(
			'cells' => array(
				array('content' => 'Status'),
				array('content' => '&nbsp;:&nbsp;'),
				array('content' => $controls['rules_exclude_post']['html'])
			)
		),
		array(
			'cells' => array(
				array('content' => 'Exceptions'),
				array('content' => '&nbsp;:&nbsp;'),
				array('content' => $controls['rules_post_exceptions']['html'])
			)
		)
	);
	
	return godinterest_share_button_get_table($rulesTable);
}
?>