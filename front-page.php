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
                  <li><a href="<?php the_sub_field('service_link'); ?>"><?php the_field('service_name'); ?></a></li>
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

    <?php if(have_rows())

    <article id="case-study1" class="slide full-screen" style="z-index:8;">
      <div class="case-study" style="background-image:url(images/sunday-rose.jpg);">
        <div class="top-blinder"></div>
        <section class="case-study-summary">
          <h2>Sunday Rose Cakes</h2>
          <p>Built a dynamic Brand Identity, Website Design, and Marketing Collateral</p>
          <a href="#" class="btn-main">View Case Study</a>
        </section>
        <div class="case-study-logo">
          <img src="images/logo-sunday-rose-cakes.png" class="img-responsive center-block" alt="Sunday Rose Cakes Logo" />
        </div>
        <div class="overlay" style="background-color:#ff7175;"></div>
        <div class="bottom-blinder"></div>
      </div>
    </article>

    <article id="case-study2" class="slide full-screen">
      <div class="case-study" style="background-image:url(images/football-stadium.jpg);">
        <section class="case-study-summary">
          <h2>Jermon Bushrod</h2>
          <p>Built a strong and professional Website design and Brand Identity for Jermon Bushrod.</p>
          <a href="#" class="btn-main">View Case Study</a>
        </section>
        <div class="case-study-logo"></div>
        <div class="overlay" style="background-color:#058d97;"></div>
      </div>
    </article>

    <article id="case-study3" class="slide full-screen">
      <div class="case-study" style="background-image:url(images/davis-defense.jpg);">
        <section class="case-study-summary">
          <h2>Davis Defense Group</h2>
          <p>A Dynamic Website Design</p>
          <a href="#" class="btn-main">View Case Study</a>
        </section>
        <div class="case-study-logo">
          <img src="images/logo-davis-defense-group.png" class="img-responsive center-block" alt="Davis Defense Group Logo" />
        </div>
        <div class="overlay" style="background-color:#123d61;;"></div>
      </div>
    </article>

    <article id="case-study4" class="slide full-screen">
      <div class="case-study" style="background-image:url(images/leaderslink.jpg);">
        <section class="case-study-summary">
          <h2>Leaderslink</h2>
          <p>Built a strong and professional website to provide a platform for LeadersLInk to inform the public how to prevent disasters, respond when they happen and lead a robust recovery.</p>
          <a href="#" class="btn-main">View Case Study</a>
        </section>
        <div class="case-study-logo">
          <img src="images/logo-leaderslink.png" class="img-responsive center-block" alt="LeadersLink Logo" />
        </div>
        <div class="overlay" style="background-color:#f70001;"></div>
      </div>
    </article>

    <article id="contact" class="full-screen">
      <div class="container-fluid container-sm-height">
        <div class="row row-sm-height">
          <div class="col-sm-6 col-sm-height">
            <div class="wrapper">
              <h2>Let us tell your story</h2>
            </div>
          </div>
          <div class="col-sm-6 col-sm-height">
            <div class="wrapper">
              <section class="contact-form">
                <div class="form-group">
                  <label for="your-name" class="sr-only">Name</label>
                  <input type="text" id="your-name" class="form-control" placeholder="Name" />
                </div>
                <div class="form-group">
                  <label for="company" class="sr-only">Company</label>
                  <input type="text" id="company" class="form-control" placeholder="Company" />
                </div>
                <div class="form-group">
                  <label for="phone" class="sr-only">Phone</label>
                  <input type="text" id="phone" class="form-control" placeholder="Phone" />
                </div>
                <div class="form-group">
                  <label for="your-email" class="sr-only">Email</label>
                  <input type="email" id="your-email" class="form-control" placeholder="Email" />
                </div>
                <div class="form-group">
                  <label for="message" class="sr-only">Message</label>
                  <textarea id="message" class="form-control" rows="3" placeholder="Message"></textarea>
                </div>
                <div class="form-group">
                  <label for="budget" class="budget-slider-label">Approximate Budget: <span id="budget-value">$<span>3,000</span></span></label>
                  <input type="text" id="budget" name="budget" class="budget-slider" />
                </div>
                <div class="form-group">
                  <span class="wpcf7-form-control-wrap wrap-type">
                    <span class="wpcf7-form-control wpcf7-checkbox">
                      <span class="wpcf7-list-item first last">
                        <label>
                          <input type="checkbox" name="focus" value="Brand Identity" />
                          <span class="wpcf7-list-item-label">Brand Identity</span>
                        </label>
                      </span>
                    </span>
                  </span>
                  <span class="wpcf7-form-control-wrap wrap-type">
                    <span class="wpcf7-form-control wpcf7-checkbox">
                      <span class="wpcf7-list-item first last">
                        <label>
                          <input type="checkbox" name="focus" value="SEO" />
                          <span class="wpcf7-list-item-label">SEO</span>
                        </label>
                      </span>
                    </span>
                  </span>
                  <span class="wpcf7-form-control-wrap wrap-type">
                    <span class="wpcf7-form-control wpcf7-checkbox">
                      <span class="wpcf7-list-item first last">
                        <label>
                          <input type="checkbox" name="focus" value="Web Design" />
                          <span class="wpcf7-list-item-label">Web Design</span>
                        </label>
                      </span>
                    </span>
                  </span>
                  <span class="wpcf7-form-control-wrap wrap-type">
                    <span class="wpcf7-form-control wpcf7-checkbox">
                      <span class="wpcf7-list-item first last">
                        <label>
                          <input type="checkbox" name="focus" value="Video / Photography" />
                          <span class="wpcf7-list-item-label">Video / Photography</span>
                        </label>
                      </span>
                    </span>
                  </span>
                  <span class="wpcf7-form-control-wrap wrap-type">
                    <span class="wpcf7-form-control wpcf7-checkbox">
                      <span class="wpcf7-list-item first last">
                        <label>
                          <input type="checkbox" name="focus" value="Mobile Apps" />
                          <span class="wpcf7-list-item-label">Mobile Apps</span>
                        </label>
                      </span>
                    </span>
                  </span>
                  <span class="wpcf7-form-control-wrap wrap-type">
                    <span class="wpcf7-form-control wpcf7-checkbox">
                      <span class="wpcf7-list-item first last">
                        <label>
                          <input type="checkbox" name="focus" value="Social Media" />
                          <span class="wpcf7-list-item-label">Social Media</span>
                        </label>
                      </span>
                    </span>
                  </span>
                  <span class="wpcf7-form-control-wrap wrap-type">
                    <span class="wpcf7-form-control wpcf7-checkbox">
                      <span class="wpcf7-list-item first last">
                        <label>
                          <input type="checkbox" name="focus" value="Graphic Design" />
                          <span class="wpcf7-list-item-label">Graphic Design</span>
                        </label>
                      </span>
                    </span>
                  </span>
                  <span class="wpcf7-form-control-wrap wrap-type">
                    <span class="wpcf7-form-control wpcf7-checkbox">
                      <span class="wpcf7-list-item first last">
                        <label>
                          <input type="checkbox" name="focus" value="Print & Promotional" />
                          <span class="wpcf7-list-item-label">Print & Promotional</span>
                        </label>
                      </span>
                    </span>
                  </span>
                </div>
                <div class="form-group text-center">
                  <input type="submit" class="btn-main btn-alt" value="Let's Get Started" />
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </article>

  </main>
</div>
<?php get_footer(); ?>