<?php
/*
Plugin Name: A Few Micro Blogging Tweaks
Description: Just a few tweaks to help with micro blogging
Version: 1.2
Author: Jonathan Whiteland
Author URI: http://whiteland.net/jonathan
*/


// Set Title to a timestamp
// ----------------------------------------------------------------------------------------------------
// See: https://wordpress.org/support/topic/generating-and-setting-a-custom-post-title/

function afmbt_post_has_title($title) {
	// We've got a real title unless it's empty (doh!) or it's actually a datetime (which clearly isn't title either)
	if (!trim($title) or preg_match("/\d+-\d+-\d+\s+\d+:\d+:\d+/",$title)) {
		return FALSE;
	} else {
		return TRUE;
	}
}

function afmbt_set_post_title($post_title) {
	if (!afmbt_post_has_title($post_title)) {
		$post_title = date("Y-m-d H:i:s");
	}
	return $post_title;
}

add_filter('title_save_pre','afmbt_set_post_title');




// Use custom RSS feed that doesn't have titles
// ----------------------------------------------------------------------------------------------------
// See http://wordpress.stackexchange.com/questions/47726/remove-or-edit-dccreator-in-feeds

remove_all_actions( 'do_feed_rss2' );

function afmbt_rss_feed_without_titles() {
    load_template( dirname(__FILE__) . '/feed-rss2.php');
}

add_action('do_feed_rss2', 'afmbt_rss_feed_without_titles');


