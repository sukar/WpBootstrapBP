<?php
/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate 
 */

class XYAdminTabBrand extends XYAdminTabs {

  function __construct()
  {
    parent::__construct();
    $this->init();
  }

  function init()
  {
    $this->cfg = array(
      'name' => "Brand",
      'title' => 'Branding',
      'field' => array(
        'textbox2' => array(
          'label' => "Text No.2",
          'type' => "text",
          'value' => "textbox 2" 
        ),
        'textcolor1' => array(
          'label' => "Text Color 1",
          'type' => "color",
          'value' => "ff00ee"
        ),
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
        echo '<div>';
        if ( $this->cfg['field'][$name]['type'] == "color") {
          echo '<div class="colorSelector"><div style="background-color: #'.$value.'"></div></div>';
          echo '<input id="'.XY.'_'.$this->getName().'_'.$name.'" name="'.XY.'_'.$this->getName().'['.$name.']" type="text" value="'.$value.'" class="colorInput" />';
        } else {
          echo '<input id="'.XY.'_'.$this->getName().'_'.$name.'" name="'.XY.'_'.$this->getName().'['.$name.']" type="'.$this->cfg['field'][$name]['type'].'" value="'.$value.'" />';
        }
        echo '</div>';
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