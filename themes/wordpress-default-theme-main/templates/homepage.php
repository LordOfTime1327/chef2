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
<div class="homepage">

    <section class="products main-container">
  		<div class="inner-container" style="background-repeat: no-repeat; background-position: center center;background-size: cover; background-image: url('<?= get_bloginfo('template_url') ?>/assets/images/Welcome-back<?php if(wp_is_mobile()){echo "M";} ?>.png');">
  		  <div class="content-part">
  			  <?php if(wp_is_mobile()){ ?>
  			 <img src="<?= get_bloginfo('template_url') ?>/assets/images/catalog<?php if(ICL_LANGUAGE_CODE == en){ echo "-en";  } ?>.png" alt="" class="section-name">
  			  <?php } ?>
  			     <?php the_field('fifth_text'); ?>
  			  <a class="main-btn" href="<?php the_field('fifth_link'); ?>"><?php the_field('fifth_link_name'); ?></a>
  		  </div>
  			<div class="image-container">
  		      <img src="<?php the_field('fifth_image'); ?>" alt="" class="image-part">
  			   <img src="<?= get_bloginfo('template_url') ?>/assets/images/chains-ver.png" alt="" class="chains">
  			</div>
  			<?php if(!wp_is_mobile()){ ?>
  		  <img src="<?= get_bloginfo('template_url') ?>/assets/images/catalog<?php if(ICL_LANGUAGE_CODE == en){ echo "-en";  } ?>.png" alt="" class="section-name">
  			<?php } ?>
  		</div>
    </section>


</div>



<?php

get_footer();
