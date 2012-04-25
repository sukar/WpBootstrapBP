<?php
/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate 
 */

class XYAdminTabGeneral extends XYAdminTabs {
  
  function __construct()
  {
    $this->cfg = array(
      'title' => 'General',
      'field' => array(
        'textbox1' => array(
          'label' => "Text No.1",
          'type' => "text",
          'value' => "textbox 1" 
          )
        )
    );
  }
  
  function printSection() 
  {
    echo '<h2>Section General</h2>';
  }

  function printFields() {
    $options = $this->getTabOptions();
    foreach ($options as $name => $value) {
      echo '<input id="'.XY.'_General_'.$name.'" name="'.XY.'_S_General['.$name.']" size="40" type="'.$this->cfg['field'][$name]['type'].'" value="'.$value.'" />';
    }
  }

  function getTabOptions() 
  {
    $cfg = array();
    foreach ( $this->cfg['field'] as $key => $keyarray ) {
      $cfg[$key] = $keyarray['value'];
    }
    $options = wp_parse_args(get_option(XY.'_S_General', array()), $cfg);
    return $options;
  }

  function validate($input) 
  {
    unset($input['submit-General']);
    unset($input['reset-General']);
    return $input;
  }
}
