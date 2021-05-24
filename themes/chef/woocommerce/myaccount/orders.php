<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>

<!-- Orders -->
<?php
    $order_count = 999;
    $customer_orders = get_posts(
      apply_filters(
        'woocommerce_my_account_my_orders_query',
        array(
          'numberposts' => $order_count,
          'meta_key'    => '_customer_user',
          'meta_value'  => get_current_user_id(),
          'post_type'   => wc_get_order_types( 'view-orders' ),
          'post_status' => array_keys( wc_get_order_statuses() ),
        )
      )
    );
  ?>

<div class="my-account__orders">
  <?php if ( $customer_orders ) : ?>

  <div class="my-account__order-box">
    <?php
        $currency = get_woocommerce_currency_symbol();
        foreach ($customer_orders as $customer_order) :
          $order = wc_get_order( $customer_order );
          $order_items = $order -> get_items();
          $order_item = array_pop( array_reverse($order_items) );
          $product = $order_item -> get_product();   
        ?>
    <div class="my-account__order-item">
      <div class="my-account__order-header">
        <p class='my-account__order-number'>Order № <?= $order -> get_order_number(); ?></p>
        <p class="my-account__order-date"><?= $order -> get_date_created() -> format('F j, Y '); ?></p>
        <p class="my-account__order-status <?= "my-account__order-status--" . $order->get_status() ?>">
          <?= wc_get_order_status_name( $order->get_status() ); ?></p>
      </div>

      <div class="my-account__order-body">
        <?php 
              foreach ($order_items as $item){
            ?>
        <div class="my-account__order-prod-box">
          <a class="my-account__order-name">
            <div class="my-account__order-img-box">
              <img src="<?= get_the_post_thumbnail_url( $item -> get_product_id() ); ?>" alt="Simcha card"
                class="my-account__order-img">
            </div>
            <p class="my-account__order-prod-title"><?= $item -> get_name(); ?></p>
          </a>
          <div class="my-account__order-count">
            <p class='my-account__order-quantity'><?= $item->get_quantity(); ?></p>
            <p class='my-account__order-price'><?= $item->get_total() . $currency; ?></p>
          </div>
        </div>
        <?php } ?>
      </div>

      <div class="my-account__order-footer">
        <p class="my-account__order-total-price"><span class=>Total: </span><?= $order->get_formatted_order_total(); ?>
        </p>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <?php endif; ?>
</div>

<?php else: ?>
<div class="my-account__empty">
  <?php if( get_field( 'account_empty_img' ) ) { ?>
  <div class="my-account__empty-img-box">
    <img src="<?= get_field( 'account_empty_img' ); ?>" alt="" class='my-account__empty-img'>
  </div>
  <?php } ?>
  <?php if( get_field( 'account_empty_text' ) ) { ?>
  <p class="my-account__empty-text"><?= get_field( 'account_empty_text' ); ?></p>
  <?php } ?>
  <a href="<?= home_url('/catalog'); ?>" class="my-account__empty-link btn"><?= get_field( 'account_empty_btn' ); ?></a>
</div>

<?php endif; ?>