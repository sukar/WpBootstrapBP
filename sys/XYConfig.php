<?php

/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate 
 */
require XYTHEMESDIR . '/sys/XYHelper.php';
require XYTHEMESDIR . '/sys/XYAdminTabs.php';
require XYTHEMESDIR . '/sys/XYAdmin.php';
require XYTHEMESDIR . '/sys/XYView.php';
require XYTHEMESDIR . '/sys/XYThemes.php';

class XYConfig {

    private $xyconf = array();

    function __construct() {
        $this->initconfig();
    }

    function initconfig() {
        if (file_exists(XYTHEMESDIR . '/sys/XYConfigFile.php')) {
            include XYTHEMESDIR . '/sys/XYConfigFile.php';
            $this->xyconf = array_merge($this->xyconf, $xyconf);
            unset($xyconf);
        } else {
            die('Configuration file (XYConfigFile) not found!');
        }
    }

    function getxyconfig() {
        return $this->xyconf;
    }

    function get_theme_options() 
    {
      $cfg = $this->getxyconfig();
      //$option_defaults = $defaults;//oenology_get_option_defaults();
      $options = wp_parse_args(get_option(XY, array()), $cfg['defaults']);
      return $options;
    }

}