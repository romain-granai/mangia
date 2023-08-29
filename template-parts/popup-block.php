<section class="section section--viewport section--popup section--bottom-b">

    <div class="block block--popup">
        <div class="popup">
            <div class="poupup__text">
                <h2 class="intro__title title">
                    <?php if(get_field('popup_first_sentence')): ?>
                        <span><?php echo get_field('popup_first_sentence'); ?></span> <br>
                    <?php endif; ?>
                <?php if( have_rows('popup__words') ): 
                        $itemLength = count(get_field('popup__words'))
                    ?>
                    <?php while( have_rows('popup__words') ): the_row(); 
                        $word = get_sub_field('word');
                        $color = get_sub_field('color');
                        $relatedText = get_sub_field('related_text');
                    ?>   
                    
                    <a href="#" class="popup__cta" title="<?php echo $word; ?>" style="--hover-color: <?php echo $color; ?>" data-related-img="<?php echo get_row_index(); ?>" data-text="<?php echo $relatedText; ?>"><?php echo $word; ?></a>

                    <?php if($itemLength == get_row_index()): // If last item, add dot after (end of the sentence)?> 
                        .
                    <?php elseif($itemLength - 1 == get_row_index()): // If before last item, add "and" after ?>
                        and
                    <?php else:  //otherwise add "," after ?>
                        , 
                    <?php endif; ?>
                        
                    <?php endwhile; ?>
                <?php endif; ?>
                
                </h2>
                <div class="popup__popup">
                    <div class="popup__content"></div>
                </div>
            </div>
            <div class="popup__media">

                <img src="<?php echo get_field('popup_main_image')['url']; ?>" alt="<?php echo get_field('popup_main_image')['alt']; ?>" class="is-visible">

                <?php if( have_rows('popup__words') ): ?>
                    <?php while( have_rows('popup__words') ): the_row();
                        $relatedImg = get_sub_field('related_image');
                    ?> 
                        <img src="<?php echo $relatedImg['url']; ?>" alt="<?php echo $relatedImg['alt']; ?>" data-index="<?php echo get_row_index(); ?>">
                    <?php endwhile; ?>
                
                <?php endif; ?>
                
            </div>
        </div>
    </div>
    
</section>