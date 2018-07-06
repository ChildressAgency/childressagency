<?php get_header(); ?>
<div class="page-wrapper">
  <div id="hero" class="hp-hero full-screen">
    <article id="slogan" class="hero-slide">
      <div class="container-fluid container-sm-height">
        <div class="row row-sm-height">
          <div class="col-sm-6 col-sm-height image-side hidden-xs" style="background-image:url(<?php the_field('hero_image'); ?> <?php the_field('hero_image_css'); ?>);">
            <div class="overlay"></div>
            <div class="hp-hero-logo">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/childress-logo-white.png" class="img-responsive center-block" alt="The Childress Agency Logo" />
            </div>
          </div>
          <div class="col-sm-6 col-sm-height text-side">
            <section class="slogan-list">
              <ul class="list-unstyled">
                <li>Bold</li>
                <li>Focused</li>
                <li>Creative</li>
                <li>Competitive</li>
              </ul>
            </section>
            <div class="services-list">
              <ul class="list-unstyled">
                <?php if(have_rows('services_links')): while(have_rows('service_links')): the_row(); ?>
                  <li><a href="<?php esc_url(the_sub_field('service_link')); ?>"><?php the_field('service_name'); ?></a></li>
                <?php endwhile; endif; ?>
              </ul>              
            </div>
          </div>
        </div>
      </div>
    </article>
    <span class="scroll-down"></span>
  </div>

  <main id="main" class="hp-main main-container">

    <?php
      $projects = get_field('featured_projects');
      $p = 1; 
      foreach($projects as $project): ?>

        <article id="case-study<?php echo $p; ?>" class="slide full-screen" style="z-index:8;">
          <div class="case-study" style="background-image:url(<?php the_field('project_background_image_1', $project->ID); ?>);">
            <?php if($p == 1){ echo '<div class="top-blinder"></div>'; } ?>
            <section class="case-study-summary">
              <h2><?php echo get_the_title($project->ID); ?></h2>
              <p><?php the_field('project_summary'); ?></p>
              <a href="<?php echo esc_url(get_permalink($project->ID)); ?>" class="btn-main">View Case Study</a>
            </section>
            <div class="case-study-logo">
              <img src="<?php the_field('project_white_logo', $project->ID); ?>" class="img-responsive center-block" alt="<?php echo get_the_title($project->ID); ?> Logo" />
            </div>
            <div class="overlay" style="background-color:<?php the_field('brand_color', $project->ID); ?>;"></div>
            <?php if($p == 1){ echo '<div class="bottom-blinder"></div>'; } ?>
          </div>
        </article>
      
    <?php $p++; endforeach; ?>

    <article id="contact" class="full-screen">
      <div class="container-fluid container-sm-height">
        <div class="row row-sm-height">
          <div class="col-sm-6 col-sm-height">
            <div class="wrapper">
              <h2><?php the_field('contact_form_title'); ?></h2>
            </div>
          </div>
          <div class="col-sm-6 col-sm-height">
            <div class="wrapper">
              <?php echo do_shortcode(get_field('contact_form_shortcode')); ?>
            </div>
          </div>
        </div>
      </div>
    </article>

  </main>
</div>
<?php get_footer(); ?>