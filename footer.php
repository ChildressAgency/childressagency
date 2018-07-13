  <footer id="footer">
    <div class="container">
      <ul class="social list-unstyled list-inline text-center">
        <?php if(get_field('facebook', 'option')): ?>
          <li><a href="<?php esc_url(the_field('facebook', 'option')); ?>" class="text-hide" target="_blank">Facebook <i class="fab fa-facebook"></i></a></li>
        <?php endif; if(get_field('twitter', 'option')): ?>
          <li><a href="<?php esc_url(the_field('twitter', 'option')); ?>" class="text-hide" target="_blank">Twitter <i class="fab fa-twitter"></i></a></li>
        <?php endif; if(get_field('instagram', 'option')): ?>
          <li><a href="<?php esc_url(the_field('instagram', 'option')); ?>" class="text-hide" target="_blank">Instagram <i class="fab fa-instagram"></i></a></li>
        <?php endif; if(get_field('google_plus', 'option')): ?>
          <li><a href="<?php esc_url(the_field('google_plus', 'option')); ?>" class="text-hide" target="_blank">Google Plus <i class="fab fa-google-plus-g"></i></a></li>
        <?php endif; if(get_field('linkedin', 'option')): ?>
          <li><a href="<?php esc_url(the_field('linkedin', 'option')); ?>" class="text-hide" target="_blank">LinkedIn <i class="fab fa-linkedin-in"></i></a></li>
        <?php endif; if(get_field('pinterest', 'option')): ?>
          <li><a href="<?php esc_url(the_field('pinterest', 'option')); ?>" class="text-hide" target="_blank">Pinterest <i class="fab fa-pinterest-p"></i></a></li>
        <?php endif; ?>
      </ul> 
    </div>
    <div class="container-fluid container-sm-height">
      <div class="row row-sm-height" itemscope itemtype="http://schema.org/LocalBusiness">
        <div class="col-sm-3 col-sm-height">
          <a href="<?php echo esc_url(home_url()); ?>" class="footer-logo" itemprop="logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-white.png" alt="The Childress Agency Logo" /></a>
        </div>
        <div class="col-sm-6 col-sm-height">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <p>
                <?php 
                  $phone_locations = get_field('phone_locations', 'option'); 
                  $phone_locations_count = count($phone_locations);
                  for($i=0; $i<$phone_locations_count; $i++){
                    echo $phone_locations[$i]['phone_location'] . ' <span itemprop="telephone">' . $phone_locations[$i]['phone_number'] . '</span>';
                    if($i < ($phone_locations_count - 1)){ echo '<br />'; }
                  }
                ?>
              </p>
            </div>
            <div class="col-sm-12 col-md-6" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
              <p><span itemprop="streetAddress"><?php the_field('street_address', 'option'); ?></span><br/ ><span itemprop="addressLocality"><?php the_field('city', 'option'); ?></span>, <span itemprop="addressRegion"><?php the_field('state', 'option'); ?></span> <span itemprop="postalCode"><?php the_field('zip', 'option'); ?></span></p>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-sm-height">
          <div class="copyright">
            <p>&copy; The Childress Agency, Inc <?Php echo date('Y'); ?><br />All Rights Reserved</p>
            <p>
              <a href="<?php echo esc_url(home_url('careers')); ?>">Careers</a>
              &nbsp;&bull;&nbsp;
              <a href="http://government.childressagency.com" target="_blank">Government</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <?php wp_footer(); ?>
</body>

</html>