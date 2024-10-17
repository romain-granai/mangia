<?php if( have_rows('blocks') ): ?>
    <?php while( have_rows('blocks') ): the_row(); ?>

        <?php if( get_row_layout() == 'text' ): 
        $content = get_sub_field('content');
        $textSizeClass = 'just-text--' . get_sub_field('text_size');
        $columnSizeClass = 'just-text--' . get_sub_field('column_size');
        $fullHeightClass = get_sub_field('full_height') ? 'just-text--full-height' : '';
        $verticalAlignClass = 'just-text--' . get_sub_field('vertical_alignment');
        $breathClass = get_sub_field('a_bit_of_space_over_and_under') ? 'just-text--breath':'';
        ?>
        
        <div class="block block--just-text">
            <div class="just-text <?php echo $textSizeClass . ' ' . $columnSizeClass . ' ' . $fullHeightClass . ' ' . $verticalAlignClass . ' ' . $breathClass; ?>">
            <div>
                <?php echo $content; ?>
            </div>
            </div>
        </div>

        
        <?php elseif(get_row_layout() == 'manifesto'): 
        $mainSentence = get_sub_field('main_sentence');
        ?>

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

        <?php elseif(get_row_layout() == 'dropdowns'): ?>

            <div class="block block--dropdowns">
            <?php if( have_rows('dropdown') ): ?>
                <ul class="dropdowns">

                <?php while( have_rows('dropdown') ): the_row(); 
                $title = get_sub_field('title');
                $subTitle = get_sub_field('sub-title');
                $typeClass = $subTitle ? 'dropdown__trigger--fancy': '';
                $content = get_sub_field('content');
                ?>
                <li class="dropdown">
                    <button class="dropdown__trigger <?php echo $typeClass; ?>">
                    <div class="dropdown__titles">
                        <h2 class="dropdown__title"><?php echo $title; ?></h2>
                        <?php if($subTitle): ?>
                        <h3 class="dropdown__subtitle"><?php echo $subTitle; ?></h3>
                        <?php endif; ?>
                    </div>
                    <span class="dropdown__plus-minus"></span>
                    </button>
                    <div class="dropdown__content">
                    <div><?php echo $content; ?></div>
                    </div>
                </li>
                <?php endwhile; ?>

                </ul>
            <?php endif; ?>
            </div>

        <?php elseif(get_row_layout() == 'pattern_title'): 
        $title = get_sub_field('title');
        $howManyLetter = strlen($title);
        $isH1 = get_sub_field('is_h1');
        $titleSize = get_sub_field('title_size');
        $backgroundType = get_sub_field('background_type');
        $img = get_sub_field('image');
        $txtColor = get_sub_field('title_color');
        $imgPos = get_sub_field('alignment');
        ?>

        <?php if($isH1): ?>
        <header class="block block--title-pattern">
        <?php else: ?>
        <div class="block block--title-pattern">
        <?php endif; ?>

        <div class="title-pattern title-pattern--<?php echo $titleSize; ?> <?php echo $backgroundType; ?>" style="--how-many-letter: <?php echo $howManyLetter; ?>; --txtColor:<?php echo $txtColor; ?>">
            <?php if($backgroundType == 'img'): ?>
            <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_url($img['alt']); ?>" class="title-pattern__img" style="--top-pos: <?php echo $imgPos . '%'; ?> ">
            <?php endif; ?>
            <?php if($isH1): ?>
            <h1><?php echo $title; ?></h1>
            <?php else: ?>
            <h2><?php echo $title; ?></h2>
            <?php endif; ?>
        </div>

        <?php if($isH1): ?>
        </header>
        <?php else: ?>
        </div>
        <?php endif; ?>

        <?php elseif(get_row_layout() == 'underline_list'): ?>
        <div class="block block--underline-list">

            <?php if(have_rows('underline_list')): ?>
            <ul class="underline-list">
                <?php while( have_rows('underline_list') ): the_row(); 
                $topContent = get_sub_field('top_content');
                $bottomContent = get_sub_field('bottom_content');
                ?>

                <li class="underline-list__item">
                    <?php if($topContent): ?>
                    <span class="underline-list__top-content"><?php echo $topContent; ?></span>
                    <?php endif; ?>
                    <?php if($bottomContent): ?>
                    <p class="underline-list__bottom-content"><?php echo $bottomContent; ?></p>
                    <?php endif; ?>
                </li>

                <?php endwhile; ?>
            </ul>
            <?php endif; ?>

        </div>

        <?php elseif(get_row_layout() == 'brand_title'): 
        $title = get_sub_field('title');  
        ?>

            <h2 class="block brand-title"><?php echo $title; ?></h2>

        <?php elseif(get_row_layout() == 'big_image'): 
        $images = get_sub_field('big_image');  
        ?>  

        <div class="block block--double-img">
            <?php if($images): ?>
            <div class="double-img">
            <?php foreach( $images as $img ): ?>
                <div class="double-img__item">
                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_url($img['alt']); ?>">
                </div>
            <?php endforeach; ?>

            </div>
            <?php endif; ?>
            </div>
        <?php elseif(get_row_layout() == 'small_image'): 
        $img = get_sub_field('image');
        $sizeClass = get_sub_field('size') == 'small' ? ' small-img--sm' : '';
        ?>
        <div class="block block--small-img">
            <div class="small-img<?php echo $sizeClass; ?>">
            <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_url($img['alt']); ?>">
            </div>
        </div>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>