<?php
/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate 
 */

class XYTabs {
  private var $cfg,
              $defs;  
  
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
    $this->defs = array(
      'textbox1' => 'default text1 value'
    );
  }
  
  function printSection() 
  {
    echo '<h2>Section</h2>';
  }

  function printFields() {
    $options = $this->getTabOptions();
    foreach ($options as $name => $value) {
      echo '<input id="'.XY.'_'.$name.'" name="'.XY.'['.$name.']" size="40" type="'.$this->cfg['field'][$name]['type'].'" value="'.$value.'" />';
    }
  }

  function getTabOptions() 
  {
    $cfg = array();
    foreach ( $this->cfg['field'] as $key => $keyarray ) {
      $cfg[$key] = $keyarray['value'];
    }
    $options = wp_parse_args(get_option(XY, array()), $cfg);
    return $options;
  }
}

?>
