<?php
/*
 * Plugin Name: Woocommerce iCredit
 * Description: Enable Rivhit iCredit Payment Gateway
 * Version: 3.2.1
 * Author: rivhit.co.il
 * Requires at least: 3.5
 * Tested up to: 4.7
 *
 */


class iCredit{
	
	const SCRIPTS_AND_STYLES_VERSION = '1.2' ;
	
	/**
	 * @var string
	 */
	public $plugin_url;
	
	/**
	 * @var string
	 */
	public $plugin_path;
	
	public function __construct(){
		
		$this->plugin_path = plugin_dir_path(__FILE__);

		//Load icredit payment gateway
		add_action( 'woocommerce_loaded', array( $this, 'load_payment_gateways') );
		add_action( 'woocommerce_loaded', array( $this, 'load_paypal_ipn_handle') );
		add_filter( 'woocommerce_payment_gateways', array( $this, 'icredit_gateway' ) );

        add_action('woocommerce_admin_order_actions_end', array( $this, 'admin_orders_list_print_invoice'));
        add_action('woocommerce_order_actions_start', array( $this, 'admin_invoice_print_link'));

        add_action( 'init', array( $this, 'init' ), 0 );
	}

    function load_payment_gateways(){
		include_once 'class-wc-gateway-icredit-payment.php';
	}

    function load_paypal_ipn_handle(){
        /* Load PayPal IPN */
        $icredit = new WC_Gateway_ICredit;
        add_action( "valid-paypal-standard-ipn-request",array($icredit, 'icredit_valid_paypal_standard_ipn_request'), 10, 1 );
        add_action( "woocommerce_paypal_express_checkout_valid_ipn_request",array($icredit, 'icredit_valid_paypal_standard_ipn_request'), 10, 1 );
    }

	public function icredit_gateway($methods){
		$methods[] = 'WC_Gateway_ICredit' ;
		return $methods ;
	}
	
	public function init(){
		global $wpdb;
		
		$type = "icredit_term";
		$table_name = $wpdb->prefix . $type . 'meta';
		$variable_name = $type . 'meta';
		$wpdb->$variable_name = $table_name;
		
		load_plugin_textdomain('woocommerce_icredit', false, dirname( plugin_basename( __FILE__ ) ) . "/languages");

        if (is_admin()) wp_enqueue_style('print_invoice_button', plugin_dir_url( __FILE__ ).'css/admin-print-invoice.css');
		//REMOVING BREADCRUMBS
		//remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
		
		//Remove shop side bar
		//remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}

	/**
	 * Get the plugin url.
	 *
	 * @access public
	 * @return string
	 */
	public function plugin_url() {
		if ( $this->plugin_url ) return $this->plugin_url;
		return $this->plugin_url = plugins_url( '/', __FILE__ ) ;
	}

    function admin_orders_list_print_invoice(){
        global $post;
        $print_url = get_post_meta($post->ID, 'DocumentURL', true);
        if (!$print_url) return;

        $print_button = '<a id="" target="_blank" data-tip="'.__('Print Invoice', 'woocommerce_icredit').'" class="button tips invoice-button-small " href="'.$print_url.'">';
        $print_button .= __('Print Invoice', 'woocommerce_icredit');
        $print_button .= '</a>';
        echo $print_button;
    }

    function admin_invoice_print_link(){
        global $post;
        $print_url = get_post_meta($post->ID, 'DocumentURL', true);
        if (!$print_url) return;

        $print_button = '<a id="" target="_blank" data-tip="'.__('Print Invoice', 'woocommerce_icredit').'" class="button tips invoice-button invoice-button-small" href="'.$print_url.'">';
        $print_button .= __('Print Invoice', 'woocommerce_icredit');
        $print_button .= '</a>';
        echo $print_button;

    }
}

$GLOBALS['icredit'] = new iCredit();
?>