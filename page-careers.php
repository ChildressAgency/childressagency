<?php get_header(); ?>
  <main id="blog-main" class="main-container">
    <div class="container-fluid container-sm-height">
      <article class="blog-post">
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
          <?php the_content(); ?>
        <?php endwhile; endif; rewind_posts(); ?>
      </article>

      <div id="careers">
        <h1>Careers</h1>
        <?php if(have_rows('positions')): ?>
          <h2>Available Openings:</h2>
          <div class="panel-group" id="positions" role="tablist" aria-multiselectable="true">
            <?php $c=0; while(have_rows('positions')): the_row(); ?>

              <?php if(get_sub_field('display_position')): ?>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="position<?php echo $c; ?>">
                    <h4 class="panel-title"><?php the_sub_field('position_title'); ?></h4>
                    <p><?php the_sub_field('position_location'); ?></p>
                    <a href="#collapse<?php echo $c; ?>" role="button" data-toggle="collapse" data-parent="#positions" aria-expanded="false" aria-controls="collapse<?php echo $c; ?>">view more<span class="glyphicon glyphicon-triangle-bottom"></span></a>
                  </div>
                  <div id="collapse<?php echo $c; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $c; ?>">
                    <div class="panel-body">
                      <?php the_sub_field('position_details'); ?>
                      <p class="page-btn"><a href="<?php echo home_url('apply-now?position-title=' . get_sub_field('position_title')); ?>">APPLY NOW</a></p>
                    </div>
                  </div>
                </div>
              <?php endif; ?>

            <?php $c++; endwhile; ?>
          </div>
        <?php else: ?>
          <h2>We don't currently have nay open positions. Please check back soon.</h2>
        <?php endif; ?>
        <div class="company-info">
          <?php the_field('company_info'); ?>
        </div>
      </div>
    </div>
  </main>
<?php get_footer(); ?>