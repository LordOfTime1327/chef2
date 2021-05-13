<?php
/**
* Template Name: Cart
*
* @package WordPress
* @subpackage Coelix
* @since Coelix 1.0
*/
get_header();
?>

<main class="site-main woocommerce-cart cart-page">
  <div class="container">
    <h1 class='cart-page__title'>My cart</h1>

    <?php do_action( 'woocommerce_before_cart' ); ?>
    <div class="woocommerce">
      <form class="woocommerce-cart-form cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
      <?php do_action( 'woocommerce_before_cart_table' ); ?>

      <div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

        <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
          $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
          $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

          if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
            ?>
            <div class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> cart-form__item"">

              <div class="product-thumbnail cart-form__img-box">
                <?php
                  $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                  if ( ! $product_permalink ) {
                    echo $thumbnail; // PHPCS: XSS ok.
                  } else {
                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                  }
                ?>
              </div>

              <div class="cart-form__info-box">
                <div class="product-name cart-form__prod-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                  <?php
                    if ( ! $product_permalink ) {
                      echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                    } else {
                      echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                    }

                    do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                    // Meta data.
                    echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                    // Backorder notification.
                    if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                      echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                    }
                  ?>
                </div>

                <div class="product-quantity cart-form__quantity-box" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                  <?php
                    if ( $_product->is_sold_individually() ) {
                      $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                    } else {
                      $product_quantity = woocommerce_quantity_input(
                        array(
                          'input_name'   => "cart[{$cart_item_key}][qty]",
                          'input_value'  => $cart_item['quantity'],
                          'max_value'    => $_product->get_max_purchase_quantity(),
                          'min_value'    => '1',
                          'product_name' => $_product->get_name(),
                        ),
                        $_product,
                        false
                      );
                    }

                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                  ?>
                </div>

                <div class="product-price cart-form__product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                  <?php
                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                  ?>
                </div>
              </div>

              <div class="product-remove cart-form__remove-box">
                <?php
                  echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    'woocommerce_cart_item_remove_link',
                    sprintf(
                      '<a href="%s" class="cart-form__remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                        <span class="cart-form__remove-line"></span>
                        <span class="cart-form__remove-line"></span>
                      </a>',
                      esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                      esc_html__( 'Remove this item', 'woocommerce' ),
                      esc_attr( $product_id ),
                      esc_attr( $_product->get_sku() )
                    ),
                    $cart_item_key
                  );
                ?>
              </div>
            </div>
            <?php
          }
        }
        ?>

        <?php do_action( 'woocommerce_cart_contents' ); ?>
        
        <div colspan="6" class="actions cart-form__actions">
          <button type="submit" class="button cart-form__update-button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
          <?php do_action( 'woocommerce_cart_actions' ); ?>
        </div>
        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
      </div>

      <?php do_action( 'woocommerce_after_cart_table' ); ?>
      </form>

      <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

      <div class="cart-collaterals">
      <?php
        /**
         * Cart collaterals hook.
         *
         * @hooked woocommerce_cross_sell_display
         * @hooked woocommerce_cart_totals - 10
         */
        do_action( 'woocommerce_cart_collaterals' );
      ?>
      </div>
    </div>
  </div>
</main>

<?php
get_footer();