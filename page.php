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
          
        <?php elseif(get_row_layout() == 'manifesto'): 
          $mainSentence = get_sub_field('main_sentence');
        ?>
          <section class="section--manifesto-list">
            <div class="block block--manifesto-list">
              <div class="manifesto-list">
                <h2 class="manifesto-list__title"><span><?php echo $mainSentence; ?></span></h2>
                <?php if( have_rows('slogans') ): ?>

                <ul class="manifesto-list__list">

                <?php while( have_rows('slogans') ): the_row(); 
                  $slogan = get_sub_field('slogan');
                  $doDont = get_sub_field('do_dont_text');
                ?>
                  <li class="manifesto-list__item">
                    <p class="manifesto-list__content"><?php echo $slogan; ?></p>
                    <span class="manifesto-list__do-dont"><?php echo $doDont; ?></span>
                  </li>
                <?php endwhile; ?>
                </ul>

                <?php endif; ?>
              </div>
            </div>
          </section>
        <?php endif; ?>
      <?php endwhile; ?>
    <?php endif; ?>
    </main>
  </div>

<?php get_footer(); ?>