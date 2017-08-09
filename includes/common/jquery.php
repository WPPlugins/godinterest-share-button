<?php
function godinterest_share_button_get_jquery() {
	$output = '<script type="text/javascript">';
	$output .= 'var jQueryScriptOutputted = false;';
	$output .= 'function initJQuery() {';
		$output .= 'if (typeof(jQuery) == "undefined") {';
			$output .= 'if (! jQueryScriptOutputted) {';
				$output .= 'jQueryScriptOutputted = true;';
				$output .= 'document.write("<scr" + "ipt type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js\"></scr" + "ipt>");';
			$output .= '}';
			$output .= 'setTimeout("initJQuery()", 50);';
		$output .= '}';      
	$output .= '}';
	$output .= 'initJQuery();';
	$output .= '</script>';
	return $output;
}
?>