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


<?php wp_footer(); ?>

</body>
</html>
