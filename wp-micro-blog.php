<?php
/*
Plugin Name: WP micro.blog Tweaks
Description: Tweaks for micro.blog
Version: 1.1
Author: Jonathan Whiteland
Author URI: http://whiteland.net/jonathan
*/


// Hide Title from "Add new/Edit Post" screen
// ----------------------------------------------------------------------------------------------------
// See: http://wordpress.stackexchange.com/questions/110427/remove-post-title-input-from-edit-page

function updt_hide_post_title() {
	remove_post_type_support('post', 'title');
}

add_action('admin_init', 'updt_hide_post_title');

// ...and set it to a timestamp
// See: https://wordpress.org/support/topic/generating-and-setting-a-custom-post-title/

function updt_set_post_title() {
	return date("Y-m-d H:i:s");
}

add_filter('title_save_pre','updt_set_post_title');


// Use custom RSS feed that doesn't have titles
// ----------------------------------------------------------------------------------------------------
// See http://wordpress.stackexchange.com/questions/47726/remove-or-edit-dccreator-in-feeds

remove_all_actions( 'do_feed_rss2' );

function updt_rss_feed_without_titles() {
	$wp_path = explode('wp-content',__FILE__);
    	load_template( $wp_ath[0] . 'wp-content/feeds/feed-rss2.php');
}

add_action('do_feed_rss2', 'updt_rss_feed_without_titles');



