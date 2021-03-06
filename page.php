<?php get_header(); ?>
  <main id="blog-main" class="main-container">
    <div class="container-fluid container-sm-height">
      <div class="row row-sm-height row-offcanvas row-offcanvas-right">
        <div class="col-sm-6 col-md-7 col-sm-height post-side">
          <div class="open-offcanvas visible-xs">
            <button type="button" class="btn-main" data-toggle="offcanvas">More Posts</button>
          </div>
          <article class="blog-post">
            <?php if(have_posts()): while(have_posts()): the_post(); ?>
              <h1><?php the_title(); ?></h1>
              <?php the_content(); ?>
            <?php endwhile; endif; ?>
          </article>
        </div>
        <div class="col-sm-6 col-md-5 col-sm-height nav-side sidebar-offcanvas">
          <a href="#" class="close-offcanvas visible-xs">&times;</a>
          <nav class="post-list">
            <?php 
              $blog_posts = new WP_Query(array('post_type' => 'post'));
              if($blog_posts->have_posts()): ?>
              <ul class="list-unstyled">
                <?php while($blog_posts->have_posts()): $blog_posts->the_post(); ?>
                  <li><a href="<?php the_permalink(); ?>" class="view-post" data-post_id="<?php echo get_the_ID(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; ?>
              </ul>
            <?php endif; ?>
            <div class="pagination">
              <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => '<<', 'next_text' => '>>')); ?>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </main>
<?php get_footer(); ?>