<?php
/**
 * Elgg hypeWall Extended
 * @package hypeWall_extended 
 */
 
$icon_size = elgg_get_plugin_setting('icon_size', 'hypeWall_extended');

if (!is_numeric($icon_size))
	$icon_size = 100;


?>

$(document).ready(function() {

	$(".wall-tab").css({
		fontSize: "<?php echo $icon_size; ?>%"
	});

});




