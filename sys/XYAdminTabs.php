<?php
/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate 
 */

class XYAdminTabs {
  private $cfg = array();
  
  function printSection() 
  {
    echo '<h2>Section Abstract</h2>';
  }

  function printFields() {
    echo '<input id="'.XY.'_abstract" name="'.XY.'[abstract]" size="40" type="hidden" value="'.XY.'" />';
  }

  function getTabOptions() 
  {
    return array();
  }

  function validate($input) 
  {
    return $input;
  }

}
