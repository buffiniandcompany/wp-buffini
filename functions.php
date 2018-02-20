<?php 


// Theme Support
//add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );


// Menu

/*function register_theme_menus() {
	register_nav_menus(
		array(
			'primary-menu' 	=> __( 'Primary Menu', 'primary-menu' )			
		)
	);
}
add_action( 'init', 'register_theme_menus' );
require_once dirname( __FILE__ ) . '/classes/menu.php';*/


// Posts
function wpt_excerpt_length( $length ) {
	return 16;
}
add_filter( 'excerpt_length', 'wpt_excerpt_length', 999 );

// Pagination
function html5wp_pagination()
{
	global $wp_query;
	$big = 999999999;
	echo paginate_links(array(
		'base' => str_replace($big, '%#%', get_pagenum_link($big)),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages
	));
}
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination


// Advanced Custom Fields - Custom Titles for Flexible Content
function my_acf_flexible_content_layout_title( $title, $field, $layout, $i ) {
	// load text sub field
	if( $section_id = get_sub_field('section_id') ) {
		// remove layout title from text
		$title = '';
		// replace layout title with section_id field value
		$title .= '<span>'.$section_id.'</span>';
	}
	// return
	return $title;
}
add_filter('acf/fields/flexible_content/layout_title', 'my_acf_flexible_content_layout_title', 10, 4);

// Styles
function wpt_theme_styles() {
/* 	
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'global_css', get_template_directory_uri() . '/styles/css/global.min.css' );
*/		
//	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'global_css', 'https://www.buffiniandcompany.com/assets/styles2/css/global.min.css' );	
	
}
add_action( 'wp_enqueue_scripts', 'wpt_theme_styles' );


// Scripts
function wpt_theme_js() {
	
		wp_enqueue_script( 'bodyClass_js', get_template_directory_uri() . '/scripts/bodyClass.js', array('jquery'), '', true );
/* 	wp_enqueue_script( 'global_js', get_template_directory_uri() . '/scripts/global.js', array('jquery', 'foundation_js'), '', true );
  wp_enqueue_script( 'owl_carousel_js', get_template_directory_uri() . '/scripts/owl.carousel.min.js', array('jquery'), '', true );
*/	
	wp_enqueue_script( 'foundation_js', 'https://www.buffiniandcompany.com/assets/scripts2/foundation.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'global_js', 'https://www.buffiniandcompany.com/assets/scripts2/global2.js', array('jquery', 'foundation_js'), '', true );
  wp_enqueue_script( 'owl_carousel_js', 'https://www.buffiniandcompany.com/assets/scripts2/owl.carousel.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'marketo_forms', 'https://app-ab26.marketo.com/js/forms2/js/forms2.min.js', true );
	wp_enqueue_script( 'jquery_js', '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', array('jquery'), '', false );
}
add_action( 'wp_enqueue_scripts', 'wpt_theme_js' );


require_once( __DIR__ . '/classes/post-feed-by-category.php');
?>