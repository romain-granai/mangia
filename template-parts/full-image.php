<section class="section section--full-img section--viewport">
    <div class="block block--full-img">
        <?php if(get_field('full_image_image')): ?>
            <div class="full-img__media">
                <img src="<?php echo get_field('full_image_image')['url']; ?>" alt="<?php echo get_field('full_image_image')['alt']; ?>">
            </div>
        <?php endif; ?>
        <?php if(get_field('full_image_text')): ?>
            <div class="full-img__text title"><?php echo get_field('full_image_text'); ?></div>
        <?php endif; ?>
        
        <?php
            $cta = get_field('full_image_cta');

            if($cta): 
                $ctaUrl = $cta['url'];
                $ctaTitle = $cta['title'];
                $ctaTarget = $cta['target'] ? $cta['target'] : '_self'; 
        ?>
        <div class="full-img__cta"><a href="<?php echo $ctaUrl; ?>" class="btn btn--is-light" target="<?php echo esc_attr( $link_target ); ?>" title="<?php echo $ctaTitle; ?>" style="--bg-color: transparent"><span><?php echo $ctaTitle; ?></span></a>
        </div>
        <?php endif; ?>
    </div>
</section>