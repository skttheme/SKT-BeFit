<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package SKT BeFit
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(''); ?>>
<?php wp_body_open(); ?>
<div id="wrapper">
<?php 
	$contact_no = get_theme_mod('contact_no'); 
	$contact_mail = get_theme_mod('contact_mail');
	$fb_link = get_theme_mod('fb_link'); 
	$twitt_link = get_theme_mod('twitt_link');
	$insta_link = get_theme_mod('insta_link');
	$linked_link = get_theme_mod('linked_link');
?> 
<?php if(!empty($contact_no) || !empty($contact_mail) || !empty($fb_link) || !empty($twitt_link)  || !empty($insta_link)  || !empty($linked_link)){?>
  <div class="topbararea">
    <div class="topfirstbar">
      <div class="topbarleft">
        <?php if(!empty($contact_mail)){?> 
        <div class="email-top">
          <a href="mailto:<?php echo esc_attr( antispambot(sanitize_email($contact_mail ))); ?>"><?php echo esc_html( antispambot($contact_mail)); ?></a>
        </div>
		<?php } ?>
        <div class="social-top social">
         <?php if (!empty($fb_link)) { ?>
          <a target="_blank" href="<?php echo esc_url($fb_link); ?>" title="Facebook" >
          <div class="fb icon"></div>
          </a>
          <?php } ?>
          <?php if (!empty($twitt_link)) { ?>
          <a target="_blank" href="<?php echo esc_url($twitt_link); ?>" title="Twitter" >
          <div class="twitt icon"></div>
          </a>
          <?php } ?>
		  <?php if (!empty($insta_link)) { ?>
          <a target="_blank" href="<?php echo esc_url($insta_link); ?>" title="Instagram" >
          <div class="insta icon"></div>
          </a>
          <?php } ?>
          <?php if (!empty($linked_link)) { ?>
          <a target="_blank" href="<?php echo esc_url($linked_link); ?>" title="Linkedin" >
          <div class="linkedin icon"></div>
          </a>
          <?php } ?>
        </div>
      </div>
      <div class="topbarright">
        <div class="top-phonearea">
          <?php if(!empty($contact_no)){?>
          <div class="top-phone"><?php echo esc_html($contact_no); ?></div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  <div class="header-inner header">
    <div class="site-aligner">
      <div class="logo">
		<?php skt_befit_the_custom_logo(); ?>
        <div class="clear"></div>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <h2><?php bloginfo('name'); ?></h2>
        <p><?php bloginfo( 'description' ); ?></p>                          
        </a>
    </div>
      <!-- logo -->
      <div class="mobile_nav"><a href="<?php esc_url('#');?>">
        <?php esc_attr_e('Go To...','skt-befit'); ?>
        </a></div>
      <div class="site-nav">
        <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
      </div>
      <!-- site-nav -->
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <!-- header-inner --> 
</div>
<!-- header -->
<?php 
if ( is_front_page() && is_home() ) { 
?>
<?php 
}
elseif ( is_front_page() ) { 
?>
<!-- Slider Section -->
<?php for($sld=1; $sld<4; $sld++) { ?>
<?php if( get_theme_mod('slide-setting'.$sld)) { ?>
<?php $slidequery = new WP_query('page_id='.get_theme_mod('slide-setting'.$sld,true)); ?>
<?php while( $slidequery->have_posts() ) : $slidequery->the_post();
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
$img_arr[] = $image;
$id_arr[] = $post->ID;
endwhile;
}
}
if(!empty($id_arr)){ ?>
<section id="home_slider">
  <div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
      <?php 
	$i=1;
	foreach($img_arr as $url){ ?>
      <img src="<?php echo esc_url($url); ?>" title="#slidecaption<?php echo esc_html($i); ?>" />
      <?php $i++; }  ?>
    </div>
    <?php 
    $i=1;
    foreach($id_arr as $id){// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited 
    $title = get_the_title( $id );// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited 
    $post = get_post($id);// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
    $content = apply_filters('get_the_content', substr(strip_tags($post->post_content), 0, 250)); 
    ?>
    <div id="slidecaption<?php echo esc_html($i); ?>" class="nivo-html-caption">
      <div class="slide_info">
        <h2><a href="<?php the_permalink(); ?>"><?php echo esc_html($title); ?></a></h2>
        <p><?php echo esc_html($content); ?></p>
        <div class="clear"></div>
        <div class="slide_more"><a href="<?php the_permalink(); ?>">
          <?php esc_attr_e('Train With Amanda','skt-befit');?>
          </a></div>
      </div>
    </div>
    <?php $i++; } ?>
  </div>
  <div class="clear"></div>
</section>
<?php } ?>
<div class="feature-box-main site-aligner">
  <?php 
	  	 for($tbx=1; $tbx<5; $tbx++) {
		 if( get_theme_mod('page-setting'.$tbx)) { 
		 $threeboxquery = new WP_query('page_id='.get_theme_mod('page-setting'.$tbx,true)); 
		 while( $threeboxquery->have_posts() ) : $threeboxquery->the_post(); ?>
  <div class="feature-box"> <a href="<?php the_permalink(); ?>">
    <?php the_post_thumbnail(); ?>
    <h2>
      <?php the_title(); ?>
    </h2>
    <span></span> <?php the_excerpt(); ?> </a><a class="read-more" href="<?php the_permalink(); ?>">
    <?php esc_attr_e('Read More','skt-befit');?>
    </a> </div>
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
  <?php }  } ?>
  <div class="clear"></div>
</div>
<?php
}
elseif ( is_home() ) {	
?>
<?php
}
?>
