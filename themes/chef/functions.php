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
 * Account
 */
require get_template_directory() . '/inc/_autch.php';


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
	  wp_register_script( 'jquery', ( 'https://code.jquery.com/jquery-3.5.1.min.js' ), false, null, false);
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

remove_action( 'woocommerce_after_shop_loop_item_title',  'woocommerce_template_loop_rating', 5);

add_filter ( 'woocommerce_account_menu_items', 'chef_remove_my_account_links' );
function chef_remove_my_account_links( $menu_links ){
  unset( $menu_links['dashboard'] ); // Remove Dashboard
  unset( $menu_links['payment-methods'] ); // Remove Payment Methods
  unset( $menu_links['downloads'] ); // Disable Downloads
  
  return $menu_links;
}

// unset( $menu_links['dashboard'] );
add_filter( 'woocommerce_account_menu_items', 'chef_remove_my_account_dashboard' );
function chef_remove_my_account_dashboard( $menu_links ){
	unset( $menu_links['dashboard'] );
	return $menu_links;
 }

 // rename account links
add_filter ( 'woocommerce_account_menu_items', 'chef_rename_account_links' );
function chef_rename_account_links( $menu_links ){
	$menu_links['orders'] = 'Your Orders'; 
	$menu_links['edit-account'] = 'Settings';
 
	return $menu_links;
}

// remove cart coupon
remove_action( 'woocommerce_cart_coupon', 'action_woocommerce_cart_coupon', 10); 

add_action('template_redirect', 'chef_redirect_to_orders_from_dashboard' );
function chef_redirect_to_orders_from_dashboard(){
	if( is_account_page() && empty( WC()->query->get_current_endpoint() ) ){
		wp_safe_redirect( wc_get_account_endpoint_url( 'orders' ) );
		exit;
	}
}

// Remove required fields account settings
add_filter('woocommerce_save_account_details_required_fields', function($array){
	$array =  array(
		'account_first_name'   => __( 'First name', 'woocommerce' ),
		// 'account_last_name'    => __( 'Last name', 'woocommerce' ),
		// 'account_display_name' => __( 'Display name', 'woocommerce' ),
		"billing_phone" => __("Phone", 'woocommerce'),
		'account_email'        => __( 'Email address', 'woocommerce' ),
	);
	return $array;
});

add_action( 'woocommerce_save_account_details', 'my_account_saving_phone', 10, 1 );
function my_account_saving_phone( $user_id ) {
    $billing_phone = $_POST['billing_phone'];
    if( ! empty( $billing_phone ) )
        update_user_meta( $user_id, 'billing_phone', sanitize_text_field( $billing_phone ) );
}

// add_action( 'woocommerce_edit_account_form', 'chef_add_field_edit_account_form' );
// function chef_add_field_edit_account_form() {
// 	woocommerce_form_field(
// 		'Phone',
// 		array(
// 			'type'        => 'tel',
// 			'required'    => true, // remember, this doesn't make the field required, just adds an "*"
// 			'label'       => 'Phone',
// 			'priority'    => 41,  
// 		), 
// 		get_user_meta( get_current_user_id(), 'Phone', true ) // get the data
// 	);
// }

function action_woocommerce_customer_save_address( ) { 
	wp_safe_redirect(wc_get_account_endpoint_url( 'edit-account' )); 
	exit;
}; 
add_action( 'woocommerce_save_account_details', 'action_woocommerce_customer_save_address', 99, 2 );

// add_action( 'woocommerce_edit_account_form', 'test');
// function test(){
// 	wp_redirect( home_url('/my-account/edit-account') ) ;
// 	exit();
// }
function new_contact_methods( $contactmethods ) {
	$contactmethods['phone'] = 'Phone Number';
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'new_contact_methods', 10, 1 );


function new_modify_user_table( $column ) {
	$column['phone'] = 'Phone';
	return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

function new_modify_user_table_row( $val, $column_name, $user_id ) {
	switch ($column_name) {
			case 'phone' :
					return get_the_author_meta( 'billing_phone', $user_id );
			default:
	}
	return $val;
}
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );

// 
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
// remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
// remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
 
function custom_override_checkout_fields( $fields ) {
	unset($fields['shipping']['shipping_first_name']);    
	unset($fields['shipping']['shipping_last_name']);  
	unset($fields['shipping']['shipping_company']);
	unset($fields['shipping']['shipping_address_1']);
	unset($fields['shipping']['shipping_address_2']);
	unset($fields['shipping']['shipping_city']);
	unset($fields['shipping']['shipping_postcode']);
	unset($fields['shipping']['shipping_country']);
	unset($fields['shipping']['shipping_state']);

	return $fields;
}

// checkout required fields
// add_filter('woocommerce_billing_fields', 'chef_checkout_fields');
// function chef_checkout_fields(){

// 	unset($fields['billing']['billing_company']);
// 	unset($fields['billing']['billing_address_2']);
// 	unset($fields['billing']['billing_postcode']);
// 	unset($fields['billing']['billing_country']);
// 	unset($fields['billing']['billing_state']);

// 	$fields['billing_first_name'] = array(
// 		'label' => __('First Name', 'woocommerce'),
// 		'required' => true,
// 		'type' => 'text',
// 		'class' => array('popup-checkout__item')
// 	);

// 	$fields['billing_last_name'] = array(
// 		'label' => __('Last Name', 'woocommerce'),
// 		'required' => true,
// 		'type' => 'text',
// 		'class' => array('popup-checkout__item')
// 	);

// 	$fields['billing_phone'] = array(
// 		'label' => __('Phone', 'woocommerce'),
// 		'required' => true,
// 		'type' => 'tel',
// 		'class' => array('popup-checkout__item')
// 	);

// 	$fields['billing_email'] = array(
// 		'label' => __('Email', 'woocommerce'),
// 		'required' => true,
// 		'type' => 'email',
// 		'class' => array('popup-checkout__item')
// 	);

// 	$fields['billing_city'] = array(
// 		'label' => __('City', 'woocommerce'),
// 		'required' => true,
// 		'type' => 'text',
// 		'class' => array('popup-checkout__item')
// 	);

// 	$fields['billing_address_1'] = array(
// 		'label' => __('Street', 'woocommerce'),
// 		'required' => true,
// 		'type' => 'text',
// 		'class' => array('popup-checkout__item')
// 	);

// // 	// $fields['billing_last_name']['label'] = 'Last Name';
// // 	// // $fields['label']['class'] = 'popup-checkout__label';
// // 	// $fields['billing_last_name']['required'] = true;

// // 	// $fields['billing_first_name']['label'] = 'First Name';
// // 	// $fields['billing_first_name']['required'] = true;

// // 	// $fields['billing_phone']['label'] = 'Your Phone';
// // 	// $fields['billing_phone']['required'] = true;

// // 	// $fields['billing_email']['label'] = 'Your Email';
// // 	// $fields['billing_email']['required'] = true;

// // 	// $fields['billing_city']['label'] = 'City';
// // 	// $fields['billing_city']['required'] = true;

// // 	// $fields['billing_address_1']['label'] = 'Street';
// // 	// $fields['billing_address_1']['required'] = true;

// 	return $fields;
// }


// Hook in
add_filter( 'woocommerce_checkout_fields' , 'chef_override_checkout_fields' );
function chef_override_checkout_fields( $fields ) {
		unset($fields["billing"]["billing_country"]);

		$fields['order']['order_comments'] = array(
			'label' => 'Comments',
			'placeholder' => '',
			'type' => 'textarea',
			'class' => array('popup-checkout__item')
		);

    return $fields;
}
add_filter( 'woocommerce_form_field' , 'chef_remove_checkout_optional_fields_label', 10, 4 );
function chef_remove_checkout_optional_fields_label( $field, $key, $args, $value ) {
		$optional = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
		$field = str_replace( $optional, '', $field );
    return $field;
}

// star rating
add_filter('woocommerce_product_get_rating_html', 'chef_get_rating_html', 10, 2);
function chef_get_rating_html($rating_html, $rating) {
	if ( $rating > 0 ) {
		$title = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
	} else {
		$title = 'Not yet rated';
		$rating = 0;
	}
	$rating_html  = '<div class="star-rating" title="' . $title . '">';
	$rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __( 'out of 5', 'woocommerce' ) . '</span>';
	$rating_html .= '</div>';
	return $rating_html;
}

// Add custom fields to a specific selected shipping method
add_action( 'woocommerce_after_shipping_rate', 'pickup_store_custom_field', 100, 2 );
function pickup_store_custom_field( $method, $index ) {
    // Only on checkout page and for Local pickup shipping method
    if( is_cart() || $method->method_id !== 'local_pickup' )
        return;

    $chosen_shipping_methods = WC()->session->get('chosen_shipping_methods')[ $index ];

    $chosen_method_id = explode(':', $chosen_shipping_methods);
    $chosen_method_id = reset($chosen_method_id);

    // Only when the chosen shipping method is "local_pickup"
    if( $chosen_method_id !== 'local_pickup' )
        return;

    echo '<div class="wrapper-pickup_store" style="margin-top:16px">
        <label class="title">' . __("Choose your pickup store") . ':</label><br>
        <label for="barsha-store">
            <input type="radio" id="barsha-store" name="pickup_store" value="Barsha">' 
            . __("Barsha") . '<a href="#"><small> '. __("Check Location") . '</small></a>
        </label><br>
        <label for="deira-store">
            <input type="radio" id="deira-store" name="pickup_store" value="Deira">' 
            . __("Deira") . '<a href="#"><small> '. __("Check Location") . '</small></a>
        </label>
    </div>';
}
//
function get_cart_count() {
	wp_send_json_success( WC()->cart->get_cart_contents_count() );
	wp_die();
}
add_action('wp_ajax_cart_count', 'get_cart_count' );
add_action('wp_ajax_nopriv_cart_count', 'get_cart_count' );

function isSubscribed() {
	global $wpdb;

	$tbl = $wpdb->newsletter;

	$newtable = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}newsletter" );

	$is = false;

	foreach ($newtable as $i){
		if( wp_get_current_user()->user_email == $i->email ) {
			$is = true;
		}
	}

	return $is;
}

/**
 * Ajax subscription
 */
add_action('wp_ajax_ajax_subscription', 'ajax_subscription');
add_action('wp_ajax_nopriv_ajax_subscription', 'ajax_subscription');
function ajax_subscription () {
  $resp = [
    'success' => false
  ];
  $res = TNP::subscribe([ 'email' => $_POST['ne'], 'send_emails' => true ]);
  // wp_mail($_POST['ne'], 'Subscribe', $_POST['ne']);

  if ( is_wp_error( $res ) ) {
    $resp['message'] = $res -> get_error_message();
    wp_send_json( $resp );
  }

  $resp['success'] = true;
  wp_send_json( $resp );
}

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );