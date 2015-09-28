<?php
/**
 * Elgg hypeWall Extended
 * @package hypeWall_extended 
 */

$plugin = elgg_get_plugin_from_id('hypeWall_extended');

$potential_yes_no = array(
    HYPEWALL_EXTENDED_GENERAL_YES => elgg_echo('hypeWall_extended:settings:yes'),
    HYPEWALL_EXTENDED_GENERAL_NO => elgg_echo('hypeWall_extended:settings:no'),
);  

$sizes = array(
	75 => elgg_echo('75%'),
    100 => elgg_echo('100%'),
    125 => elgg_echo('125%'),
    150 => elgg_echo('150%'),
    175 => elgg_echo('175%'),
    200 => elgg_echo('200%'),
    225 => elgg_echo('225%'),
    250 => elgg_echo('250%'),
    275 => elgg_echo('275%'),
    300 => elgg_echo('300%'),
);

$icon_size = (is_numeric($plugin->icon_size)?$plugin->icon_size:100);
$general = '<div style="display:block; width:100%; margin: 10px 0;">';
$general .= "<span class=''><strong>" . elgg_echo('hypeWall_extended:settings:icon_size') . "</strong>: </span>";
$general .= elgg_view('input/dropdown', array('name' => 'params[icon_size]', 'value' => $icon_size, 'options_values' => $sizes));
$general .= "<span class='elgg-subtext'>" . elgg_echo('hypeWall_extended:settings:icon_size:note') . "</span>";
$general .= '</div>';

echo elgg_view_module("inline", elgg_echo('hypeWall_extended:settings:general'), $general);



$content = '';

// array of plugins which are support
$plugins_arr = array('videolist','poll','event_manager', 'blog');

foreach($plugins_arr as $pl) {
	
	if (elgg_is_active_plugin($pl)) {
		$pl_name = 'params['.$pl.']';
		$pl_value = $plugin->$pl;
		if (empty($pl_value)){
			$pl_value = HYPEWALL_EXTENDED_GENERAL_YES;
		}    

		$content .= '<div style="display:block; width:100%; margin: 10px 0;">';
		$content .= "<span class=''><strong>" . elgg_echo('hypeWall_extended:settings:'.$pl) . "</strong>: </span>";
		$content .= elgg_view('input/dropdown', array('name' => $pl_name, 'value' => $pl_value, 'options_values' => $potential_yes_no));
		$content .= "<span class='elgg-subtext'>" . elgg_echo('hypeWall_extended:settings:'.$pl.':note') . "</span>";
		$content .= '</div>';		
	}
	
} 

echo elgg_view_module("inline", elgg_echo('hypeWall_extended:settings:entities'), $content);  

