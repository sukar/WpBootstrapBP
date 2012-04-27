<?php
/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate 
 */

class XYAdminTabGeneral extends XYAdminTabs {
  
  function __construct()
  {
    $this->cfg = array(
      'name' => "General",
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

  function getName()
  {
    return $this->cfg['name'];
  }
  
  function printSection() 
  {
    if ($this->currentTab($this->getName())) {
      echo '<h2>Section '.$this->cfg['title'].'</h2>';
    }
  }

  function printFields() {
    if ($this->currentTab($this->getName())) {
      $options = $this->getTabOptions();
      foreach ($options as $name => $value) {
        echo '<input id="'.XY.'_'.$this->getName().'_'.$name.'" name="'.XY.'_'.$this->getName().'['.$name.']" size="40" type="'.$this->cfg['field'][$name]['type'].'" value="'.$value.'" />';
      }       
    }
  }

  function getTabOptions() 
  {
    $cfg = array();
    foreach ( $this->cfg['field'] as $key => $keyarray ) {
      $cfg[$key] = $keyarray['value'];
    }
    $options = wp_parse_args(get_option(XY.'_'.$this->getName(), array()), $cfg);
    return $options;
  }

  function validate($input) 
  {
    if (isset($input['submit-'.$this->getName()])) unset($input['submit-'.$this->getName()]);
    if (isset($input['reset-'.$this->getName()]))  unset($input['reset-'.$this->getName()]);
    return $input;
  }
}