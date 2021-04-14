<?php
/**
* Template Name: About Us
*
* @package WordPress
* @subpackage Coelix
* @since Coelix 1.0
*/
get_header();

?>

<main class="about-us-page">
  <section class="about">
    <div class="container">
    
    <?php if( have_rows('article_about') ) : 
      while( have_rows('article_about') ) : the_row();
        $img = get_sub_field('img_about');
        $title = get_sub_field('title_about');
        $text = get_sub_field('text_about'); 
      ?>
        <article class="about__item">
          <div class="about__img-box">
            <img src="<?= $img; ?>" alt="">
          </div>
          <div class="about__text-box">
            <h2 class="about__title"><?= $title; ?></h2>
            <div class="about__text"><?= $text; ?></div>
          </div>
        </article>
      <?php endwhile;
      endif; ?>

    </div>
  </section>
</main>

<?php
get_footer();


       