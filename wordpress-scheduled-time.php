<?php
/*
Plugin Name: WordPress Scheduled Time
Plugin URI: http://www.willen.net/wordpress-scheduled-time/
Description: This plugin makes it possible to see the scheduled post time of a post.
Version: 1.0.2
Author: Paul Willen
Author URI: http://www.willen.net
*/ 

add_filter( 'manage_edit-post_sortable_columns', 'wst_sortable_column');
add_filter('manage_posts_columns', 'wst_set_post_columns');
add_action('manage_posts_custom_column',  'wst_show_columns');

function wst_sortable_column( $columns ) {
	$columns['published-time'] = 'date';
 	return $columns;
}

function wst_set_post_columns($columns) {
  $columns['published-time'] = 'Post Status';
  unset($columns['date']);
  return $columns;
}

function wst_get_status_style($status){
	switch($status){
		case 'publish':
		case 'future':
			return "color:#339933";
		case 'pending':
		case 'edited':
		case 'pitch':
			return "color:#CC3300";
		case 'ready-for-edit':
			return "color:#CC9933";
		default:
			return "color:#000";
	}
}

function wst_show_columns($columnname) {
	global $post;
	if($columnname == 'published-time')
		echo "<p style='". wst_get_status_style($post->post_status) ."'>". ucfirst($post->post_status) ." <br />". get_the_time(get_option('date_format')) ." <br/> ". get_the_time(get_option('time_format')) ."</p>";
}
