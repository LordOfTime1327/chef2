<?php
/**
* Template Name: Catalog
*
* @package WordPress
* @subpackage Coelix
* @since Coelix 1.0
*/
get_header();

?>

<main class="catalog-page">
 <section class="catalog">
   <div class="container">
      <h1 class="catalog__title decor">Catalog</h1>

      <div class="catalog__products">
        <?= do_shortcode( '[products limit="8" paginate="true"]' ); ?>
      </div>
   </div>
 </section>
</main>

<?php
get_footer();
