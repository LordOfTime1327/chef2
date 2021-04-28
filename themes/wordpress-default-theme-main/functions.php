<?php
/**
 * coelix functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package coelix
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'coelix_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function coelix_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on coelix, use a find and replace
		 * to change 'coelix' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'coelix', get_template_directory_uri() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'woocommerce' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'coelix' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'coelix_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'coelix_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function coelix_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'coelix_content_width', 640 );
}
add_action( 'after_setup_theme', 'coelix_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function coelix_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'coelix' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'coelix' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'coelix_widgets_init' );



function coelix_scripts() {
	wp_enqueue_style( 'coelix-swiper-styles', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.7/swiper-bundle.min.css' );
	// wp_enqueue_style( 'coelix-swiper-styles', 'https://unpkg.com/swiper/swiper-bundle.min.css' );
	// wp_enqueue_style( 'coelix-rubik', 'https://fonts.googleapis.com/css2?family=Rubik:wght@300;500;700&display=swap' );
	// wp_enqueue_style( 'coelix-main-fullpage-styles', 'https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.7/jquery.fullpage.min.css' );

	wp_enqueue_style( 'coelix-slick-styles', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css' );
	// wp_enqueue_style( 'coelix-animate-styles', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.css' );

	wp_enqueue_script( 'coelix-swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.7/swiper-bundle.min.js', array(), '20151215', true );
	// wp_enqueue_script( 'coelix-swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), '20151215', true );
	// wp_enqueue_script( 'coelix-fullpage', 'https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.7/jquery.fullpage.min.js', array(), '20151215', true );
	wp_enqueue_script( 'coelix-slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array(), '20151215', true );
	// wp_enqueue_script( 'coelix-wow', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array(), '20151215', true );
	
	if ( !is_admin() ) {
	  wp_deregister_script( 'jquery' );
	  wp_register_script( 'jquery', ( 'https://code.jquery.com/jquery-3.5.1.min.js' ), false, null, true );
	  wp_enqueue_script( 'jquery' );
	}

	wp_enqueue_style( 'coelix-main-style', get_template_directory_uri() . '/dist/main.css' );
	wp_enqueue_script( 'coelix-main-script', get_template_directory_uri() . '/dist/app.min.js', array(), false, true );
	wp_localize_script( 'coelix-main-script', 'wp', [
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	] );

}
add_action( 'wp_enqueue_scripts', 'coelix_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory_uri() . '/inc/jetpack.php';
}

/**
 * Adding needed menus
 */
add_action( 'after_setup_theme', function(){
	register_nav_menus( [
		'main-menu' => 'Main Menu',
		'footer-menu' => 'Footer Menu',
		'mobile-menu' => 'Mobile Menu',
		'side-menu' => 'Side Menu',
	] );
} );

/**
 * Adding ACF page
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

/**
 * Add ACF options page
 */
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'position' => 80,
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme 404 Settings',
		'menu_title'	=> '404',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Popups Settings',
		'menu_title'	=> 'Popups',
		'parent_slug'	=> 'theme-general-settings',
	));
}

///
remove_action('woocommerce_single_product_summary' , 'woocommerce_template_single_rating', 10);
add_action('showRatingStars', 'chef_woocommerce_template_single_rating', 10 );
function chef_woocommerce_template_single_rating() {
	wc_get_template( 'single-product/rating.php' );
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action('addToCartForm', 'chef_woocommerce_template_single_add_to_cart', 30 );
function chef_woocommerce_template_single_add_to_cart(){
	wc_get_template( 'single-product/add-to-cart/simple.php' );
}

// remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );
// add_action( 'test', 'chef_woocommerce_review_display_rating' );
// function chef_woocommerce_review_display_rating(){
// 	wc_get_template( 'single-product/review.php' );
// }

remove_action( 'woocommerce_after_shop_loop_item_title',  'woocommerce_template_loop_rating', 5);
