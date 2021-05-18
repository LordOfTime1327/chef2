<?php
/**
* Template Name: My Account
*
* @package WordPress
* @subpackage Coelix
* @since Coelix 1.0
*/
get_header();
?>

<main class="my-account">
  <div class="container">
    <h1 class="my-account__title page-title">My Account</h1>
  </div>
  <div class="container">
    
    <div class="my-account__content-box">
      <?php get_template_part( 'woocommerce/myaccount/navigation' ); ?>

      <div class="woocommerce-MyAccount-content my-account__content">
        <?php
          /**
           * My Account content.
           *
           * @since 2.6.0
           */
          do_action( 'woocommerce_account_content' );
        ?>
      </div>
    </div>
  </div>
</main>

<?php
get_footer();
