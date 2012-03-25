<?php
/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate */

define('XYTHEMESDIR', get_template_directory());
require XYTHEMESDIR.'/sys/XYConfig.php';

if (!class_exists("XYThemes")) {
  class XYThemes extends XYView {
      
    function __construct()
    {
        parent::__construct();
    }
     
  }
}
if (class_exists("XYThemes")) {
  $xythemesObj = new XYThemes();
}
?>