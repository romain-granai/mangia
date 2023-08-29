<?php get_header(); ?>

  <div data-barba="container" data-barba-namespace="home">

    <?php get_template_part( 'template-parts/header-home'); ?>

    <main class="main">

      <?php get_template_part( 'template-parts/home-intro' ) ?>
      
      <?php get_template_part( 'template-parts/product-slide'); ?>

      <?php get_template_part( 'template-parts/pasta-form'); ?>

      <?php get_template_part( 'template-parts/popup-block'); ?>

      <?php get_template_part( 'template-parts/compare'); ?>

      <?php get_template_part( 'template-parts/region-slider'); ?>

      <?php get_template_part( 'template-parts/full-image'); ?>

      <?php get_template_part( 'template-parts/social-slider'); ?>

    </main>
  </div>

<?php get_footer(); ?>