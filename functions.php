<?php
/*
add_action('wp_footer', 'show_template');
function show_template() {
	global $template;
	print_r($template);
}
*/
add_action('wp_enqueue_scripts', 'jquery_cdn');
function jquery_cdn(){
  if(!is_admin()){
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, null, true);
    wp_enqueue_script('jquery');
  }
}

add_action('wp_enqueue_scripts', 'd3systems_scripts', 100);
function d3systems_scripts(){
  wp_register_script(
    'bootstrap-script', 
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', 
    array('jquery'), 
    '', 
    true
  );

  wp_register_script(
    'tweenmax',
    '//cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenMax.min.js',
    array('jquery'),
    '',
    true
  );

  wp_register_script(
    'vendors',
    get_template_directory_uri() . '/js/vendors.js',
    array('jquery'),
    '',
    true
  );

  wp_register_script(
    'childressagency-scripts', 
    get_template_directory_uri() . '/js/childressagency-scripts.min.js', 
    array('jquery'), 
    '', 
    true
  ); 
  
  wp_enqueue_script('bootstrap-script');
  wp_enqueue_script('tweenmax');
  wp_enqueue_script('vendors');
  wp_enqueue_script('childressagency-scripts'); 
  
  global $wp_query;
  wp_localize_script(
    'ajax-pagination', 
    'ajaxpagination', 
    array(
      'ajaxurl' => admin_url('admin-ajax.php'),
      'query_vars' => json_encode($wp_query->query)
    )
  );
}

add_action('wp_enqueue_scripts', 'childressagency_styles');
function d3systems_styles(){
  wp_register_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
  wp_register_style('google-fonts', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700');
  wp_register_style('fontawesome', '//use.fontawesome.com/releases/v5.1.0/css/all.css');
  wp_register_style('childressagency', get_template_directory_uri() . '/style.css');
  
  wp_enqueue_style('bootstrap-css');
  wp_enqueue_style('google-fonts');
  wp_enqueue_style('fontawesome');
  wp_enqueue_style('childressagency');
}

add_theme_support('post-thumbnails');

register_nav_menu( 'header-nav', 'Header Navigation' );
/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class wp_bootstrap_navwalker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children )
				$class_names .= ' dropdown';

			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href']   		= '#';
                                $atts['href'] = ! empty( $item->url ) ? $item->url : '';
        
        //$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle';
				$atts['aria-haspopup']	= 'true';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */

			 $item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			if ( ! empty( $item->attr_title ) ){
				$item_output .= '&nbsp;<span class="' . esc_attr( $item->attr_title ) . '"></span>';
			}

			$item_output .= ( $args->has_children && 0 === $depth ) ? ' </a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo $fb_output;
		}
	}
}

function childressagency_header_fallback_menu(){ ?>

  <ul class="nav navbar-nav navbar-right">
    <li<?php if(is_page('who-we-are')){ echo ' class="active"'; } ?>><a href="<?php echo esc_url(home_url('who-we-are')); ?>">Who We Are</a></li>
    <li<?php if(is_page('work')){ echo ' class="active"'; } ?>><a href="<?php echo esc_url(home_url('work')); ?>">Work</a></li>
    <li<?php if(is_page('news')){ echo ' class="active"'; } ?>><a href="<?php echo esc_url(home_url('blog')); ?>">News</a></li>
    <li<?php if(is_page('contact')){ echo ' class="active"'; } ?>><a href="<?php echo esc_url(home_url('contact')); ?>">Contact</a></li>
  </ul> 

<?php }

add_action('init', 'childressagency_create_post_types');
function childressagency_create_post_types(){
  $case_study_labels = array(
    'name' => 'Projects',
    'singular_name' => 'Project',
    'menu_name' => 'Projects',
    'add_new_item' => 'Add New Project',
    'search_items' => 'Search Projects',
    'edit_item' => 'Edit Project',
    'view_item' => 'View Project',
    'all_items' => 'All Projects',
    'new_item' => 'New Project',
    'not_found' => 'No Projects Found'
  );
  $case_study_args = array(
    'labels' => $case_study_labels,
    'capability_type' => 'post',
    'public' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-analytics',
    'query_var' => 'project',
    'supports' => array(
      'title',
      'editor',
      'custom_fields',
      'author',
      'thumbnail',
      'revisions'
    )
  );
  register_post_type('project', $case_study_args);
}

if(function_exists('acf_add_options_page')){
  acf_add_options_page(array(
    'page_title' => 'General Settings',
    'menu_title' => 'General Settings',
    'menu_slug' => 'general-settings',
    'capability' => 'edit_posts',
    'redirect' => false
  ));
}

add_action('wp_ajax_nopriv_ajax_pagination', 'childressagency_ajax_pagination');
add_action('wp_ajax_ajax_pagination', 'childressagency_ajax_pagination');
function childressagency_ajax_pagination(){
  $query_vars = json_decode(stripslashes($_POST['query_vars']), true);
  $query_vars['paged'] = $_POST['page'];
  $query_vars['post_status'] = 'publish';

  $posts = new WP_Query($query_vars);
  $GLOBALS['wp_query'] = $posts;

  $new_post_list = '<ul class="list-unstyled">';

  if($posts->have_posts()){
    while($posts->have_posts()){
      $posts->the_post();
      $new_post_list .= '<li><a href="' . esc_url(get_permalink()) . '" class="view-post" data-post_id="' . get_the_ID() . '">' . get_the_title() . '</a></li>';
    }
  }

  $new_post_list .= '</ul><div class="pagination">';
  $new_post_list .= get_the_posts_pagination(array(
    'mid_size' => 2,
    'prev_text' => '<<',
    'next_text' => '>>'
  ));

  $new_post_list .= '</div>';

  echo $new_post_list;

  die();
}

add_action('wp_ajax_nopriv_ajax_postload', 'childressagency_ajax_postload');
add_action('wp_ajax_ajax_postload', 'childressagency_ajax_postload');
function childressagency_ajax_postload(){
  $query_vars = json_decode(stripslashes($_POST['query_vars']), true);
  $query_vars['p'] = $_POST['post_id'];

  $the_post = new WP_Query($query_vars);
  
  $new_post = '';

  if($the_post->have_posts()){
    while($the_post->have_posts()){
      $the_post->the_post();
      $new_post .= '<h1>' . get_the_title() . '</h1>';
      ob_start();
      the_content();
      $new_post .= ob_get_clean();
    }
  }

  echo $new_post;
  die();
}