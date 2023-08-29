<section class="section section--social-marquee section--both-b">
    <div class="block block--social-marquee">

    <?php if( have_rows('insta_gallery') ): 
        $instaUrl = get_field('instagram_url', 'option');    
    ?>

        <div class="social-marquee__top">
            <h2>Made for social</h2>
            <?php if($instaUrl):?>
                <a href="<?php echo $instaUrl; ?>" class="btn" target="_blank"><span>Feed me</span></a>
            <?php endif; ?>
        </div>

        <div class="marquee social-marquee">
            
            <div class="marquee-inner">
                <div class="marquee-content">

                    <?php while( have_rows('insta_gallery') ): the_row(); 
                        $image = get_sub_field('image');
                        $imageUrl = $image['sizes']['large'];
                        $imageAlt = $image['alt'];
                        $sizeClass = get_sub_field('size');
                        $positionClass = get_sub_field('position');
                        $rotation = get_sub_field('rotation') . 'deg';
                        
                        $link = get_sub_field('link') ? get_sub_field('link') : $instaUrl;
                    ?>

                        <div class="social-marquee__item <?php echo $sizeClass . ' ' . $positionClass; ?>">
                            <div class="social-marquee__item__in">
                                <a href="<?php echo $link; ?>" target="_blank" style="--rotation: <?php echo $rotation ?>">
                                    <img src="<?php echo $imageUrl; ?>" alt="<?php echo $imageAlt; ?>">
                                </a>
                            </div>
                        </div>

                    <?php endwhile; ?>

                </div>
            </div>
        </div>

    <?php endif; ?>

    </div>
</section>