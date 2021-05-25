<?php
/**
* Template Name: Terms & conditions
*
* @package WordPress
* @subpackage Coelix
* @since Coelix 1.0
*/
get_header();
?>

<main class='terms'>
  <div class="container">
    <h1 class="title terms__title">Terms & Conditions</h1>

    <?= get_the_content(); ?>
  </div>
</main>

<?php
get_footer();