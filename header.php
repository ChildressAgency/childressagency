<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="">

  <meta http-equiv="cache-control" content="public">
  <meta http-equiv="cache-control" content="private">

  <title>The Childress Agency</title>

  <script>document.documentElement.classList.remove('no-js');</script>

  <?php wp_head(); ?>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> 
</head>

<body class="is-loading">

  <?php if(is_singular('project')): ?>

    <?php $brand_color = get_field('brand_color'); ?>

    <style>
      h2.brand-color,
      h3.brand-color{
        color:<?php echo $brand_color; ?>;
      } 
      .cs-pre-loader.brand-color,
      .cs-links.brand-color{
        background-color:<?php echo $brand_color; ?>;
      } 
      blockquote.brand-color:before{
        color:<?php echo $brand_color; ?>;
      }
      blockquote.brand-color:after{
        color:<?php echo $brand_color; ?>;
      }
    </style>
    <div id="pre-loader" class="full-screen cs-pre-loader brand-color">
    </div>

  <?php else: ?>

    <div id="pre-loader" class="full-screen pre-loader">
      <div class="pre-loader-logo">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/childress-icon-lg.png" alt="Childress Agency Logo" />
      </div>
      <span class="wiper"></span>
    </div>

  <?php endif; ?>

  <nav id="header-nav" class="navbar-fixed-top<?php if(!is_front_page()){ echo ' scroll-header'; } ?>">
    <div class="container">
      <div class="navbar-header<?php echo get_field('white_logo_background') ? ' white-nav' : ''; ?>">
        <a href="<?php echo esc_url(home_url()); ?>" class="navbar-brand text-hide">Childress Agency</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse<?php echo get_field('white_nav_background') ? ' white-nav' : ''; ?>">
        <?php 
          $header_nav_args = array(
            'theme_location' => 'header-nav',
            'menu' => '',
            'container' => '',
            'container_id' => '',
            'container_class' => '',
            'menu_class' => 'nav navbar-nav navbar-right',
            'menu_id' => '',
            'echo' => true,
            'fallback_cb' => 'childressagency_header_fallback_menu',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth' => 2,
            'walker' => new wp_bootstrap_navwalker()
          );
          wp_nav_menu($header_nav_args);
        ?>
      </div>
    </div>
  </nav>
