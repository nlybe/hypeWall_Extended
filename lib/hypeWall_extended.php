<?php
/**
 * Elgg hypeWall Extended
 * @package hypeWall_extended 
 */

/**
 * retrieve the size of the icons from settings
 *
 * @param ElggBlog       $post
 * @param ElggAnnotation $revision
 * @return array
 */
function get_icon_size() {

	$size = elgg_get_plugin_setting('icon_size', HYPEWALL_EXTENDED_ID);
	
	if (!is_numeric($size))
		$size = 100;
	
	return $size;
}
