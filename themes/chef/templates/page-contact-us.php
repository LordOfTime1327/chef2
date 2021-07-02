<?php
/**
* Template Name: Contact Us
*
* @package WordPress
* @subpackage Coelix
* @since Coelix 1.0
*/
get_header();

?>

<main>
  <section class="contact-us">
    <div class="container">
      <div class="wrapper">
        <div class="contact-us__item">
          <?php if ( get_field( 'title_contact' ) ) { ?>
          <h1 class="contact-us__title"><?= the_field( 'title_contact' ); ?></h1>
          <?php } ?>
          <?php if ( get_field( 'img_contact' ) ) { ?>
          <div class="contact-us__img-box">
            <img src="<?= the_field( 'img_contact' ); ?>" alt="" class="contact-us__img">
          </div>
          <?php } ?>
        </div>
        <div class="contact-us__item">
          <?= do_shortcode('[contact-form-7 id="397" title="Contact us" html_class="contact-us__form contact-form"]') ?>
        </div>
        <div class="contact-us__img-box contact-us__img-box_mob">
          <img src="<?= the_field( 'img_contact' ); ?>" alt="" class="contact-us__img">
        </div>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();