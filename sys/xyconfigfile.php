<?php
/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate 
 */

// About Me
$xyconf['theme_title'] = "XY Themes Bootstrap plus HTML5 Boilerplate";
$xyconf['version'] = "0.1.0";
$xyconf['author'] = "Marco A. Hermo";
$xyconf['email'] = "Marcz@lab1521.com";

// About Bootstrap
$xyconf['gridColumns'] = 12;
$xyconf['gridColumnWidth'] = 60;
$xyconf['gridGutterWidth'] = 20;
$xyconf['sidebarLeftColumns'] = 4;
$xyconf['sidebarRightColumns'] = 4;

// About Wordpress
// Settings API
$xyconf['tabs'] = array(
		'general' => 'General'
	);
// Template
$xyconf['defaults'] = array(
    'type' => 'post',
    'option1' => "0",
    'plugin_text_string' => "test1",
    'echo' => TRUE
  );
$xyconf['default'] = array(
		'general' => array(
				'title' => 'General',
				'field' => array(
					''
					)
			)
	);

$xyconf['sidebarPositions'] = 'leftmainright';
$xyconf['logo'] = "";
$xyconf['font'] = "san-serif";
$xyconf['pattern'] = "";
$xyconf['bgcolor'] = "white";
$xyconf['color'] = "black";