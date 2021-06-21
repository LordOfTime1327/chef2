<?php
define('WP_USE_THEMES', false);

/** Load WordPress Bootstrap */
$inc = dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-load.php';
if (file_exists($inc) && is_readable($inc)) {
	require_once( $inc );
} 
else 
{
	require_once('../../../wp-load.php');
}

$ipn_logger = new WC_Logger();
$ipn_logger->add('rivhit_ipn', 'NEW IPN FIRED');

global $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header, $woocommerce;

#token by wc documentation 
$token = new WC_Payment_Token_CC();
$icredit = new WC_Gateway_ICredit;
    
# use method get in ipn    
if(stripos($icredit->ipn_method,'GET')!== false)
{
    $saleId =array(
        "SaleId" => $_GET['saleId']
    );

    #get details from transaction
    $jsonData = json_encode($saleId);

    $response = wp_remote_post( $icredit->icredit_payment_gateway_sale_details, array(
            'method' => 'POST',
            'timeout' => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking' => true,
            'headers' => array('Content-Type' => 'application/json'),
            'body' => $jsonData,
            'cookies' => array()
        )
    );

    $json_response = json_decode($response['body']);
    $ipn_get_response = $json_response; 

    #set wpml token 
    if($ipn_get_response->Custom2 == true){
        $icredit->payment_token = $icredit->real_token_lang_1;
    }
      
    #creat token from add-payment-method
    if($ipn_get_response->Custom3 == 'CreatToken' && $ipn_get_response->TransactionToken && ($ipn_get_response->TransactionToken != '00000000-0000-0000-0000-000000000000'))
    {
        $postData = array(
            'Token' => $ipn_get_response->TransactionToken,
            'CreditboxToken'=> $icredit->credit_box_token,
            );

        $jsonData = json_encode($postData);

        $response = wp_remote_post( $icredit->icredit_payment_gateway_get_token_details, array(
            'method' => 'POST',
            'timeout' => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking' => true,
            'headers' => array('Content-Type' => 'application/json'),
            'body' => $jsonData,
            'cookies' => array()
            )
        );

        $json_response = json_decode($response['body']);
        
        $TransactionCardDueDateMMYY = $json_response->CardDueDate; 
        $cardyy = (string)(substr($TransactionCardDueDateMMYY,2));
        $cardmm = (string)(substr($TransactionCardDueDateMMYY,0,2));    
        
        $token = new WC_Payment_Token_CC();
        $token->set_token( (string)($ipn_get_response->TransactionToken) );
        $token->set_gateway_id( 'icredit_payment' ); 
        $token->set_card_type('כרטיס אשראי' );
        $token->set_last4( (string)(substr($json_response->CardNumber,12)));
        $token->set_expiry_month( (string)$cardmm );
        $token->set_expiry_year( '20'.(string)$cardyy);
        $token->set_user_id($ipn_get_response->Custom4);
        $token->save();   
    }

    $ipn_logger->add('rivhit_ipn', 'Payment Token: '. $icredit->payment_token);
    $ipn_logger->add('rivhit_ipn', 'Order: '. $json_response->Order);
    $ipn_logger->add('rivhit_ipn', 'Sale Id: '. $json_response->SaleId);
    $ipn_logger->add('rivhit_ipn', 'Transaction Amount: '. $json_response->TransactionAmount);

	
    $postData = array('GroupPrivateToken' => $icredit->payment_token,
                        'SaleId'=>$saleId['SaleId'],
                        'TotalAmount'=>$ipn_get_response->Amount);

    $jsonData = json_encode($postData);

    $response = wp_remote_post( $icredit->icredit_verify_gateway_url, array(
        'method' => 'POST',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array('Content-Type' => 'application/json'),
        'body' => $jsonData,
        'cookies' => array()
        )
    );

    $ipn_logger->add('rivhit_ipn', 'WP IPN Verify Completed');
    $ipn_logger->add('rivhit_ipn', print_r($response, true));

    $json_response = json_decode($response['body']);

    $ipn_logger->add('rivhit_ipn', 'json Status: '. $json_response->Status);
    $ipn_logger->add('rivhit_ipn', 'TransactionCardNum: '. $json_response->TransactionCardNum);
    $ipn_logger->add('rivhit_ipn', 'Reference: '. $json_response->Reference);
    $ipn_logger->add('rivhit_ipn', 'DocumentURL: '. $json_response->DocumentURL);

    // inspect IPN validation result and act accordingly
    add_post_meta($json_response->Order, 'icredit_status', $json_response->Status);
    
    if ($json_response->Status == 'VERIFIED')
    {

        if($json_response->TransactionToken && ($json_response->TransactionToken != '00000000-0000-0000-0000-000000000000') && ($json_response->Custom5 == 'true')) 
        {
            $TransactionCardDueDateMMYY = $json_response->TransactionCardDueDateMMYY; 
            $cardyy = (string)(substr($TransactionCardDueDateMMYY,2));
            $cardmm = (string)(substr($TransactionCardDueDateMMYY,0,2));
            $token = new WC_Payment_Token_CC();
            $token->set_token( (string)($json_response->TransactionToken) );
            $token->set_gateway_id( 'icredit_payment' ); 
            $token->set_card_type((string)($json_response->TransactionCardName) );
            $token->set_last4( (string)(substr($json_response->TransactionCardNum,12)) );
            $token->set_expiry_month( (string)$cardmm );
            $token->set_expiry_year( '20'.(string)$cardyy );
            $token->set_user_id( $json_response->Custom4 );
            $token->save();
        }
        
        
        $order = new WC_Order($ipn_get_response->Order);

        $order_id = $order->get_id();

        $ipn_logger->add('rivhit_ipn', 'Order ID: '. $order_id);

        if($ipn_get_response->Custom3)
        {
            $ipn_integration_url = $ipn_get_response->Custom3;
            $response = wp_remote_post( $ipn_integration_url, array(
            'method' => 'POST',
            'timeout' => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking' => true,
            'headers' => array('Content-Type' => 'application/json'),
            'body' => $IPNPost,
            'cookies' => array()
            ));    
        }
        
        add_post_meta($order_id, 'icredit_ccnum', $ipn_get_response->TransactionCardNum);
        add_post_meta($order_id, 'icredit_cardname', $ipn_get_response->TransactionCardName);
        add_post_meta($order_id, 'SaleId', $ipn_get_response->SaleId);
        add_post_meta($order_id, 'Reference', $ipn_get_response->Reference);
        add_post_meta($order_id, 'TransactionAmount', $ipn_get_response->TransactionAmount);
        add_post_meta($order_id, 'DocumentURL', $ipn_get_response->DocumentURL);

        $order->add_order_note( __( 'iCredit payment complete.', 'woocommerce_icredit' ) );
        $order->payment_complete();
        do_action('icredit_payment_complete');
    }        
}
else
{
    #get data from post ipn
    $raw_post_data = file_get_contents('php://input');
    $raw_post_array = explode('&', $raw_post_data);
    $IPNPost = array();
    foreach ($raw_post_array as $keyval) {
        $keyval = explode ('=', $keyval);
        if (count($keyval) == 2)
            $IPNPost[$keyval[0]] = urldecode($keyval[1]);
    }


    #set wpml token 
    if(isset($IPNPost['Custom2'])){
        if($IPNPost['Custom2']== true){
        $icredit->payment_token = $icredit->real_token_lang_1;
        }
    }

    #create token from add-payment-method
    if($IPNPost['Custom3'] == 'CreatToken' && $IPNPost['TransactionToken'] && ($IPNPost['TransactionToken'] != '00000000-0000-0000-0000-000000000000'))
    {
        $postData = array(
            'Token' => $IPNPost['TransactionToken'],
            'CreditboxToken'=> $icredit->credit_box_token);
        
        $jsonData = json_encode($postData);

        $response = wp_remote_post( $icredit->icredit_payment_gateway_get_token_details, array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array('Content-Type' => 'application/json'),
                'body' => $jsonData,
                'cookies' => array()
            )
        );

        $json_response = json_decode($response['body']);
        
        $TransactionCardDueDateMMYY = $json_response->CardDueDate; 
        $cardyy = (string)(substr($TransactionCardDueDateMMYY,2));
        $cardmm = (string)(substr($TransactionCardDueDateMMYY,0,2));    
    
        $token = new WC_Payment_Token_CC();
        $token->set_token( (string)($IPNPost['TransactionToken']) );
        $token->set_gateway_id( 'icredit_payment' ); 
        $token->set_card_type('כרטיס אשראי' );
        $token->set_last4( (string)(substr($json_response->CardNumber,12)));
        $token->set_expiry_month( (string)$cardmm );
        $token->set_expiry_year( '20'.(string)$cardyy);
        $token->set_user_id( $IPNPost['Custom4'] );
        $token->save();
    }

    $ipn_logger->add('rivhit_ipn', 'Payment Token: '. $icredit->payment_token);
    $ipn_logger->add('rivhit_ipn', 'Order: '. $IPNPost['Order']);
    $ipn_logger->add('rivhit_ipn', 'Sale Id: '. $IPNPost['SaleId']);
    $ipn_logger->add('rivhit_ipn', 'Transaction Amount: '. $IPNPost['TransactionAmount']);
 
    $postData = array('GroupPrivateToken' =>$IPNPost['GroupPrivateToken'],
                        'SaleId'=>$IPNPost['SaleId'],
                        'TotalAmount'=>$IPNPost['TransactionAmount']);

    $jsonData = json_encode($postData);

    $response = wp_remote_post( $icredit->icredit_verify_gateway_url, array(
        'method' => 'POST',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array('Content-Type' => 'application/json'),
        'body' => $jsonData,
        'cookies' => array()
        )
    );

    $ipn_logger->add('rivhit_ipn', 'WP IPN Verify Completed');
    $ipn_logger->add('rivhit_ipn', print_r($response, true));

    $json_response = json_decode($response['body']);

    $ipn_logger->add('rivhit_ipn', 'json Status: '. $json_response->Status);
    $ipn_logger->add('rivhit_ipn', 'TransactionCardNum: '. $IPNPost['TransactionCardNum']);
	
	$post_reference = '';
	if (isset($IPNPost['Reference']))
	{
		$post_reference = $IPNPost['Reference'];
	}
    $ipn_logger->add('rivhit_ipn', 'Reference: '. $post_reference);
    $ipn_logger->add('rivhit_ipn', 'DocumentURL: '. $IPNPost['DocumentURL']);

    // inspect IPN validation result and act accordingly
    add_post_meta($IPNPost['Order'], 'icredit_status', $json_response->Status);
    
    if ($json_response->Status == 'VERIFIED')
    {
        #add credit card token by user id                                  
        if($IPNPost['TransactionToken'] && ($IPNPost['TransactionToken'] != '00000000-0000-0000-0000-000000000000') && (isset($IPNPost['Custom5']) && $IPNPost['Custom5'] == 'true'))
        {
            $TransactionCardDueDateMMYY = $IPNPost['TransactionCardDueDateMMYY']; 
            $cardyy = (string)(substr($TransactionCardDueDateMMYY,2));
            $cardmm = (string)(substr($TransactionCardDueDateMMYY,0,2));
            $token = new WC_Payment_Token_CC();
            $token->set_token( (string)($IPNPost['TransactionToken']) );
            $token->set_gateway_id( 'icredit_payment' ); 
            $token->set_card_type((string)($IPNPost['TransactionCardName']) );
            $token->set_last4( (string)(substr($IPNPost['TransactionCardNum'],12)) );
            $token->set_expiry_month( (string)$cardmm );
            $token->set_expiry_year( '20'.(string)$cardyy );
            $token->set_user_id( $IPNPost['Custom4'] );
            $token->save();
        }

        $order = new WC_Order($IPNPost['Order']);
        $order_id = $order->get_id();
        $ipn_logger->add('rivhit_ipn', 'Order ID: '. $order_id);

        if($IPNPost['Custom3'])
        {
            $ipn_integration_url = $IPNPost['Custom3'];

            $response = wp_remote_post( $ipn_integration_url, array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array('Content-Type' => 'application/json'),
                'body' => $IPNPost,
                'cookies' => array()
            ));
         
        }
        
        add_post_meta($order_id, 'icredit_ccnum', $IPNPost['TransactionCardNum']);
        add_post_meta($order_id, 'icredit_cardname', $IPNPost['TransactionCardName']);
        add_post_meta($order_id, 'SaleId', $IPNPost['SaleId']);
		
		$post_reference = '';
		if (isset($IPNPost['Reference']))
		{
			$post_reference = $IPNPost['Reference'];
		}
        add_post_meta($order_id, 'Reference', $post_reference);
        add_post_meta($order_id, 'TransactionAmount', $IPNPost['TransactionAmount']);
        add_post_meta($order_id, 'DocumentURL', $IPNPost['DocumentURL']);

        $order->add_order_note( __( 'iCredit payment complete.', 'woocommerce_icredit' ) );
        $order->payment_complete();
        do_action('icredit_payment_complete');
    }
}
?>