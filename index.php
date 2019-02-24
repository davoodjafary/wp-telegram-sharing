<?php
/*
Plugin Name: WP Telegram Sharing
Description: Sharing wordpress post to telegram. 
Version: 1.2
Author: Davood Jafary
Author URI: http://codeinwp.ir/
Plugin URI: http://codeinwp.ir/plugin-telegram-share/
License: MIT License
License URI: http://opensource.org/licenses/MIT
Text Domain: wp-telegram-sharing
License: GPL v3
*/



// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}


define( "PLUGIN_DIR", plugin_dir_path( __FILE__ ) ); 
define( "PLUGIN_URL", plugins_url( '/' , __FILE__ ) );

require_once PLUGIN_DIR . 'includes/plugin.php';