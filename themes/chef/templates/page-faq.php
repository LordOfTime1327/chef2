<?php
/**
* Template Name: FAQ
*
* @package WordPress
* @subpackage Coelix
* @since Coelix 1.0
*/
get_header();
?>

<main class="site-main">
  <section class="faq">
    <div class="container">
      <?php $title = get_field( 'title_faq' );
      if($title) { ?>
      <h1 class="faq__title"><?= $title ?></h1>
      <?php } ?>
      <div class="wrapper">
        <?php if( have_rows('faq_items') ): ?>
        <div class="faq__box">
          <?php 
              while( have_rows('faq_items') ) : the_row();
              $question = get_sub_field('question_faq');
              $answer = get_sub_field('answer_faq');
            ?>
          <div class="faq__item">
            <div class="faq__question-box">
              <p class="faq__question"><?= $question ?></p>
              <div class="faq__btn-box"></div>
            </div>
            <div class="faq__answer-box">
              <p class="faq__answer"><?= $answer ?></p>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
        <?php endif; ?>

        <?php $img = get_field( 'image_faq' ); 
        if($img) { ?>
        <div class="faq__img-box">
          <img src="<?= $img ?>" alt="" class="faq__img">
        </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <div class="faq-form">
    <div class="container">
      <?php $title = get_field( 'title_form_faq' );
      if( $title ) { ?>
      <h2 class="faq-form__title"><?= $title ?></h2>
      <?php } ?>
      <?php $subtitle = get_field( 'subtitle_form_faq' );
      if( $subtitle ) { ?>
      <p class="faq-form__subtitle"><?= $subtitle ?></p>
      <?php } ?>
      <div class="wrapper">
        <?php $img = get_field( 'image_form_faq' );
          if( $img ) { ?>
        <div class="faq-form__img-box">
          <img src="<?= $img ?>" alt="" class="faq-form__img">
        </div>
        <?php } ?>

        <form action="" class="faq-form__form contact-form">
          <div class="contact-form__item">
            <label for="name" class="contact-form__label faq-form__label">Name</label>
            <input type="text" class="contact-form__input faq-form__input">
          </div>
          <div class="contact-form__item">
            <label for="name" class="contact-form__label faq-form__label">Tel</label>
            <input type="tel" class="contact-form__input faq-form__input">
          </div>
          <div class="contact-form__item">
            <label for="name" class="contact-form__label faq-form__label">City</label>
            <input type="text" class="contact-form__input faq-form__input">
          </div>
          <div class="contact-form__item">
            <label for="name" class="contact-form__label faq-form__label">Comment</label>
            <textarea type="text"
              class="contact-form__input contact-form__input_textarea faq-form__input faq-form__input_textarea"></textarea>
          </div>
          <div class="contact-form__item">
            <input type="submit" class="contact-form__submit faq-form__submit"
              value='<?= the_field( 'btn_form_faq' ); ?>'>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="question-popup"
    style='background-image: linear-gradient(152deg, rgba(170, 170, 170, 0.95), rgba(129, 129, 129, 0.95)), url(<?= get_field( 'question_bg', 'option' ) ?>)'>
    <h2 class="question-popup__title">Have any questions?</h2>
    <p class="question-popup__subtitle">our manager will contact you</p>

    <form class="question-popup__form">
      <div class="question-popup__item">
        <input type="text" class='question-popup__input' placeholder='Name'>
      </div>
      <div class="question-popup__item">
        <input type="tel" class='question-popup__input' placeholder='Phone'>
      </div>
      <div class="question-popup__item">
        <input type="submit" class='question-popup__submit popup-submit' value='Send'>
      </div>
    </form>

    <div class="close-btn close-btn_question"></div>

  </div>
</main>

<?php
get_footer();