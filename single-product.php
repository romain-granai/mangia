<?php get_header(); ?>

  <div data-barba="container" data-barba-namespace="single-product">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); 
            // $mainImg = get_field('product_main_image');
            // $mainImgUrl = $mainImg['url'];
            // $mainImgAlt = $mainImg['alt'];
            $color = get_field('color');
            $bgType = get_field('background_type');
            $titleArray = str_split(get_the_title());
        ?>

        <section class="section section--single-product">
            <div class="block block--single-product">
            <div class="single-product">
                <div class="single-product__side single-product__side--media <?php echo $bgType; ?>" style="--color: <?php echo $color; ?>">
                    <div class="single-product__swiper swiper">
                        <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/media/img/product-slide-img-1.jpg" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/media/img/product-slide-img-2.jpg" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/media/img/product-slide-img-3.jpg" alt="">
                        </div>
                        </div>
                    </div>
                    <div class="prev-next">
                        <button class="prev-next__arrow prev-next__arrow--prev">→</button>
                        <button class="prev-next__arrow prev-next__arrow--next">→</button>
                    </div>
                </div>
                <div class="single-product__side single-product__side--text">
                <header class="header header--single-product">
                    <span class="single-product__sup">Antichi Grani<br> from Sicily<br> –timilia<sup>®</sup>–</span>
                    <h1 class="single-product__title">
                        <?php echo the_title(); ?>
                    </h1>
                </header>
                <main>
                    <div class="single-product__intro">
                        <?php the_content(); ?>
                    </div>
                    <div class="table table--rounded table--no-margin-b">
                    <div class="row">
                        <div class="col col--dark text-center">
                        <h3 class="ff-serif">*Low gluten index</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                        <p>The Gluten Index measures the strength of gluten in grains, which affects the quality of pasta. A higher index means the pasta is more elastic but can be harder to digest, causing post-meal bloating and drowsiness. Modern durum wheat has a high Gluten Index of about 90%. Our ancient Russello® durum wheat has a lower index of 50 – 60%, making it easier to tolerate, even for people with gluten sensitivities other than celiac disease.</p>
                        </div>
                    </div>
                    </div>
                    <div class="simple-table simple-table--no-border-t">
                    <div class="row">
                        <div class="col text-center">
                        <span>Milled in our own stone mill</span>
                        </div>
                        <div class="col text-center">
                        <span>Slow processing</span>
                        </div>
                        <div class="col text-center">
                        <span>Bronze drawing</span>
                        </div>
                        <div class="col text-center">
                        <span>Low-temperature drying</span>
                        </div>
                    </div>
                    </div>
                    <div class="table">
                    <div class="row">
                        <div class="col col--dark text-center">
                        <p><strong>Valori nutrizionali medi</strong> per 100 g | <strong>Average nutritional</strong> values per 100 g | <strong>Valeurs nutritionnelles moyennes</strong> pour 100 g | <strong>Durchschnittliche Nährwerte</strong> je 100 g</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">Energia|Energy|Énérgie|Energie</div>
                        <div class="col text-right">1532 kJ / 361 kcal</div>
                    </div>
                    <div class="row row--col-border">
                        <div class="col">
                        <h3><strong>Grassi|Fat|Matières grasses|Fett ↘ di cui:</strong> acidi grassi saturi|of which: saturates|dont: acides gras saturés davon: gesättigte Fettsäuren</h3>
                        </div>
                        <div class="col text-right">
                        <p>1,0 g <br>0,4 g</p>
                        </div>
                    </div>
                    <div class="row row--col-border">
                        <div class="col">
                        <h3>Carboidrati|Carbohydrate|Glucides Kohlenhydrate ↘ di cui: zuccheri|of which: sugars dont: sucre|davon: Zucker</h3>
                        </div>
                        <div class="col text-right">
                        <p>72 g <br>3,2 g</p>
                        </div>
                    </div>
                    <div class="row row--col-border">
                        <div class="col">
                        <h3>Fibre|Fibre|Fibres alimentaires|Ballaststoffe</h3>
                        </div>
                        <div class="col text-right">
                        <p>4,1 g</p>
                        </div>
                    </div>
                    <div class="row row--col-border">
                        <div class="col">
                        <h3>Fibre|Fibre|Fibres alimentaires|Ballaststoffe</h3>
                        </div>
                        <div class="col text-right">
                        <p>4,1 g</p>
                        </div>
                    </div>
                    <div class="row row--col-border">
                        <div class="col">
                        <h3>Fibre|Fibre|Fibres alimentaires|Ballaststoffe</h3>
                        </div>
                        <div class="col text-right">
                        <p>4,1 g</p>
                        </div>
                    </div>
                    </div>
                </main>

                </div>
            </div>
            </div>
        </section>

        <?php endwhile; ?>

    <?php endif; ?>

    </div>

<?php get_footer(); ?>