<?php get_header(); ?>
  <main id="work-list-main" class="main-container">
    <div class="container-fluid container-sm-height">
      <div class="row row-sm-height">
        <div class="col-sm-5 col-sm-push-7 col-md-4 col-md-push-8 col-sm-height nav-side">
          <div class="work-nav">
            <?php 
              $our_work = new WP_Query(array(
                'post_type' => 'case_study',
                'posts_per_page' => -1,
                'post_status' => 'publish'
              ));

              if($our_work->have_posts()): ?>
                <ul class="list-unstyled" role="tablist">

                  <?php while($our_work->have_posts()): $our_work->the_post(); ?>

                    <li role="presentation" class="active">
                      <?php $work_slug = sanitize_title(get_the_title()); ?>
                      <a href="#<?php echo $work_slug; ?>" aria-controls="<?php echo $work_slug; ?>" role="tab" data-toggle="tab"><?php the_title(); ?></a>
                    </li>

                  <?php endwhile; ?>

                </ul>
            <?php endif; rewind_posts(); ?>

            </ul>
          </div>
        </div>

        <div class="col-sm-7 col-sm-pull-5 col-md-8 col-md-pull-4 col-sm-height content-side">
          <div class="work-description tab-content">

            <?php if($our_work->have_posts()): while($our_work->have_posts()): $our_work->the_post(); ?>
              <?php $work_slug = sanitize_title(get_the_title()); ?>

              <div id="<?php echo $work_slug; ?>" class="tab-pane active" role="tabpanel">
                <div class="row work-summary">
                  <div class="col-sm-12 col-md-5 text-side">
                    <span class="wiper" style="background-color:<?php the_field('brand_color'); ?>;"></span>
                    <div class="work-summary-inner">
                      <img src="<?php the_field('white_logo'); ?>" class="img-responsive center-block" alt="<?php the_title(); ?>" />

                      <?php if(have_rows('work_done_list')): ?>
                        <ul class="list-unstyled work-done">
                          <?php while(have_rows('work_done_list')): the_row(); ?>
                            <li><?php the_sub_field('work_done'); ?></li>
                          <?php endwhile; ?>
                        </ul>
                      <?php endif; ?>

                      <a href="<?php the_permalink(); ?>" class="btn-main show-work-details">View Case Study</a>
                    </div>
                  </div>
                  <div class="col-md-7 hidden-xs hidden-sm image-side" style="background-image:url(<?php the_field('background_image_1'); ?>);"></div>
                </div><?php //work-summary ?>
              </div><?php //tab-pane ?>
            <?php endwhile; endif; wp_reset_postdata(); ?>

          </div><?php //tab-content ?>
        </div><?php //content-side ?>

      </div><?php //row ?>
    </div>
  </main>
<?php get_footer(); ?>