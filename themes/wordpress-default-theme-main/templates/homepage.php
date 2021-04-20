<?php
/**
* Template Name: Homepage
*
* @package WordPress
* @subpackage Coelix
* @since Coelix 1.0
*/
get_header();

?>

<main class="homepage">
	<section class='intro'>
		<?php if ( get_field( 'bg_intro' ) ) { ?> 
			<img src="<?= the_field( 'bg_intro' ); ?>" alt="" class="intro__bg">
		<?php } ?>
		<div class="container">
			<div class="wrapper">
				<div class="intro__img-box">
					<?php if ( get_field( 'img_intro' ) ) { ?>
						<img src="<?= the_field( 'img_intro' ); ?>" alt="" class="intro__img">
					<?php } ?>
				</div>
				<div class="intro__text-box">
					<?php if ( get_field( 'title_intro' ) ) { ?>
						<h1 class="intro__title"><?= the_field( 'title_intro' ); ?></h1>
					<?php } ?>
					<?php if ( get_field( 'title_intro' ) ) { ?>
						<p class="intro__text"><?= the_field( 'text_intro' ); ?></p>
					<?php } ?>
					<?php if ( get_field( 'title_intro' ) ) { ?>
						<a href='<?php home_url( '/catalog' ); ?>' class="btn"><?= the_field( 'button_intro' ); ?></a>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>

	<section class="features">
		<div class="container">
			<?php if ( get_field( 'title_features' ) ) { ?>
				<h2 class="title decor features__title"><?= the_field( 'title_features' ); ?></h2>
			<?php } ?>

			<?php if( have_rows( 'item_features' ) ): ?>
				<div class="wrapper wrapper_row">
					<?php while( have_rows('item_features') ) : the_row(); 
						$icon_features = get_sub_field( 'icon_item_features' );
						$text_features = get_sub_field( 'text_item_features' );
					?>
						<div class="features__item">
							<div class="features__img-box">
							    <?php echo file_get_contents( get_attached_file( $icon_features ) ); ?>
								
							</div>
							<div class="features__text-box">
								<p class="features__text"><?= $text_features; ?></p>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<section class="brands">
		<div class="container">
			<?php if( get_field( 'title_brands' ) ) { ?>
				<h2 class="title decor brands__title"><?= the_field( 'title_brands' ); ?></h2>
			<?php } ?>

			<?php if( have_rows( 'item_brands' ) ): ?>
				<div class="wrapper wrapper_row brands__wrapper">
					<?php while( have_rows('item_brands') ) : the_row(); 
						$image_brands = get_sub_field( 'image_item_brands' );
					?>
						<div class="brands__item">
							<div class="brands__img-box">
								<img src="<?= $image_brands; ?>" alt="" class='brands__img'>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();
