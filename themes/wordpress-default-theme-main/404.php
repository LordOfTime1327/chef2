<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package coelix
 */

get_header();
?>

	<main class="site-main">

		<section class="page-404">
			<div class="container">
				<div class="wrapper page-404__wrapper">
					<?php if( get_field( '404_img', 'option' ) ) { ?>
					<div class="page-404__img-box">
						<img src="<?= the_field( '404_img', 'option' ); ?>" alt="" class="page-404__img">
					</div>
					<?php } ?>
					<div class="page-404__text-box">
						<?php if( get_field( '404_title', 'option' ) ) { ?>
							<h2 class="page-404__title"><?= the_field( '404_title', 'option' ); ?></h2>
						<?php } ?>
						<?php if( get_field( '404_text', 'option' ) ) { ?>
							<p class="page-404__text"><?= the_field( '404_text', 'option' ); ?></p>
						<?php } ?>
						<?php if( get_field( '404_btn', 'option' ) ) { ?>
							<button class="page-404__btn btn" onclick='history.back()'><?= the_field( '404_btn', 'option' ); ?></button>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>

	</main><!-- #main -->

<?php
get_footer();
