<?php

/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate 
 */
class XYAdmin extends XYHelper {

    var $xytKey = "_XYThemes_Key",
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

    // Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
    function main_menu_args( $args ) 
    {
      $args['show_home'] = true;
      return $args;
    }
    
    function register_post_gallery() 
    {
      register_post_type( 'xythemes_gallery',
          array(
              'labels' => array(
                  'name' => __( 'Gallery' ),
                  'singular_name' => __( 'Gallery' )
              ),
              'public' => true,
              'has_archive' => true,
              'rewrite' => array('slug' => 'gallery')
          )
      );
    }

    function menu_options() 
    {
      add_theme_page('XYTHemes Options', 'XYThemes', 'edit_theme_options', 'xythemes-settings', array(&$this, 'admin_options_page'));
    }

    function get_settings_page_tabs() 
    {
      $tabs = array(
          'general' => 'General',
          'personalize' => 'Personalize'
     );
     return $tabs;
    }

    function register_options(){
      // Register Settings
      register_setting( 'xythemes_options', 'xythemes_options', array(&$this, 'options_validate'));
    }

    function options_validate($input) 
    {
      return $input;
    }

    // Admin settings page markup
    function admin_options_page() 
    { ?>
         <div class="wrap">
              <?php $this->admin_options_page_tabs(); ?>
              <?php if ( isset( $_GET['settings-updated'] ) ) {
                   echo '<div class="updated"><p>Theme settings updated successfully.</p></div>';
              } ?>
         <form action="options.php" method="post">
         <?php
         settings_fields('xythemes_options');
         do_settings_sections('xythemes');
         ?>
         <?php $tab = ( isset( $_GET['tab'] ) ? $_GET['tab'] : 'general' ); ?>
         <input name="xythemes_options[submit-<?php echo $tab; ?>]" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'xythemes'); ?>" />
         <input name="xythemes_options[reset-<?php echo $tab; ?>]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'xythemes'); ?>" />
         </form>
         </div>
    <?php }

    function admin_options_page_tabs( $current = 'general' ) 
    {
      if ( isset ( $_GET['tab'] ) ) :
          $current = $_GET['tab'];
      else:
          $current = 'general';
      endif;
      $tabs = $this->get_settings_page_tabs();
      $links = array();
      foreach( $tabs as $tab => $name ) :
          if ( $tab == $current ) :
               $links[] = '<a class="nav-tab nav-tab-active" href="?page=xythemes-settings&tab='.$tab.'">'.$name.'</a>';
          else :
               $links[] = '<a class="nav-tab" href="?page=xythemes-settings&tab='.$tab.'">'.$name.'</a>';
          endif;
      endforeach;
      echo '<div id="icon-themes" class="icon32"><br /></div>';
      echo '<h2 class="nav-tab-wrapper">';
      foreach ( $links as $link )
          echo $link;
      echo '</h2>';
    }

}
