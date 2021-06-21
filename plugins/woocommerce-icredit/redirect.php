<?php 

/** Load WordPress Bootstrap */
$inc = dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-load.php';
if (file_exists($inc) && is_readable($inc)) {
	require_once( $inc );
} 
else 
{
	require_once('../../../wp-load.php');
}

$redirect = WC()->session->get('icredit_iframe_redirect_url');

if ($redirect == '')
{
	$redirect_decode=$_GET['RedirectUrl'];
	$redirect = urldecode($redirect_decode);
}

if ($redirect == '')
{
    $redirect='about:blank';
}
else
{
    $token = $_GET['Token'];
    if (strpos($redirect, '?') > 0) 
    { 
        $redirect .= '&'; 
    }
    else 
    { 
        $redirect .= '?'; 
    }
    
    $redirect .= 'Token='.$token;
}
?>
<script>window.top.location = "<?= $redirect; ?>";</script>
