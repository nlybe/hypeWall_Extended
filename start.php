<?php
/**
 * Elgg hypeWall Extended
 * @package hypeWall_extended 
 */
 
elgg_register_event_handler('init', 'system', 'hypeWall_extended_init');

define('HYPEWALL_EXTENDED_ID', 'hypeWall_extended');	// plugin id
define('HYPEWALL_EXTENDED_GENERAL_YES', 'yes');	// general purpose string for yes
define('HYPEWALL_EXTENDED_GENERAL_NO', 'no');	// general purpose string for no

function hypeWall_extended_init() {  

	// register plugin library
	elgg_register_library('elgg:hypeWall_extended', elgg_get_plugins_path() . 'hypeWall_extended/lib/hypeWall_extended.php');
	
	// extend CSS
	elgg_extend_view('css/elgg', 'hypeWall_extended/css');
	elgg_register_css('hypeWall_extended_css', elgg_get_site_url().'mod/' . HYPEWALL_EXTENDED_ID . '/views/default/hypeWall_extended/hypeWall_extended.css');
	
	// load awesome fonts
	elgg_register_css('hypeWall_extended_awesome', elgg_get_site_url().'mod/' . HYPEWALL_EXTENDED_ID . '/vendors/font-awesome/css/font-awesome.css');
	elgg_load_css('hypeWall_extended_awesome');
	
	// extend JS
	elgg_extend_view('js/elgg', 'js/hypeWall_extended/set_css_options');

	
	// actions
	//elgg_register_action("wall/events", dirname(__FILE__) . "/../event_manager/actions/event/edit.php"); // obs
	  
}
