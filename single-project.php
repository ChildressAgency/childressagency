<?php get_header(); ?>
  <?php 
    $background_image = get_field('project_background_image_1');
    if(get_field('project_background_image_2')){
      $background_image = get_field('project_background_image_2');
    }
  ?>
  <div id="hero" class="cs-hero" style="background-image:url(<?php echo $background_image; ?>);">
    <img src="<?php the_field('project_white_logo'); ?>" class="img-responsive center-block" alt="<?php echo get_the_title(); ?> Logo" />
  </div>

  <main id="cs-main" class="main-container">
    <div class="container">
      <article class="cs-article">
        <h1>Case Study: <?php echo get_the_title(); ?></h1>
        <div class="row">
          <?php if(have_rows('case_study_sections')): $cs=0; while(have_rows('case_study_sections')): the_row(); ?>
            <?php if($cs%2==0){ echo '</div><div class="row">'; } ?>
              <div class="col-sm-6">
                <section>
                  <h2 class="brand-color"><?php the_sub_field('case_study_section_title'); ?></h2>
                  <?php the_sub_field('case_study_section_content'); ?>
                </section>
              </div>
            <?php $cs++; endwhile; endif; ?>
        </div>
      </article>
    </div>

    <?php if(have_rows('project_logos')): ?>
      <div class="cs-logos">
        <ul class="list-unstyled">
          <?php while(have_rows('project_logos')): the_row(); ?>
            <li><img src="<?php the_sub_field('project_logo'); ?>" class="img-responsive center-block" alt="" /></li>
          <?php endwhile; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if(get_field('testimonial')): ?>
      <div class="container container-sm-height cs-quote-screens">
        <div class="row row-sm-height">
          <div class="col-sm-7 col-sm-height">
            <blockquote class="brand-color">
              <?php the_field('testimonial'); ?>
            </blockquote>
          </div>
          <div class="col-sm-5 col-sm-height blockquote-author">
            <h3 class="brand-color"><?php the_field('testimonial_author'); ?><small><?php the_field('testimonial_author_title'); ?></small></h3>
          </div>
        </div>
      </div>
    <?php endif; ?> 
    <?php if(get_field('responsive_screens')): ?>
      <img src="<?php the_field('responsive_screens'); ?>" class="img-responsive center-block cs-screens" alt="Responsive Screens" />
    <?php endif; ?>

    <div class="cs-links brand-color">
      <?php 
        $project_link = get_field('project_link');
        if($project_link): ?>
          <a href="<?php echo esc_url($project_link['url']); ?>" class="btn-main"><?php echo $project_link['title']; ?></a>
      <?php endif; ?>
          <br />
      <a href="<?php echo esc_url(home_url('contact')); ?>" class="btn-main">Let's Get Started</a>
    </div>

    <?php
      $next_project = get_next_post();
      if(!empty($next_project)):
        $next_project_id = $next_project->ID; ?>
        <div class="container-fluid container-sm-height cs-next">
          <div class="row row-sm-height">
            <div class="col-sm-6 col-sm-height text-side" style="background-color:<?php the_field('brand_color', $next_project_id); ?>;">
              <div class="next-project">
                <h3>VIEW NEXT PROJECT</h3>
                <a href="<?php echo esc_url(get_permalink($next_project_id)); ?>" class="btn-main"><?php echo get_the_title($next_project_id); ?></a>
              </div>
            </div>
            <div class="col-sm-6 col-sm-height image-side" style="background-image:url(images/<?php the_field('background_image_1', $next_project_id); ?>);"></div>
          </div>
        </div>
    <?php endif; ?>
  </main>
<?php get_footer(); ?>