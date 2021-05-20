<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<div class="products__card">
	<div class="products__card-img-box">
		<a href="<?= get_the_permalink(); ?>">
			<img src="<?= get_the_post_thumbnail_url(); ?>" alt="" class='products__card-img'>
		</a>
	</div>
	<div class="products__card-info-box">
		<a href="<?= get_the_permalink(); ?>" class='products__card-link'><h2 style='-webkit-box-orient: vertical; -moz-box-orient: vertical; box-orient: vertical;' class="products__card-title"><?= get_the_title(); ?></h2></a>
		<p style='-webkit-box-orient: vertical; -moz-box-orient: vertical; box-orient: vertical;' class="products__card-description"><?= $product->get_short_description(); ?></p>
		<p class="products__card-price"><?= $product -> get_price_html(); ?></p>
	</div>
	<!-- <a href="<?= get_the_permalink(); ?>" class="products__card-link">Buy</a> -->
	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
</div>

