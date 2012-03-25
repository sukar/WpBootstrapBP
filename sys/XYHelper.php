<?php

/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate 
 */
class XYHelper extends XYConfig {

    private $xythemeNavMenu = "";

    function __construct() {
        parent::__construct();
        $this->xythemeNavMenu = "XYNavMenu";
    }

    function getThemeNavMenu() {
        $this->loadclass($this->xythemeNavMenu);
        return new $this->xythemeNavMenu;
    }

    function loadclass($classname) {
        if (file_exists(XYTHEMESDIR . '/sys/' . $classname . '.php')) {
            include XYTHEMESDIR . '/sys/' . $classname . '.php';
        } else {
            throw new Exception("$classname.php not found.");
        }
    }

    static function xy_page_menu($args = array()) {
        $defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
        $args = wp_parse_args($args, $defaults);
        $args = apply_filters('wp_page_menu_args', $args);

        $menu = '';

        $list_args = $args;

        // Show Home in the menu
        if (!empty($args['show_home'])) {
            if (true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'])
                $text = __('Home');
            else
                $text = $args['show_home'];
            $class = '';
            if (is_front_page() && !is_paged())
                $class = 'class="active"';
            $menu .= '<li ' . $class . '><a href="' . home_url('/') . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
            // If the front page is a page, add it to the exclude list
            if (get_option('show_on_front') == 'page') {
                if (!empty($list_args['exclude'])) {
                    $list_args['exclude'] .= ',';
                } else {
                    $list_args['exclude'] = '';
                }
                $list_args['exclude'] .= get_option('page_on_front');
            }
        }

        $list_args['echo'] = false;
        $list_args['title_li'] = '';
        $menu .= str_replace(array("\r", "\n", "\t"), '', wp_list_pages('title_li=&echo=0'));

        if ($menu)
            $menu = '<ul class="nav">' . $menu . '</ul>';

        $menu = '<div class="nav-collapse collapse">' . $menu . "</div>\n";
        $menu = apply_filters('wp_page_menu', $menu, $args);
        if ($args['echo'])
            echo $menu;
        else
            return $menu;
    }

}

?>
