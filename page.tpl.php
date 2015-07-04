<?php
// $Id: page.tpl.php,v 1.28 2008/01/24 09:42:52 goba Exp $
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>" xmlns:fb="http://www.facebook.com/2008/fbml">

  <head>
    <title><?php print $head_title ?></title>
  
    <?php print $head ?>
    <?php print $styles ?>
    <?php print $scripts ?>
    <?php require ('includes/box_layout.php');?>
    <?php 
      $layout_style = theme_get_setting('layout_style');
      $width_style = theme_get_setting('width_style');
      $fixedwidth = theme_get_setting('fixedwidth');
      $leftwidth = theme_get_setting('leftwidth');
      $rightwidth = theme_get_setting('rightwidth');
      $color = theme_get_setting('color');
      $font_family = theme_get_setting('font_family');
      $font_size = theme_get_setting('font_size');
      $menu_style = theme_get_setting('menu_style');
      $show_breadcrumb = theme_get_setting('show_breadcrumb');
      $use_default_banner = theme_get_setting('use_default_banner');
    ?>

<!-- If Superfish Enabled -->  
    	
    <?php if  ($menu_style == 1) { ?>
	  <script type="text/javascript">	
        $(document).ready(function(){
          $("#primary-links .menu").superfish({
            animation : { opacity: "show", width: "show", height: "show" }
          });
        });
	  </script> 
    <?php } ?>
    
 
<!-- User Controlled Layout -->    
    <?php 
      if ($layout_style == 1) { 
        require ('css/news_css.php');
      } 
      else if ($layout_style == 2) {
        require ('css/blog_css.php');
      }
      else {
        require ('css/portal_css.php');
      }
	
      $logo_color = '';

      switch ($color) {
  	    case 0:
	        $logo_color = 'default';
	        break;
	      case 1:
	   	    $logo_color = 'blue';
          break;
	      case 2:
		      $logo_color = 'green';
		      break;
	      default:
		      $logo_color = '';
      }
    ?>

    <!--[if lte IE 6]>
  <link type="text/css" rel="stylesheet" media="all" href="<?php print $base_path ?>sites/all/themes/pluraltheme/css/default-style-ie.css"/>
    <script type="text/javascript"> 
      $(document).ready(function(){ 
        $(document).pngFix(); 
      }); 
    </script> 
	<script type="text/javascript" src="<?php print $base_path ?>sites/all/themes/pluraltheme/js/suckerfish.js?8"></script>
    <![endif]-->
	<!--[if IE]>
	<style type="text/css">.width33 { width: 33.3%; }</style>
	<![endif]-->
  </head>

  <body<?php print phptemplate_body_class($left, $right); ?>>

  <div id="page-wrapper">
  <!-- Primary and Secondary Links -->
	<?php if ($primary): ?>
	  <div id="primary-links" class="clear-block">
      <?php if ($user->uid): ?>
        <div id="user-name">
          <span><?php print $user->name ?></span> | 
          <span><?php print l('logout', 'logout', array('attributes' => array('class' => 'logoutlink'))) ?></span>
        </div>
        <div class="user-append"></div>
      <?php endif; ?>
      <?php print $primary ?>
	  </div>
    <?php endif; ?>

    <?php if ($secondary): ?>
	  <div id="secondary-links" class="clear-block">
        <?php print $secondary ?>
	  </div>
    <?php endif; ?>
  
  <div id="header-wrapper" class="clear-block">

<!-- If Site Logo Enabled -->
    <?php if ($logo) { ?>
	  <div id="site-logo">
        <a href="<?php print $base_path ?>" title="<?php print t('Home') ?>"><img src="<?php print $base_path ?>sites/all/themes/pluraltheme/images/logo-<?php echo $logo_color ?>.png" alt="<?php print t('Home') ?>" /></a>
		  <?php if ($site_slogan) { ?>
		    <div class='site-slogan'>
		      <h2>
			    <?php print $site_slogan ?>
			  </h2>
		    </div>
		  <?php } ?>
	  </div>
	<?php } ?>
	  
<!-- If Site Name Enabled -->	 
	<?php if ($site_name) { ?>
	  <div id="site-name">
	    <a href="<?php print $front_page ?>" title="<?php print t('Home') ?>"><?php print $site_name ?></a>
	      <?php if ($site_slogan) { ?>
	        <div class='site-slogan'>
		      <h2><?php print $site_slogan ?></h2>
		    </div>
		  <?php } ?>
	  </div>
	<?php } ?>

<!-- Top Right Banner -->	
	<?php if ($topbanner) { ?>
	  <div id="topbanner">
	    <?php print $topbanner; ?>
	  </div>
	<?php } ?>
	  
	<?php if ($use_default_banner) { ?>
	  <div id="topbanner-default">
      <img src="<?php print $base_path ?>sites/all/themes/pluraltheme/images/topbanner.jpg" />
	  </div>
	<?php } ?>

  </div><!-- End of header-wrapper -->
	

<!-- Top User Regions -->
    <?php if ($user1 || $user2 || $user3) { ?>
      <div id="topboxes" class="clear-block">
	    <?php if ($user1) { ?>
		  <div class="userbox <?php echo $topBoxes; ?>">
		    <div class="userbox-inner">
              <?php print $user1 ?>
		    </div>
		  </div>
        <?php }?>
        <?php if ($user2) { ?>
		  <div class="userbox <?php echo $topBoxes; ?>">
		    <div class="userbox-inner">
              <?php print $user2 ?>
	        </div>
		  </div>
        <?php }?>
        <?php if ($user3) { ?>
		  <div class="userbox <?php echo $topBoxes; ?>">
		    <div class="userbox-inner">
              <?php print $user3 ?>
		    </div>
		  </div>
        <?php }?>
      </div><!-- End of Top User Regions -->
    <?php } ?>
	
<!-- Main Layout Div & Conditional Statement -->        
    <div id="middle-wrapper" class="clear-block">
      <?php
		if ($layout_style == 1) { 
		  require ('includes/news.php');
		} elseif ($layout_style == 2) {
		  require ('includes/blog.php');
		}
		  else {
	      require ('includes/portal.php');
		}
	  ?>	  
    </div>

<!-- Bottom User Regions -->
    <?php if ($user4 || $user5 || $user6) { ?>
      <div id="bottomboxes" class="clear-block">
	    <?php if ($user4) { ?>
	      <div class="userbox-bottom <?php echo $bottomBoxes; ?>">
		    <div class="userbox-bottom-inner">
              <?php print $user4 ?>
		    </div>
		  </div>
        <?php }?>
        <?php if ($user5) { ?>
	      <div class="userbox-bottom <?php echo $bottomBoxes; ?>">
		    <div class="userbox-bottom-inner">
              <?php print $user5 ?>
		    </div>
	  	</div>
        <?php }?>
        <?php if ($user6) { ?>
	      <div class="userbox-bottom <?php echo $bottomBoxes; ?>">
		    <div class="userbox-bottom-inner">
              <?php print $user6 ?>
		    </div>
		  </div>
        <?php }?>
      </div><!-- End of Bottom User Regions --> 
    <?php } ?>   
  
<!-- The All Knowing All Seeing Footer Block -->
    <?php if ($footer) { ?>
	  <div id="footer" class="clear-block">
	    <?php print $footer ?>
	  </div>
	<?php } ?>
	
	<div style="text-align: center; padding: 5px;">
	  <a href="http://www.greenlandtechnology.com/"> A GreenLand Technologies SMS Company </a>
	</div>

<!-- Script Closure -->
    <?php print $closure ?>
  
  </div><!-- End of page-wrapper -->
  </body>
</html>
