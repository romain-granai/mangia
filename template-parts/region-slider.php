<?php if( have_rows('region_slider') ): ?>

<section class="section section--region-slider section--bottom-b" id="antichi-grani">
    <div class="block block--region-slider">
        <div class="region-slider">
        <div class="region-slider__bottom">
            <div class="region-slider__media">
            <div class="prev-next">
                <button class="prev-next__arrow prev-next__arrow--prev">→</button>
                <button class="prev-next__arrow prev-next__arrow--next">→</button>
            </div>

            

            <div class="region-slider__media__in">

                <?php while( have_rows('region_slider') ): the_row(); 
                    $image = get_sub_field('image');
                    $imageUrl = $image['sizes']['large'];
                    $imageAlt = $image['alt'];
                    $activeClass = 	get_row_index() == 1 ? 'class="is-active"' : '';
                ?>

                    <img src="<?php echo $imageUrl; ?>" alt="<?php echo $imageAlt; ?>" <?php echo $activeClass ?>>

                <?php endwhile; ?>

            </div>


            </div>

            <div class="region-slider__infos">
            <?php while( have_rows('region_slider') ): the_row(); 
                $title = get_sub_field('title');
                $titleArray = str_split($title);
                $subTitle = get_sub_field('sub_title');
                $activeClass = 	get_row_index() == 1 ? 'is-active' : '';
            ?>

                <div class="region-slider__info <?php echo $activeClass; ?>">

                    <h2 class="region-slider__title">
                        <?php
                            foreach ($titleArray as $letter) {
                                if(!ctype_space($letter)){
                                    echo '<span class="region-slider__letter">'. $letter .'</span>';
                                } else {
                                    echo '<span class="region-slider__letter">&nbsp;</span>';
                                }
                            }
                        ?>

                    </h2>
                    <?php if($subTitle): ?>
                        <span class="region-slider__sub"><?php echo $subTitle; ?></span>
                    <?php endif; ?>
                </div>

            <?php endwhile; ?>

            </div>
        </div>

        <div class="region-slider__circles">

            <?php while( have_rows('region_slider') ): the_row(); 
                $textOnCircle = get_sub_field('text_on_circle');
                $activeClass = 	get_row_index() == 1 ? 'is-active' : '';
            ?>

            <div class="region-slider__circle <?php echo $activeClass; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 400 201">
                    <defs>
                    <!-- <path class="cls-1" id="path" d="M33.5,183a167.5,167.5,0,0,1,335,0" transform="translate(-33 -15)"/> -->
                    <rect class="cls-1" x="0.5" y="0.5" width="400" height="201" />
                    <path class="cls-1" id="path" d="M33.5,183a167.5,167.5,0,0,1,335,0"
                        transform="translate(0.5 0.5)" />
                    </defs>


                    <text text-anchor="middle">
                    <textPath xlink:href="#path" startOffset="50%" dominant-baseline="hanging"><?php echo $textOnCircle; ?></textPath>
                    </text>
                </svg>
            </div>

            <?php endwhile; ?>

        </div>

        </div>
    </div>
</section>

<?php endif; ?>