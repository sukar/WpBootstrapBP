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

    function __construct() {
        parent::__construct();
        $this->registerapi();
    }

    function registerapi() {
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
    }
    
        /*
     * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
     */
    function main_menu_args( $args ) {
      $args['show_home'] = true;
      return $args;
    }
    
    function register_post_gallery() {
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

}

?>
