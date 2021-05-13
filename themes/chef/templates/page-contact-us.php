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
          <form action="" class="contact-us__form contact-form">
            <div class="contact-form__item">
              <label for="name" class="contact-form__label">Name</label>
              <input type="text" class="contact-form__input">
            </div>
            <div class="contact-form__item">
              <label for="name" class="contact-form__label">Tel</label>
              <input type="tel" class="contact-form__input">
            </div>
            <div class="contact-form__item">
              <label for="name" class="contact-form__label">City</label>
              <input type="text" class="contact-form__input">
            </div>
            <div class="contact-form__item">
              <label for="name" class="contact-form__label">Comment</label>
              <textarea type="text" class="contact-form__input contact-form__input_textarea"></textarea>
            </div>
            <div class="contact-form__item">
              <input type="submit" class="contact-form__submit" value='<?= the_field( 'btn_contact' ); ?>'>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
