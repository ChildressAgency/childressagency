<?php get_header(); ?>
  <main id="contact-main" class="main-container" style="background-image:url(images/coffee-laptop.jpg);">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4 col-lg-3 info-side">
          <div class="contact-info">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/childress-icon-lg.png" class="img-responsive" alt="Childress Agency Icon" />
            <?php $phone_locations = get_field('phone_locations', 'option'); ?>
            <p><?php echo $phone_locations[0]; ?></p>
            <p><?php the_field('street_address', 'option'); ?><br /><?php the_field('city', 'option'); ?>, <?php the_field('state', 'option'); ?> <?php the_field('zip', 'option'); ?></p>
            <?php if(get_field('free_analysis_link', 'option')): ?>
              <a href="<?php the_field('free_analysis_link', 'option'); ?>" class="btn-main btn-alt">Free Analysis</a>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-sm-7 col-sm-offset-1 col-md-6 col-md-offset-2 col-lg-offset-3 form-side">
          <?php
            if(have_posts()){
              while(have_posts()){
                the_post();
                the_content();
              }
            }
          ?>
        </div>
      </div>
    </div>
  </main>
<?php get_footer(); ?>