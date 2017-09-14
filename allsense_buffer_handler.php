<?php
/**
 * Setup AllSense buffer handler
 */
function allsense_optimize($buffer) {
	
	// modify buffer here, and then return the updated code
	// $buffer = str_replace (
	//	'<head>',
	//	'<!--///////////////////////////////// = allsense_optimize well done = ////////////////////////////////////////--><head>',
	//	$buffer
	//	);


	$replace = array(
		'/<head>/'					=>	'<!--////// = allsense_optimize well done! = //////--><head>',

		'/<strong>(.*?)<\/strong>/'	=>	'<span class="strong">$1</span>',
		'/<b>(.*?)<\/b>/'			=>	'<span class="strong">$1</span>',
		'/<em>(.*?)<\/em>/'			=>	'<span class="italic">$1</span>',
		'/<i>(.*?)<\/i>/'			=>	'<span class="italic">$1</span>',
	);

	foreach ( $replace as $key => $value ) {
		$buffer = preg_replace ( $key , $value , $buffer );
	}


	return $buffer;
}
function buffer_start() { ob_start("allsense_optimize"); }
function buffer_end() { ob_end_flush(); }
add_action('init', 'buffer_start');
add_action('shutdown', 'buffer_end');
