<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package coelix
 */

?>
<!doctype html>
<html <?php language_attributes() ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class( 'rtl' ); ?>>
  <?php wp_body_open(); ?>

  <header class="header">

    <?php if( get_field( 'promotion_text', 'option' ) ) { ?>
    <div class="header__promotion-box">
      <div class="container">
        <p class="header__promotion-text"><?= the_field( 'promotion_text', 'option' ); ?></p>
      </div>
    </div>
    <?php } ?>

    <div class="header__main">
      <div class="container">
        <div class="wrapper wrapper_row">
          <div class="header__col">
            <div class="header__burger">
              <div class="header__burger-line header__burger-line_first"></div>
              <div class="header__burger-line header__burger-line_middle"></div>
              <div class="header__burger-line header__burger-line_last"></div>
            </div>
          </div>

          <div class="header__logo-box">
            <?php if( get_field( 'logo_header', 'option' ) ) { ?>
            <a href="<?= home_url(); ?>" class="header__logo">
              <img src="<?= the_field( 'logo_header', 'option' ); ?>" alt="" class='header__logo-img'>
            </a>
            <?php } ?>
          </div>

          <nav class="header__nav header-menu">
            <?php 
							wp_nav_menu([
								'menu' => 'Header menu',
								'container' => '',
								'items_wrap' => '<ul class="header-menu__list">%3$s</ul>',
							]); 
						?>
            <?php if( is_user_logged_in() ) { ?>
            <a href="<?= home_url( '/my-account' ); ?>" class="header__logged-box">
              <p class="header__logged-name"><?php echo wp_get_current_user()->user_login; ?></p>
              <div class="header__logged-img-box">
                <?= file_get_contents( get_theme_file_path() . '/assets/image/svg/user.svg' ) ?>
              </div>
            </a>
            <?php } else { ?>
            <div class="header__btn-box">
              <button class="header__btn header__btn-sign-in">Sign In</button>
              <button class="header__btn header__btn-sign-up">Sign Up</button>
            </div>
            <?php } ?>
          </nav>

          <div class='header__col header__col_end'>
            <div class="header__cart">
              <a href="<?= home_url( '/cart' ); ?>" class="header__cart-link">
                <?php echo file_get_contents( get_theme_file_path() . '/assets/image/svg/cart.svg' ) ?>
                <span><?php echo WC()->cart->get_cart_contents_count(); ?></span>
              </a>
            </div>
            <div class="header__search">
              <?php echo file_get_contents( get_theme_file_path() . '/assets/image/svg/search.svg' ) ?>
              <?php get_template_part( 'woocommerce/product-searchform' ) ?>
            </div>
          </div>

          <?php if( is_user_logged_in() ) { ?>
          <a href="<?= home_url( '/my-account' ); ?>" class="header__logged-box">
            <p class="header__logged-name"><?php echo wp_get_current_user()->user_login; ?></p>
            <div class="header__logged-img-box">
              <?= file_get_contents( get_theme_file_path() . '/assets/image/svg/user.svg' ) ?>
            </div>
          </a>
          <?php } else { ?>
          <div class="header__btn-box">
            <button class="header__btn header__btn-sign-in">Sign In</button>
            <button class="header__btn header__btn-sign-up">Sign Up</button>
          </div>
          <?php } ?>

        </div>
      </div>
    </div>
  </header>