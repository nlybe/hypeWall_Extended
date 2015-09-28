<?php
/**
 * Elgg hypeWall Extended
 * @package hypeWall_extended 
 */

if (!elgg_is_logged_in()) {
	return;
}

if (!elgg_in_context('activity') && !elgg_in_context('wall')) {
	return;
}

// hypeWall_extended
elgg_load_css('hypeWall_extended_css');
elgg_load_library('elgg:hypeWall_extended');
	
$icon_size = get_icon_size();

$user = elgg_get_logged_in_user_entity();
$page_owner = elgg_get_page_owner_entity();

/* OBS
if ($page_owner->guid !== $user->guid) {
	$subtype = 'hjwall';
} else {
	$hw = elgg_get_plugin_from_id('hypeWall');;
	
	//if (intval($hw->getManifest()->getVersion() > 3))
		//$subtype = hypeWall()->config->getPostSubtype();	// hywall 4.x
	//else
	//	$subtype = WALL_SUBTYPE;	// hywall 3.2.x
	
}*/

// Make sure user can write to container before displaying the form
if (elgg_instanceof($page_owner) && !$page_owner->canWriteToContainer($user->guid, 'object', $subtype)) {
	return;
}

/********************************************
************* hypeWall_extended *************
********************************************/

$forms = '';

// add video support through videolist plugin
if (elgg_is_active_plugin('videolist') && elgg_get_plugin_setting('videolist', HYPEWALL_EXTENDED_ID)==HYPEWALL_EXTENDED_GENERAL_YES) {
		
	elgg_register_menu_item('wall-filter', array(
		'name' => 'videolist',
		'text' => '<i class="wall-icon wall-icon-video"></i>',
		'title' => elgg_echo('hypeWall_extended:videolist'),
		'href' => '#wall-form-videolist',
		'link_class' => 'wall-tab',
		//'style' => "font-size: {$icon_size}%;",
		'selected' => ($default == 'videolist'),
		'priority' => 350
	));
	$class = 'wall-form';
	if ($default !== 'videolist') {
		$class .= ' hidden';
	}
	$forms .= elgg_view_form('videolist/edit', array(
		'id' => 'wall-form-videolist',
		'class' => $class,
		'enctype' => 'multipart/form-data',
	), $vars);
	
}

// add polls support through poll plugin
if (elgg_is_active_plugin('poll') && elgg_get_plugin_setting('poll', HYPEWALL_EXTENDED_ID)==HYPEWALL_EXTENDED_GENERAL_YES) {
	$poll_site_access = elgg_get_plugin_setting('site_access', 'poll');
	if ($poll_site_access != 'admins' || elgg_is_admin_logged_in()) {
			
		elgg_register_menu_item('wall-filter', array(
			'name' => 'poll',
			'text' => '<i class="wall-icon wall-icon-poll"></i>',
			'title' => elgg_echo('hypeWall_extended:poll'),
			'href' => '#wall-form-poll',
			'link_class' => 'wall-tab',
			//'style' => "font-size: {$icon_size}%;",
			'selected' => ($default == 'poll'),
			'priority' => 400
		));
		$class = 'wall-form';
		if ($default !== 'poll') {
			$class .= ' hidden';
		}
		$forms .= elgg_view_form('poll/edit', array(
			'id' => 'wall-form-poll',
			'class' => $class,
			'enctype' => 'multipart/form-data',
		), $vars);
	}
}

// add blog support through blog plugin
if (elgg_is_active_plugin('blog') && elgg_get_plugin_setting('blog', HYPEWALL_EXTENDED_ID)==HYPEWALL_EXTENDED_GENERAL_YES) {
	elgg_load_library('elgg:blog');
	
	elgg_register_menu_item('wall-filter', array(
		'name' => 'blog',
		'text' => '<i class="wall-icon wall-icon-blog"></i>',
		'title' => elgg_echo('hypeWall_extended:blog'),
		'href' => '#wall-form-blog',
		'link_class' => 'wall-tab',
		//'style' => "font-size: {$icon_size}%;",
		'selected' => ($default == 'blog'),
		'priority' => 400
	));
	$class = 'wall-form';
	if ($default !== 'blog') {
		$class .= ' hidden';
	}
	$body_vars = blog_prepare_form_vars(null);
	$forms .= elgg_view_form('blog/save', array(
		'id' => 'wall-form-blog',
		'class' => $class,
		'title' => '',
		'enctype' => 'multipart/form-data',
	), $body_vars);

}

// add events support through event_manager plugin
if (elgg_is_active_plugin('event_manager') && elgg_get_plugin_setting('event_manager', HYPEWALL_EXTENDED_ID)==HYPEWALL_EXTENDED_GENERAL_YES) {
	$who_create_site_events = elgg_get_plugin_setting('who_create_site_events', 'event_manager');
	if ($who_create_site_events != 'admin_only' || elgg_is_admin_logged_in()) {
		elgg_register_menu_item('wall-filter', array(
			'name' => 'event',
			'text' => '<i class="wall-icon wall-icon-event"></i>',
			'title' => elgg_echo('hypeWall_extended:event'),
			'href' => elgg_normalize_url('events/event/new'),
			//'href' => '#wall-form-event',	// obs
			//'link_class' => 'wall-tab',			// especially on this icon we disable this coz we have direct link, so there is js issue
			'style' => "font-size: {$icon_size}%;", // especially on this icon we need this coz we have direct link, so there is js issue
			'selected' => ($default == 'event'),
			'priority' => 500
		));
		$class = 'wall-form';
		if ($default !== 'event') {
			$class .= ' hidden';
		}
		
		$forms .= elgg_view_form('wall/events', array(
		//$forms .= elgg_view("event_manager/forms/event/edit", array('entity' => false,
			'id' => 'wall-form-event',
			'class' => $class,
			'enctype' => 'multipart/form-data',
		), $vars);
	}
}

echo $forms;



