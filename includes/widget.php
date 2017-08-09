<?php 
add_action('widgets_init', 'godinterest_share_button_widgets_init');
function godinterest_share_button_widgets_init() {
    register_widget('godinterest_share_button_widget');
}

class godinterest_share_button_widget extends WP_Widget {
	function __construct() {
		parent::__construct('foo_widget', 'GodInterest Share Button Widget', array('description' => 'GodInterest Share Button Widget'));
	}
	
	public function widget($args, $instance) {
		$title = apply_filters('widget_title', $instance['title']);

		echo $args['before_widget'];
		if(!empty($title))
			echo $args['before_title'].$title.$args['after_title'];
		echo do_shortcode('[godinterest button="'.$instance['button'].'"]');
		echo $args['after_widget'];
	}
	
	public function form($instance) {
		if(isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = 'Share On GodInterest';
		}
		echo '<p>';
			echo '<label for="'.$this->get_field_id('title').'">Title:</label>';
			echo '<input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.esc_attr($title).'">';
		echo '</p>';
		
		if(isset($instance['button'])) {
			$button = $instance['button'];
		} else {
			$button = '1_dark';
		}
		echo '<label for="'.$this->get_field_name('button').'">Select Sharing Button:</label><br />';
		echo '<table>';
			echo '<tr>';
				echo '<td>';
					echo '<input type="radio" id="'.$this->get_field_id('button').'" name="'.$this->get_field_name('button').'" value="1_dark" '.checked($button, '1_dark', false).'/>';
				echo '</td>';
				echo '<td>';
					echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_1_dark.png" />';
				echo '</td>';
				echo '<td width="20px"></td>';
				echo '<td>';
					echo '<input type="radio" id="'.$this->get_field_id('button').'" name="'.$this->get_field_name('button').'" value="1_light" '.checked($button, '1_light', false).'/>';
				echo '</td>';
				echo '<td>';
					echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_1_light.png" />';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>';
					echo '<input type="radio" id="'.$this->get_field_id('button').'" name="'.$this->get_field_name('button').'" value="2_dark" '.checked($button, '2_dark', false).'/>';
				echo '</td>';
				echo '<td>';
					echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_2_dark.png" />';
				echo '</td>';
				echo '<td width="20px"></td>';
				echo '<td>';
					echo '<input type="radio" id="'.$this->get_field_id('button').'" name="'.$this->get_field_name('button').'" value="2_light" '.checked($button, '2_light', false).'/>';
				echo '</td>';
				echo '<td>';
					echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_2_light.png" />';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>';
					echo '<input type="radio" id="'.$this->get_field_id('button').'" name="'.$this->get_field_name('button').'" value="3_dark" '.checked($button, '3_dark', false).'/>';
				echo '</td>';
				echo '<td>';
					echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_3_dark.png" />';
				echo '</td>';
				echo '<td width="20px"></td>';
				echo '<td>';
					echo '<input type="radio" id="'.$this->get_field_id('button').'" name="'.$this->get_field_name('button').'" value="3_light" '.checked($button, '3_light', false).'/>';
				echo '</td>';
				echo '<td>';
					echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_3_light.png" />';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>';
					echo '<input type="radio" id="'.$this->get_field_id('button').'" name="'.$this->get_field_name('button').'" value="4_dark" '.checked($button, '4_dark', false).'/>';
				echo '</td>';
				echo '<td>';
					echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_4_dark.png" />';
				echo '</td>';
				echo '<td width="20px"></td>';
				echo '<td>';
					echo '<input type="radio" id="'.$this->get_field_id('button').'" name="'.$this->get_field_name('button').'" value="4_light" '.checked($button, '4_light', false).'/>';
				echo '</td>';
				echo '<td>';
					echo '<img src="'.GODINTEREST_SHARE_BUTTON_URL.'/images/share_button_4_light.png" />';
				echo '</td>';
			echo '</tr>';
		echo '</table>';
	}
	
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = (!empty($new_instance['title']))?strip_tags($new_instance['title']):'';
		$instance['button'] = (!empty($new_instance['button']))?$new_instance['button']:'';
		return $instance;
	}
}
?>