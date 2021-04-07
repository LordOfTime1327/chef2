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
							<div class="header__burger-line"></div>
							<div class="header__burger-line header__burger-line_middle"></div>
							<div class="header__burger-line header__burger-line_last"></div>
						</div>
					</div>

					<div class="header__logo-box">
						<?php if( get_field( 'logo_header', 'option' ) ) { ?>
							<a href="<?php home_url(); ?>" class="header__logo">
								<img src="<?= the_field( 'logo_header', 'option' ); ?>" alt="" class='header__logo-img'>
							</a>
						<?php } ?>
					</div>

					<?php 
						wp_nav_menu([
							'menu' => 'Header menu',
							'container' => '',
							'items_wrap' => ' <nav class="header__nav header-menu">
																	<ul class="header-menu__list">%3$s</ul>
																	<div class="header__btn-box">
																		<button class="header__btn header__btn-sign-in">Sign In</button>
																		<button class="header__btn header__btn-sign-up">Sign Up</button>
																	</div>	
																</nav>',
						]); 
					?>

					<div class='header__col header__col_end'>
						<div class="header__search">
							<?php echo file_get_contents( get_template_directory_uri() . '/assets/image/svg/search.svg' ) ?>
						</div>
						<div class="header__cart">
							<?php echo file_get_contents( get_template_directory_uri() . '/assets/image/svg/cart.svg' ) ?>
						</div>
					</div>

					<div class="header__btn-box">
						<button class="header__btn header__btn-sign-in">Sign In</button>
						<button class="header__btn header__btn-sign-up">Sign Up</button>
					</div>
				</div>
			</div>
		</div>
	</header>