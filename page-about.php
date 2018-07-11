<?php get_header(); ?>
  <main id="main" class="main-container">
    <article id="about">
      <div class="container-fluid container-sm-height">
        <div class="row row-sm-height">
          <div class="col-sm-6 col-sm-height text-side">
            <section class="content">
              <?php 
                if(have_posts()){
                  while(have_posts()){
                    the_post();
                    the_content();
                  }
                }
              ?>
            </section>
            <div class="clearfix"></div>
          </div>
          <div class="col-sm-6 col-sm-height image-side" style="background-image:url(<?php the_field('first_section_background_image'); ?>); <?php the_field('first_section_background_image_css'); ?>">

          </div>
        </div>
      </div>
    </article>

    <div id="what-we-do">
      <div class="container-fluid container-sm-height">
        <div class="row row-sm-height">
          <?php
            $services = get_field('services');

            if($services): ?>

              <div class="col-sm-4 col-md-3 col-sm-push-8 col-md-push-9 col-sm-height">
                <div class="what-we-do-nav">
                  <h3>WHAT WE DO</h3>
                  <ul class="list-unstyled" role="tablist">

                    <?php $w = 0; foreach($services as $service): ?>
                      <li role="presentation"<?php if($w==0){ echo ' class="active"'; } ?>>
                        <a href="#<?php echo sanitize_title($service['service_title']); ?>" aria-controls="<?php echo sanitize_title($service['service_title']); ?>" role="tab" data-toggle="tab"><?php echo $service['service_title']; ?></a>
                      </li>
                    <?php $w++; endforeach; reset($services); ?>

                  </ul>
                </div>
              </div>
          
            <div class="col-sm-8 col-md-9 col-sm-pull-4 col-md-pull-3 col-sm-height image-side" style="background-image:url(<?php the_field('services_section_background_image'); ?>); <?php the_field('services_section_background_image_css'); ?>">
              <div class="tab-content">

                <?php $i=0; foreach($services as $service): ?>
                  <div id="<?php echo sanitize_title($service['service_title']); ?>" class="tab-pane fade<?php if($i==0){ echo ' in active'; } ?>" role="tabpanel">
                    <h2><?php echo $service['service_title']; ?></h2>
                    <?php echo $service['service_content']; ?>
                  </div>
                <?php $i++; endforeach; ?>

              </div>
              <div class="overlay"></div>
            </div><?php //image-side ?>
          <?php endif; ?>
        </div><?php //row ?>
      </div>
    </div><?php //#what-we-do ?>

    <?php if(have_rows('the_team')): ?>
      <div id="meet-the-team">
        <div class="container">
          <h2>MEET THE TEAM</h2>
          <div class="row">

            <?php $r = 0; while(have_rows('the_team')): the_row(); ?>
              <?php if($r%3 == 0){ echo '</div><div class="row">'; } ?>
              <div class="col-sm-4">
                <div class="team-member">
                  <?php 
                    $team_member_image = get_stylesheet_directory_uri() . '/images/team-member-placeholder.png';
                    if(get_sub_field('team_member_image')){
                      $team_member_image = get_sub_field('team_member_image');
                    }
                    $team_member_name = get_sub_field('team_member_name');
                  ?>
                  <img src="<?php echo $team_member_image; ?>" class="img-responsive center-block" alt="<?php echo $team_member_name; ?>" />
                  <div class="team-member-caption">
                    <h3><?php echo $team_member_name; ?></h3>
                    <h4><?php the_sub_field('team_member_title'); ?></h4>
                  </div>
                </div>
              </div>
            <?php $r++; endwhile; ?>

          </div><?php //.row ?>
        </div>
      </div><?php // #meet-the-team ?>
    <?php endif; ?>

    <?php
      $companies = get_field('collaboration');
      if($companies): 
        $companies_count = count($companies); ?>
        <div id="collaboration">
          <div class="container">
            <h2>A COLLABORATION OF EFFORTS</h2>
            <div class="row">
              <?php for($c = 1; $c-1 < $companies_count; $c++): ?>

                <?php if($c == $companies_count): ?>

                  </div><?php //.row ?>
                  <div class="row">
                    <div class="col-sm-12">
                      <a href="<?php echo $companies[$c-1]['company_link']; ?>" target="_blank"><img src="<?php echo $companies[$c-1]['company_logo']; ?>" class="img-responsive center-block" alt="<?php echo $companies[$c-1]['company_name']; ?>" /></a>
                    </div>
                  </div>

                <?php else: ?>

                  <div class="col-sm-6<?php echo ($c%2 == 0) ? ' right-logo' : ' left-logo'; ?>">
                    <a href="<?php echo $companies[$c-1]['company_link']; ?>" target="_blank"><img src="<?php echo $companies[$c-1]['company_logo']; ?>" class="img-responsive" alt="<?php echo $companies[$c-1]['company_name']; ?>" /></a>
                  </div>
                  <?php if($c%2 == 0){ echo '</div><div class="row">'; } ?>

                <?php endif; ?> 

              <?php endfor; ?>
            </div><?php //.row ?>
          <?php the_field('collaboration_content'); ?>
        </div>
      </div>
    <?php endif; ?>

    <article id="contact">
      <div class="container-fluid container-sm-height">
        <div class="row row-sm-height">
          <div class="col-sm-6 col-sm-height">
            <div class="wrapper">
              <h2><?php the_field('contact_form_section_title'); ?></h2>
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

<?php get_footer(); ?>