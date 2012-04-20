<?php
/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate */
define('XY', "xythemes");
define('XYNAME', "XY Themes");
define('XYTHEMESDIR', get_template_directory());
require XYTHEMESDIR.'/sys/XYConfig.php';
$xythemesObj = new XYThemes;