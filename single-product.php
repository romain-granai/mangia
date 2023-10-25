<?php get_header(); ?>

  <div data-barba="container" data-barba-namespace="single-product">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); 
            $color = get_field('color');
            $bgType = get_field('background_type');
            $productImages = get_field('product_gallery');
            $titleArray = str_split(get_the_title());
            $supTitle = get_field('sup_title');
            $weight = get_field('weight');
        ?>

        <section class="section section--single-product" data-color="<?php echo $color; ?>">
            <div class="block block--single-product">
            <div class="single-product">
                <div class="single-product__side single-product__side--media <?php echo $bgType; ?>" style="--color: <?php echo $color; ?>">
                    <?php if($productImages): ?>
                        <div class="single-product__swiper swiper">
                            <div class="swiper-wrapper">
                            <?php foreach( $productImages as $image ): ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
                                </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="prev-next">
                            <button class="prev-next__arrow prev-next__arrow--prev">→</button>
                            <button class="prev-next__arrow prev-next__arrow--next">→</button>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="single-product__side single-product__side--text">
                <header class="header header--single-product">
                    <?php if($supTitle): ?>
                        <span class="single-product__sup"><?php echo $supTitle; ?></span>
                    <?php endif; ?>
                    <?php $howManyLetter = strlen(get_the_title()); ?>
                    <h1 class="single-product__title" style="--numOfLetter: <?php echo $howManyLetter; ?>">
                        <?php echo the_title(); ?>
                    </h1>
                </header>
                <main>
                    <div class="single-product__intro">
                        <?php the_content(); ?>
                    </div>

                    <!-- <?php if( have_rows('manifesto_table') ): ?>
                    <div class="manifesto">
                        <?php while( have_rows('manifesto_table') ): the_row(); ?>
                        <div class="manifesto__col">
                            <?php if( have_rows('row') ): ?>
                                <?php while( have_rows('row') ): the_row(); 
                                    $content = get_sub_field('content');
                                ?>
                                    <span class="manifesto__item"><?php echo $content; ?></span>
                                <?php endwhile; ?>
                             <?php endif; ?>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?> -->
                    
                    <?php if( have_rows('benefits_table') ): ?>
                        <div class="benefits">
                            <?php while( have_rows('benefits_table') ): the_row(); 
                                $text = get_sub_field('text');
                            ?>
                                <div class="benefit">
                                    <span><?php echo $text; ?></span>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    <?php if( have_rows('tables') ): ?>
                        <?php while( have_rows('tables') ): the_row(); ?>

                            <?php if( get_row_layout() == 'simple_table' ): 
                                $borderClass = get_sub_field('border');    
                                $marginClass = get_sub_field('margin');    
                            ?>

                                <?php if( have_rows('table') ): ?>
                                <div class="simple-table <?php echo $borderClass; ?> <?php echo $marginClass; ?>">
                                    <div class="row">
                                    <?php while( have_rows('table') ): the_row(); 
                                        $item = get_sub_field('item');
                                    ?>
                                        <div class="col text-center">
                                            <span><?php echo $item; ?></span>
                                        </div>
                                    <?php endwhile; ?>
                                    </div>
                                </div>
                                <?php endif; ?>

                            <?php elseif(get_row_layout() == 'table'): 
                                $roundedClass = get_sub_field('is_rounded') ? 'table--rounded' : '';
                                $marginClass = get_sub_field('margin'); 
                            ?>
                                <?php if( have_rows('row') ): ?>
                                    <div class="table <?php echo $roundedClass; ?> <?php echo $marginClass; ?>">
                                    <?php while( have_rows('row') ): the_row(); 
                                        $borderBetweenSubItemClass = get_sub_field('border_between_sub-items');
                                    ?>
                                        <div class="row <?php echo $borderBetweenSubItemClass; ?>">
                                            <?php if( have_rows('column') ): ?>
                                                <?php while( have_rows('column') ): the_row(); 
                                                    $content = get_sub_field('content');
                                                    $isDarkClass = get_sub_field('is_dark') ? 'col--dark' : '';
                                                    $alignmentClass = get_sub_field('text_alignment');
                                                    $titleClass = get_sub_field('is_title') ? 'is-title' : '';;
                                                ?>
                                                <div class="col <?php echo $isDarkClass; ?> <?php echo $alignmentClass; ?> <?php echo $titleClass; ?>">
                                                    <?php echo $content; ?>
                                                </div>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                        <?php endwhile; ?>
                    <?php endif; ?>
                </main>

                </div>
            </div>
            </div>
        </section>

        <?php endwhile; ?>

    <?php endif; ?>

    </div>

<?php get_footer(); ?>