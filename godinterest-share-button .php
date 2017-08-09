<?php
/*
Plugin Name: GodInterest Share Button
Plugin URI: http://godinterest.com/
Description: Add a "Share to Godinterest" Button to your site and get your visitors to start sharing your awesome content!.
Version: 1.0
Author: Dean Jones 
Author URI: http://godinterest.com/

Add a "Share to Godinterest" Button to your site and get your visitors to start sharing your awesome content!.
*/
/*Definitions*/
if(!defined('GODINTEREST_SHARE_BUTTON_URL'))
	define('GODINTEREST_SHARE_BUTTON_URL',WP_PLUGIN_URL.'/godinterest-share-button');
if(!defined('GODINTEREST_SHARE_BUTTON_DIR'))
	define('GODINTEREST_SHARE_BUTTON_DIR',WP_PLUGIN_DIR.'/godinterest-share-button ');

/*Includes*/
require_once (dirname(__FILE__).'/includes/includes.php');
?>