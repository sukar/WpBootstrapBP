<?php
/**
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate
 */
global $xylayout, $xythemesObj;//var_dump($GLOBALS);
//echo XYTHEMESPDIR.' from header > '.$xylayout;
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<!-- does not show document mode in developer tools of ie9 -->
<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css" />
<link rel="stylesheet/less" href="<?php bloginfo('template_directory'); ?>/style.less">
<script src="<?php bloginfo('template_directory'); ?>/js/libs/less-1.2.2.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/libs/modernizr-2.5-respond-1.1.0.min.js"></script>
<?php wp_head(); ?>
</head>
<body class="<?php echo $bodyvar;?>">
<header class="<?php echo $xyslide;?>">
	<div class="container">
    <div class="xyplane">
      <div class="navbar">
        <div class="navbar-inner">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">Menu</a>
			<a class="icon-white icon-home btn-icobar" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
			<a class="icon-white icon-map-marker btn-icobar" href="#myModal" data-toggle="modal">Map</a>
			<a class="icon-white icon-envelope btn-icobar" href="#myModal" data-toggle="modal">Email</a>
			<a class="icon-white icon-phone btn-icobar" href="tel:5449002">Phone</a>
			<?php
			wp_nav_menu( 
				array( 
					'menu_class' => 'nav',
					'theme_location' => 'main_menu', /* where in the theme it's assigned */
					'container'	=> 'div',
					'container_class' => 'nav-collapse collapse', 
					'walker' => $xythemesObj->getThemeNavMenu(),
					'fallback_cb' => 'XYThemes::xy_page_menu'
				)
			);
			?>
			<?php if(0):?>
			<div class="nav-collapse collapse" style="height:0px; ">
			  <ul class="nav">
			  <li class="active"><a href="#">Home</a></li>
			  <li><a href="#about">About</a></li>
			  <li><a href="#contact">Contact</a></li>
			  </ul>
			</div><!--/.nav-collapse -->
			<?php endif;?>
        </div>
      </div>
	  <div class="row">
		<div class="span<?php echo $xymainfull/2;?>">		
			<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php echo '<span>'.esc_attr( get_bloginfo( 'name', 'display' ) ).'</span>';?></a></h1>	
		</div>
		<div class="span<?php echo $xymainfull/2;?>">
			<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>
	  </div>	  
	  <div class="row">
		<div class="span<?php echo $xymainfull;?>">
		xyslide
		</div>
	  </div>
    </div>
  </div>
</header>
