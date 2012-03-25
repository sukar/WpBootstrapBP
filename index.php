<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage XY Themes - Bootstrap plus HTML5 Boilerplate
 */

// get params
$xyleft = 4;
$xyright = 4;
$xymain = 12;
$xymainfull = $xymain;
$xylayout = 'leftmainright';
$xyslide = "";
$bodyvar = "inside";

if(is_active_sidebar('sidebar-1')) {
  $xymain -= $xyleft;
} else {
  $xyleft = 0;
}
if(is_active_sidebar('sidebar-2')) {
  $xymain -= $xyright;
} else {
  $xyright = 0;
}
get_header();
?>
<div id="main" role="main">
  <div class="container">
    <div class="xyplane">
	  <div class="row">
		<?php if($xylayout == "leftmainright" || $xylayout == "leftrightmain"):?>
		  <?php if($xyleft):?>
			<div class="span<?php echo $xyleft;?> xyleft"><?php dynamic_sidebar('sidebar-1'); ?></div>
		  <?php endif;?>
		<?php endif;?>
		<?php if($xylayout == "leftrightmain"):?>
		  <?php if($xyright):?>
			<div class="span<?php echo $xyright;?> xyright"><?php dynamic_sidebar('sidebar-2'); ?></div>
		  <?php endif;?>
		<?php endif;?>
		<div class="span<?php echo $xymain;?> xymain">
        
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div class="divblog" id="post-<?php the_ID(); ?>" <?php post_class();?>>
          <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <div class="entry">
            <?php the_content('Read more &raquo;'); ?>
            <?php echo 'The post type is: '.get_post_type( $post->ID ); ?>
            </div>
          </div>
          <?php endwhile; else : ?>          
          <script type="text/javascript">window.location="<?=bloginfo('url'); ?>/";</script>
          <h2 class="center">Not Found</h2><p class="center">Our apologies, please try again later. Cheers!</p>         
          <?php endif; ?> 
          
          
          <div id="myModal" class="modal hide fade" style="display: none; ">
            <div class="modal-header">
              <a class="close" data-dismiss="modal">×</a>
              <h3>Modal Heading</h3>
            </div>
            <div class="modal-body">
              <h4>Text in a modal</h4>
              <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem.</p>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn btn-primary">Save changes</a>
              <a href="#" class="btn" data-dismiss="modal">Close</a>
            </div>
          </div>
        
		</div>
		<?php if($xylayout == "mainleftright"):?>
		  <?php if($xyleft):?>
			<div class="span<?php echo $xyleft;?> xyleft"><?php dynamic_sidebar('sidebar-1'); ?></div>
		  <?php endif;?>
		<?php endif;?>
		<?php if($xylayout == "leftmainright" || $xylayout == "mainleftright"):?>
		  <?php if($xyright):?>
			<div class="span<?php echo $xyright;?> xyright"><?php dynamic_sidebar('sidebar-2'); ?></div>
		  <?php endif;?>
		<?php endif;?>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>