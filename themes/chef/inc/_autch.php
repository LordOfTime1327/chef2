<?php
defined( 'ABSPATH' ) || exit;

/**
 * Script
 * @include
 */
add_action( 'wp_enqueue_scripts', 'cc_ajax_user_script' );
function cc_ajax_user_script(){

    $script_data_array = array(
        'ajaxurl'           => admin_url( 'admin-ajax.php' ),
        'redirecturl' => home_url( '/my-account/' ), 
        'loadingmessage'    => __('Data is being checked, wait a second ...'),
    );
    wp_localize_script( 'wp-embed', 'ajax_account_object', $script_data_array );

}


/**
 *
 */
add_action('init', 'cc_ajax_user_init');
function cc_ajax_user_init() {

    /**
     * Autch
     * @account_autch
     */
    add_action('wp_ajax_account_autch', 'account_autch');
    add_action('wp_ajax_nopriv_account_autch', 'account_autch');

    /**
     * Registration
     * @account_registration
     */
    add_action('wp_ajax_account_registration', 'account_registration');
    add_action('wp_ajax_nopriv_account_registration', 'account_registration');



}

/**
 * Registration
 * @account_registration
 */
function account_registration() {

    check_ajax_referer( 'ajax-nonce', 'security' );

    $data = [];
    $email              = $_POST['email'];
    $password           = $_POST['password'];
    $password_confirm           = $_POST['password_confirm'];
    $username           = $_POST['name'];

    /*
 * Email
 */
    if(empty($email)) :

        $data = [
            'loggedin'  => false,
            'message'   => __( 'You have not filled in the Email field' ),
        ];
        wp_send_json_success($data);

    endif;
    if(!is_email($email)) :

        $data = [
            'loggedin'  => false,
            'message'   => __( 'Invalid Email' ),
        ];
        wp_send_json_success($data);

    endif;

    /**
     *
     */
    if(empty($username)) :

        $data = [
            'loggedin'  => false,
            'message'   => __( 'You did not fill in the Name field' ),
        ];
        wp_send_json_success($data);

    endif;

    /**
     *
     */
    $user_name = get_user_by( 'login', $username );
    if($user_name) :

        $data = [
            'loggedin'  => false,
            'message'   => __( 'User with this login is already registered' ),
        ];
        wp_send_json_success($data);

    endif;

    /**
     *
     */
    $user = get_user_by( 'email', $email );
    if($user) :

        $data = [
            'loggedin'  => false,
            'message'   => __( 'User with this Email already exists' ),
        ];
        wp_send_json_success($data);

    endif;

    /**
     *
     */
    if(empty($password)) :

        $data = [
            'loggedin'  => false,
            'message'   => __( 'You did not fill in the password field' ),
        ];
        wp_send_json_success($data);

    endif;
    if(strlen($password) < 5) :

        $data = [
            'loggedin'  => false,
            'message'   => __( 'Password must be at least 5 characters' ),
        ];
        wp_send_json_success($data);

    endif;

    /**
     * Create User
     */
    $userdata = array(
        'user_login'            => $username,
        'user_pass'             => $password,
        'user_email'            => $email,
        'first_name'            => $username,
        'last_name'             => $username,
        'user_nicename'         => $username,
        'show_admin_bar_front'  => 'false'
    );
    $user_id = wp_insert_user( $userdata );

    if( !is_wp_error($user_id) ) :
        /*
         * URL redirect successfully
         */
        $info = array();
        $info['user_login']     = $username;
        $info['user_password']  = $password;
        $info['remember']       = true;

        $user_signon = wp_signon( $info, false );

        if ( ! is_wp_error($user_signon) ) :

            $data = [
                'loggedin'  => true,
                'message'   => __( 'Successful registration' ),
            ];
            wp_send_json_success($data);

        endif;

    else:

        $data = [
            'loggedin'  => true,
            'message'   => __( 'Registration error. Please try a little later.' ),
        ];
        wp_send_json_success($data);

    endif;

    wp_die();

}

/**
 * Autch
 * @account_autch
 */
function account_autch() {

    check_ajax_referer( 'ajax-nonce', 'security' );

    $data = [];

    $info = [];
    $info['user_login'] = $_POST['email'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );

    if ( is_wp_error($user_signon) ) :

        $data = [
            'loggedin' => false,
            'message' => __( 'Incorrect username or password entered' ),
        ];
        wp_send_json_success($data);

    else:

        $data = [
            'loggedin' => true,
            'message' => __( 'Excellent! Redirecting ...' ),
        ];
        wp_send_json_success($data);

    endif;

    wp_die();

}