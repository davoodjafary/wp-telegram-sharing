<?php

/**
 * WP Telegram Sharing functions
 *
 * 
 *
 * @author	Davood Jafary
 * @package	WP Telegram Sharing
 * @since	1.0
 */

if ( ! defined( 'ABSPATH' ) )
	exit;


add_filter( 'the_content', 'wp_ts_links_after_content' );
add_action( 'admin_init', 'register_settings' );
add_action( 'admin_menu', 'add_menu_item' );


function wp_ts_enqueue_style() {

	wp_enqueue_style( 'wp-ts-stylesheet', PLUGIN_URL . 'css/style.css' );

}
add_action( 'wp_enqueue_scripts' , 'wp_ts_enqueue_style' );


function wp_ts_enqueue_script() {

	wp_register_script('wp_ts_javascript', PLUGIN_URL . 'js/js.js' );

	wp_enqueue_script('wp_ts_javascript');

}
add_action( 'wp_enqueue_scripts' , 'wp_ts_enqueue_script' );


function register_settings() {
	register_setting( 'wp_telegram_sharing', 'wp_telegram_sharing' );
}


function add_menu_item() {
	add_options_page( 'WP Telegram Sharing', 'WP Telegram Sharing', 'manage_options', 'wp-telegram-sharing', 'show_settings_page' );
}


function show_settings_page() {
	$opts = wp_ts_options();
	$post_types = get_post_types( array( 'public' => true ), 'objects' );
	include PLUGIN_DIR . 'includes/option.php';
}


function wp_ts_links_after_content( $content ) {
	$opts = wp_ts_options();
	$show_buttons = false;
	
	if( ! empty( $opts['auto_add_post_types'] ) && in_array( get_post_type(), $opts['auto_add_post_types'] ) && is_singular( $opts['auto_add_post_types'] ) ) {
		$show_buttons = true;
	}
		
	$show_buttons = apply_filters( 'display', $show_buttons );
	if( ! $show_buttons ) {
		return $content;
	}

	if($opts['telegram_icon_position'] == 'before' ) {
		return wp_ts_telegram_func($opts) . $content;
	}
	else {
		return $content . wp_ts_telegram_func();
	}

}


if ( ! function_exists( 'wp_ts_telegram_func' ) ) {

	function wp_ts_telegram_func() {

		$out ='';

		if ( is_single() ) {

			$out .='<a title="Share this page to Telegram" onclick="telebuttonShare();"><img src=" '. PLUGIN_URL .'img/t-logo.svg" alt="Share this page to Telegram" width="64" class="wpts-teleg-icon"/></a>';
		}
		return $out;
	}
}


function wp_ts_options() {	
	static $options;

	if( ! $options ) {	
		$defaults = array(
			'auto_add_post_types' => array( 'post' ), 
		);

		$db_option = get_option( 'wp_telegram_sharing', array());

		if(!isset($db_option['load_static'])) 
			$db_option['load_static'] = array();
		}

		if(!isset($db_option['social_options'])) {
			$db_option['social_options']= array();
		}

		if(!isset($db_option['auto_add_post_types'])) {
			$db_option['auto_add_post_types'] = array();
		}
	
		if( ! $db_option ) {
			update_option( 'wp_telegram_sharing', $defaults );
		}
		
		$options = wp_parse_args( $db_option, $defaults );
	return $options;
}
