<?php
/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate */
define('XY', "XYThemes_");
define('XYTHEMESDIR', get_template_directory());
require XYTHEMESDIR.'/sys/XYConfig.php';

$class = XY;
$xythemesObj = new $class;