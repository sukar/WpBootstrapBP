<?php
/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate 
 */

class XYAdminTabBrand extends XYAdminTabs {
  
  function __construct()
  {
    $this->cfg = array(
      'title' => 'Branding',
      'field' => array(
        'textbox2' => array(
          'label' => "Text No.2",
          'type' => "text",
          'value' => "textbox 2" 
          )
        )
    );
  }
  
  function printSection() 
  {
    echo '<h2>Section Branding</h2>';
  }

  function printFields() {
    $options = $this->getTabOptions();
    foreach ($options as $name => $value) {
      echo '<input id="'.XY.'_Brand_'.$name.'" name="'.XY.'_S_Brand['.$name.']" size="40" type="'.$this->cfg['field'][$name]['type'].'" value="'.$value.'" />';
    }
  }

  function getTabOptions() 
  {
    $cfg = array();
    foreach ( $this->cfg['field'] as $key => $keyarray ) {
      $cfg[$key] = $keyarray['value'];
    }
    $options = wp_parse_args(get_option(XY.'_S_Brand', array()), $cfg);
    return $options;
  }

  function validate($input) 
  {
    unset($input['submit-Brand']);
    unset($input['reset-Brand']);
    return $input;
  }
}