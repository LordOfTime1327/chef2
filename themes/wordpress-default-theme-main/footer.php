<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package coelix
 */

?>

	<footer class="footer">
		<div class="container">
			<div class="wrapper footer__wrapper">
				<div class="footer__col">
					<a href="<?= home_url(); ?>" class="footer__logo-box">
						<img src="<?= the_field( 'logo_footer', 'option' ); ?>" alt="" class="footer__logo">
					</a>
				</div>
				<div class="footer__col">
					<?php if( get_field( 'footer_title_second', 'option' ) ) { ?>
						<p class="footer__menu-title"><?= the_field( 'footer_title_second', 'option' ); ?></p>
					<?php } ?>
					<?php 
						wp_nav_menu([
							'menu' => 'Footer menu 1',
							'container' => '',
							'items_wrap' => '<nav class="footer-menu"><ul class="footer-menu__list">%3$s</ul></nav>',
						]); 
					?>
				</div>
				<div class="footer__col">
					<?php if( get_field( 'footer_title_third', 'option' ) ) { ?>
						<p class="footer__menu-title"><?= the_field( 'footer_title_third', 'option' ); ?></p>
					<?php } ?>
					<?php 
						wp_nav_menu([
							'menu' => 'Footer menu 2',
							'container' => '',
							'items_wrap' => '<nav class="footer-menu"><ul class="footer-menu__list">%3$s</ul></nav>',
						]); 
					?>
				</div>
				<div class="footer__col">
					<?php if( get_field( 'footer_title_fourth', 'option' ) ) { ?>
						<p class="footer__menu-title"><?= the_field( 'footer_title_fourth', 'option' ); ?></p>
					<?php } ?>
					<?php 
						wp_nav_menu([
							'menu' => 'Footer menu 3',
							'container' => '',
							'items_wrap' => '<nav class="footer-menu"><ul class="footer-menu__list">%3$s</ul></nav>',
						]); 
					?>
				</div>
				<div class="footer__col">
					<?php if( get_field( 'footer_title_fifth', 'option' ) ) { ?>
						<p class="footer__menu-title"><?= the_field( 'footer_title_fifth', 'option' ); ?></p>
					<?php } ?>
					<div class="footer__soc-box">
						<?php if( get_field( 'footer_instagram_link', 'option' ) ) { ?>
							<a href="<?= the_field( 'footer_instagram_link', 'option' ) ?>" target="_blank" class="footer__soc-link">
								<?= file_get_contents( get_field( 'footer_instagram_image', 'option' ) ) ?>
							</a>
						<?php } ?>
						<?php if( get_field( 'footer_facebook_link', 'option' ) ) { ?>
							<a href="<?= the_field( 'footer_facebook_link', 'option' ) ?>" target="_blank" class="footer__soc-link">
								<?= file_get_contents( get_field( 'footer_facebook_image', 'option' ) ) ?>
							</a>
						<?php } ?>
					</div>
					
				</div>
			</div>
		</div>

		<div class="footer__dev-box">
			<div class="container">
				<p class="footer__dev-text">Coelix @2021</p>
			</div>
		</div>
	</footer>

	<div class="cover-bg"></div>

	<div class="login-popup" style='background-image: linear-gradient(152deg, rgba(170, 170, 170, 0.95), rgba(129, 129, 129, 0.95)), url(<?= get_field( 'login_bg', 'option' ) ?>)'>
			<h2 class="login-popup__title">Log in</h2>

			<form action="" class="login-popup__form">
				<div class="login-popup__item">
					<label for="email" class="login-popup__label">E-mail</label>
					<input type="email" id="email" class="login-popup__input">
				</div>
				<div class="login-popup__item">
					<label for="password" class="login-popup__label">Password</label>
					<input type="password" id='password' name='password' class="login-popup__input">
					<img src="<?= get_template_directory_uri() . '/assets/image/svg/eye.svg' ?>" alt="" class='login-popup__eye'>
				</div>
				<div class="login-popup__item">
					 <input type="submit" value='Send' class='login-popup__submit'>
				</div>
			</form>

			<div class="login-popup__forget-pass">
				<p class='login-popup__forget-pass-text'>
					Forget your password?
					<a href="#" class="login-popup__forget-pass-link">Click here</a>
				</p>
			</div>

			<div class="close-btn close-btn_login"></div>
	</div>

	<div class="register-popup" style='background-image: linear-gradient(152deg, rgba(170, 170, 170, 0.95), rgba(129, 129, 129, 0.95)), url(<?= get_field( 'sign_up_bg', 'option' ) ?>)'>
		<h2 class="register-popup__title">Sign Up</h2>
	
		<form action="" class="register-popup__form">
			<div class="register-popup__item">
				<label for="email" class="register-popup__label">Full name</label>
				<input type="email" class="register-popup__input">
			</div>
			<div class="register-popup__item">
				<label for="email" class="register-popup__label">E-mail</label>
				<input type="email" class="register-popup__input">
			</div>
			<div class="register-popup__item">
				<label for="password" class="register-popup__label">Password</label>
				<input type="password" class="register-popup__input">
				<img src="<?= get_template_directory_uri() . '/assets/image/svg/eye.svg' ?>" alt="" class='register-popup__eye'>
			</div>
			<div class="register-popup__item">
				<label for="password" class="register-popup__label">Confirm Password</label>
				<input type="password" class="register-popup__input">
				<img src="<?= get_template_directory_uri() . '/assets/image/svg/eye.svg' ?>" alt="" class='register-popup__eye'>
			</div>
			<div class="register-popup__item register-popup__item_agreement">
				<input type="checkbox" id='agreement' class='register-popup__checkbox'>
				<label for="agreement" class="register-popup__checkbox-label">I agree with 
					<a href='#' class='register-popup__terms-link'>Terms & Conditions</a>
				</label>
			</div>
			<div class="register-popup__item register-popup__item_submit">
				<input type="submit" value='Send' class='register-popup__submit'>
			</div>
		</form>

		<div class="register-popup__have-acc">
			<p class='register-popup__have-acc-text'>
				Already have an acoount? 
				<a href="#" class="register-popup__have-acc-link">Click here</a>
			</p>
		</div>

		<div class="close-btn close-btn_register"></div>
	</div>


<?php wp_footer(); ?>

</body>
</html>
