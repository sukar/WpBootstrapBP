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
      // adjust values here
      $id = "img1"; // this will be the name of form field. Image url(s) will be submitted in $_POST using this key. So if $id == “img1” then $_POST[“img1”] will have all the image urls
      $svalue = ""; // this will be initial value of the above form field. Image urls.
      $multiple = true; // allow multiple files upload //plupload-upload-uic-multiple
      $width = null; // If you want to automatically resize all uploaded images then provide width here (in pixels)
      $height = null; // If you want to automatically resize all uploaded images then provide height here (in pixels)

      echo '<label>Upload Images</label>';
      echo '<input type="hidden" name="'.$id.'" id="'.$id.'" value="'.$svalue.'" />';
      echo '<div class="plupload-upload-uic hide-if-no-js" id="'.$id.'plupload-upload-ui">';
      echo '<input id="'.$id.'plupload-browse-button" type="button" value="'.esc_attr('Select Files').'" class="button" />';
      echo '<span class="ajaxnonceplu" id="ajaxnonceplu'.wp_create_nonce($id . 'pluploadan').'"></span>';
      if ($width && $height) {
        echo '<span class="plupload-resize"></span><span class="plupload-width" id="plupload-width'.$width.'"></span>';
        echo '<span class="plupload-height" id="plupload-height'.$height.'"></span>';
      }
      echo '<div class="filelist"></div>';
      echo '</div>';
      echo '<div class="plupload-thumbs plupload-thumbs-multiple" id="'.$id.'plupload-thumbs">';
      echo '</div>';
      echo '<div class="clear"></div>';     
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