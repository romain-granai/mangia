<?php get_header(); ?>

  <div data-barba="container" data-barba-namespace="page">
    <main class="main">
    <?php if( have_rows('blocks') ): ?>
      <?php while( have_rows('blocks') ): the_row(); ?>

        <?php if( get_row_layout() == 'text' ): 
          $content = get_sub_field('content');  
          $cta = get_sub_field('cta');
          $ctaLabel = get_sub_field('cta_label');
        ?>

          <section class="section section--just-text">
            <div class="block block--just-text">
              <div class="just-text">
                <?php if($cta): ?>
                <div class="cta"><a href="<?php echo $cta ?>" class="btn btn--big" title="<?php echo $ctaLabel; ?>"><span><?php echo $ctaLabel; ?></span></a></div>
                <?php endif; ?>
                <div class="title">
                  <?php echo $content; ?>
                </div>
              </div>
            </div>
          </section>
          
        <?php elseif(get_row_layout() == 'paragraph'): ?>

        <?php endif; ?>
      <?php endwhile; ?>
    <?php endif; ?>
    </main>
  </div>

<?php get_footer(); ?>