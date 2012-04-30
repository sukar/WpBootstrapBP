<?php
/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate 
 */

class XYAdminTabs {
  private $cfg;
  
  function __construct()
  {
    $this->init();
  }

  function init()
  {
    $this->cfg = array();
  }

  function getName()
  {
  }

  function getTabOptions() 
  {
  }

  function printSection() 
  {
  }

  function printFields() 
  {
  }

  function validate($input) 
  {
    return $input;
  }

  function currentTab($tab = "General")
  {
    $tabget = "General";
    if (isset($_GET['tab'])) {
      $tabget = $_GET['tab'];
    }
    if ($tab == $tabget) {
      return true;
    }
    return false;
  }

}
