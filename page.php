<?php get_header(); ?>

  
    <main class="main">
      
    <?php content_blocks(); ?>

    <?php if ( !empty( get_the_content() ) ): ?>
      <?php if( is_cart() || is_checkout() || is_account_page() ): ?>
        <?php echo the_content(); ?>
      <?php else: ?>
        <section class="section section--the-content">
        <div class="block block--the-content">
          <div class="the_content">
            <?php echo the_content(); ?>
          </div>
        </div>
      </section>
      <?php endif; ?>  
    <?php endif; ?>


    </main>
  

<?php get_footer(); ?>