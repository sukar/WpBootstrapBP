<?php

/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate 
 */

class XYAdmin extends XYHelper {

    var $xytTabs = array(),
        $xytTabObj = array(),
        $xytKey = "_XYThemes_Key",
        $xytLnk = "_XYThemes_Lnk",
        $xytJson = "_XYThemes_Jsn",
        $xytNow = "";

    function __construct() 
    {
        parent::__construct();
        $this->registerapi();
    }

    function registerapi() 
    {
        $this->xytTabs = $this->get_settings_page_tabs();
        register_sidebar(array(
            'name' => __('Left Sidebar', 'xythemes'),
            'id' => 'sidebar-1',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>'));

        register_sidebar(array(
            'name' => __('Right Sidebar', 'xythemes'),
            'id' => 'sidebar-2',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>'));

        add_action('init', array(&$this, 'register_post_gallery'));

        register_nav_menus(
                array(
                    'main_menu' => 'Main Menu',
                    'futr_menu' => 'Bottom Menu'
                )
        );

        add_filter('wp_page_menu_args', array(&$this, 'main_menu_args'));

        if ( is_admin() ){ // admin actions
          // Load the Admin Options page
          add_action('admin_menu', array(&$this, 'menu_options'));

          // Settings API options initilization and validation
          add_action( 'admin_init', array(&$this, 'register_options'));
        }

    }

    function register_post_gallery() 
    {
      register_post_type( XY.'_gallery',
        array(
          'labels' => array(
          'name' => __('Gallery'),
          'singular_name' => __('Gallery')
          ),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'gallery')
          )
      );
    }

    // Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
    function main_menu_args( $args ) 
    {
      $args['show_home'] = true;
      return $args;
    }

    function menu_options() 
    {
      add_theme_page(XYNAME.' Settings', XYNAME , 'edit_theme_options', XY, array(&$this, 'admin_options_page'));
    }

    function register_options_old(){
      // add_settings_section($id, $title, $callback, $page)
      add_settings_section(XY.'_sections', 'Theme Section', array(&$this, 'plugin_section_text'), XY);
      // add_settings_field($id, $title, $callback, $page, $section = 'default', $args = array())
      add_settings_field(XY, 'Theme Fields', array(&$this, 'plugin_setting_string'), XY, XY.'_sections');
      // register_setting( $option_group, $option_name, $sanitize_callback )
      register_setting(XY, XY, array(&$this, 'options_validate'));
    }

    function register_options(){
      foreach ($this->xytTabs as $name => $label) {
        $classname = 'XYAdminTab'.$name;
        $this->loadclass($classname);
        $this->xytTabObj[$name] = new $classname;

        // register_setting( $option_group, $option_name, $sanitize_callback )
        register_setting(XY, XY.'_S_'.$name, array(&$this->xytTabObj[$name], 'validate'));

        // add_settings_section($id, $title, $callback, $page)
        add_settings_section(XY.'_S_'.$name, $label.' Section', array(&$this->xytTabObj[$name], 'printSection'), XY);

        // add_settings_field($id, $title, $callback, $page, $section = 'default', $args = array())
        add_settings_field(XY.'_F_'.$name, $label.' Fields', array(&$this->xytTabObj[$name], 'printFields'), XY, XY.'_S_'.$name);
        
      }
    }

    function plugin_section_text() 
    {
      echo '<p>Main description of this section here.</p>';
    }

    function plugin_setting_string() {
      $fieldname = XY;
      //$options = get_option($fieldname);
      $options = $this->get_theme_options();
      echo '<input id="plugin_text_string" name="'.$fieldname.'[plugin_text_string]" size="40" type="text" value="'.$options['plugin_text_string'].'" />';
    }

    function admin_options_page() 
    { ?>
         <div class="wrap">
              <?php $this->admin_options_page_tabs(); ?>
              <?php if ( isset( $_GET['settings-updated'] ) ) {
                   echo '<div class="updated"><p>Theme settings updated successfully.</p></div>';
              } ?>
         <form action="options.php" method="post">
         <?php
         $tab = ( isset( $_GET['tab'] ) ? $_GET['tab'] : 'General' );
         $fieldname = XY.'_S_'.$tab;
         // Implement settings field security, nonces, etc.
         settings_fields(XY);
         do_settings_sections(XY);
         ?>
         <?php  ?>
         <!-- <input name="<?php echo $fieldname; ?>[option1]" type="checkbox" value="1" <?php checked('1', $options['option1']); ?> />
         <input name="<?php echo $fieldname; ?>[sometext]" size="40" type="text" value="<?php echo $options['sometext']; ?>" /> -->
         <input name="<?php echo $fieldname; ?>[submit-<?php echo $tab; ?>]" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', XY); ?>" />
         <input name="<?php echo $fieldname; ?>[reset-<?php echo $tab; ?>]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', XY); ?>" />
         </form>
         </div>
    <?php }

    
    function options_validate($input) 
    {
      //var_dump($input);exit('test');
      //$input['option1'] = ($input['option1'] == 1 ? 1 : 0);          //either 0 or 1
      //$input['sometext'] =  wp_filter_nohtml_kses($input['sometext']); //safe text with no HTML tags
      return $input;
    }

    function get_settings_page_tabs() 
    {
      $cfg = $this->getxyconfig();
      return $cfg['tabs'];
    }

    function admin_options_page_tabs( $current = 'general' ) 
    {
      if ( isset ( $_GET['tab'] ) ) :
          $current = $_GET['tab'];
      else:
          $current = 'general';
      endif;
      $tabs = $this->xytTabs;//$this->get_settings_page_tabs();
      $links = array();
      foreach( $tabs as $tab => $name ) :
          if ( $tab == $current ) :
               $links[] = '<a class="nav-tab nav-tab-active" href="?page='.XY.'&tab='.$tab.'">'.$name.'</a>';
          else :
               $links[] = '<a class="nav-tab" href="?page='.XY.'&tab='.$tab.'">'.$name.'</a>';
          endif;
      endforeach;
      echo '<div id="icon-themes" class="icon32"><br /></div>';
      echo '<h2 class="nav-tab-wrapper">';
      foreach ( $links as $link )
          echo $link;
      echo '</h2>';
    }
}