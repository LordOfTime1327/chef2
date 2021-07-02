<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'product', $product ); ?>>

  <section class="product__info-box">
    <div class="container">
      <div class="wrapper">

        <div class="product__info product__info_mob">
          <h2 class="product__title"><?= the_title(); ?></h2>
          <p class="product__short-description">
            <?= $product->get_short_description(); ?>
          </p>
          <div class="product__stars">
            <?php do_action( 'showRatingStars' ); ?>
          </div>
        </div>


        <div class="product__slider-box">
          <div class="swiper-container gallery-top product__slider">
            <div class="swiper-wrapper product__slider-wrapper">
              <div class="swiper-slide product__slider-slide">
                <img src="<?= wp_get_attachment_image_url( $product->get_image_id(),'full'); ?>" alt=""
                  class='product__img'>
              </div>

              <?php foreach ($product->get_gallery_image_ids() as $value) :?>
              <div class="swiper-slide product__slider-slide">
                <img src="<?=wp_get_attachment_image_url( $value,'full'); ?>" alt="" class='product__img'>
              </div>
              <?php endforeach;?>
            </div>
          </div>

          <div class="swiper-container gallery-thumbs product__slider-thumbs">
            <div class="swiper-wrapper">
              <div class="swiper-slide product__slider-thumb-slide">
                <img src="<?= wp_get_attachment_image_url( $product->get_image_id(),'full'); ?>" alt=""
                  class='product__img'>
              </div>
              <?php foreach ($product->get_gallery_image_ids() as $value) :?>
              <div class="swiper-slide product__slider-thumb-slide">
                <img src="<?=wp_get_attachment_image_url( $value,'full'); ?>" alt="" class='product__img'>
              </div>
              <?php endforeach;?>
            </div>
          </div>

          <div class="swiper-pagination product__slider-pagination"></div>

          <div class="product__slider-arrow product__slider-arrow_next swiper-button-next"></div>
          <div class="product__slider-arrow product__slider-arrow_prev swiper-button-prev"></div>

        </div>

        <div class="product__info">
          <h2 class='product__title product__title_desc'><?= the_title(); ?></h2>
          <p class="product__short-description product__short-description_desc">
            <?= $product->get_short_description(); ?>
          </p>
          <div class="product__stars product__stars_desc">
            <?php do_action( 'showRatingStars' ); ?>
          </div>
          <div class="product__price">
            <?= $product->get_price_html(); ?>
          </div>
          <div>
            <?php do_action( 'addToCartForm' ); ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class='description'>
    <div class="container">
      <h2 class="description__title decor">Description</h2>
      <div class="description__text-box">
        <?= $product->get_description(); ?>
      </div>
    </div>
  </section>

  <section id='reviews' class='reviews'>
    <div class="container">
      <h2 class="reviews__title decor">Reviews</h2>
      <div class="reviews__box">
        <?php 	
						// $product_id = $product->get_id();
						// $comments = get_comments(array(
						// 	'post_id'=>$product_id,
						// 	'status'=>'approve'
						// ));

						// if($comments){
						// 	wp_list_comments(array(
						// 		'per_page'=>3,
						// 		'reverse_top_level'=>false
						// 	), $comments);
						// } else {
						// 	echo '<p class="reviews__empty">There is no comments</p>';
						// }
							
						// comments_template( 'single-product/review.php' );
						
						$product_id = $product->get_id();
						$comments = get_comments(array(
							'post_id'=>$product_id,
							'status'=>'approve',
						));

						$i = 0; 

						foreach( $comments as $comment ) { 
							$i++;
							if( $i < 4 ){
							?>
        <div class='reviews__item'>
          <div class="reviews__header">
            <div class="reviews__rating"><?php woocommerce_review_display_rating(); ?></div>
            <p class='reviews__date'><?php comment_date(); ?></p>
          </div>
          <div class="reviews__body">
            <p class='reviews__author'><?php comment_author(); ?></p>
            <div class='reviews__text-box'><?php comment_text(); ?></div>
          </div>
        </div>
        <?php 
								}
						}
						if( !$comments ) {
							echo '<p>No reviews yet</p>';
						}
				  ?>
      </div>
      <div class="reviews__btn-box">
        <?php if( $comments ) { ?>
        <button class='btn reviews__btn reviews__show-reviews'>Show All</button>
        <?php } ?>
        <button class='reviews__btn reviews__leave-feedback'>Leave Review</button>
      </div>
    </div>

    <div class="allReviews">
      <h2 class="allReviews__title">Reviews</h2>

      <div class="allReviews__box">
        <?php 
						$product_id = $product->get_id();
						$comments = get_comments(array(
							'post_id'=>$product_id,
							'status'=>'approve',
						));

				foreach( $comments as $comment ) { 
					?>
        <div class='allReviews__item'>
          <div class="allReviews__header">
            <p class='allReviews__rating'><?php echo get_comment_meta( $comment->comment_ID, 'rating', true); ?></p>
            <p class='allReviews__date'><?php comment_date(); ?></p>
          </div>
          <div class="allReviews__body">
            <p class='allReviews__author'><?php comment_author(); ?></p>
            <div class='allReviews__text-box'><?php comment_text(); ?></div>
          </div>
        </div>
        <?php 
						}
						if( !$comments ) {
							echo '<div class="allReviews__empty-box">
											<p class="allReviews__empty">No reviews yet</p>
											<button class="reviews__btn reviews__leave-feedback">Leave Review</button>
										</div>';
						}
					?>
      </div>

      <div class="allReviews__close">
        <span class="allReviews__close-line"></span>
        <span class="allReviews__close-line"></span>
      </div>
    </div>
    <div class="leaveFeedback">
      <h2 class="leaveFeedback__title">Leave Feedback</h2>

      <?php comments_template( 'woocommerce/single-product-reviews' ); ?>

      <div class="leaveFeedback__close">
        <span class="leaveFeedback__close-line"></span>
        <span class="leaveFeedback__close-line"></span>
      </div>
    </div>

  </section>

  <!-- RELATED PRODUCTS -->
  <section class='related'>
    <div class="container">
      <?php woocommerce_output_related_products(); ?>
    </div>
  </section>

  <?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	 // do_action( 'woocommerce_before_single_product_summary' );
	?>

  <!-- <div class="summary entry-summary"> -->

  <?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		
		//do_action( 'woocommerce_single_product_summary' );
		?>
  <!-- </div> -->

  <?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	//  do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php //do_action( 'woocommerce_after_single_product' ); ?>