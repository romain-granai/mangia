<?php 
    $args = array(
        'post_type' => 'pasta',
        'posts_per_page' => -1,
        'orderby'=>'menu_order', 
        'order' => 'ASC'
    ); 

    $products= new WP_Query($args);

    if($products->have_posts()):
?>

<section class="section section--product-slide" id="our-pasta">
    <?php while($products->have_posts()) : $products->the_post(); 
        $mainImg = get_field('product_main_image');
        $mainImgUrl = $mainImg['url'];
        $mainImgAlt = $mainImg['alt'];
        $color = get_field('color');
        $bgType = get_field('background_type');
        $titleArray = str_split(get_the_title());
        $numOfLetter = count($titleArray);
        $supTitle = get_field('sup_title');
        $weight = get_field('weight');
        $imgPositionClass = $products->current_post % 2 == 0 ? 'product-slide--left' : 'product-slide--right';
    ?>
    <div class="block block--product-slide">
        <div class="product-slide product-slide--<?php echo $products->current_post; ?> <?php echo $imgPositionClass; ?> <?php echo $bgType; ?>" style="--color: <?php echo $color; ?>">

        <?php if($mainImg): ?>

            <div class="product-slide__media">
                <img src="<?php echo $mainImgUrl; ?>" alt="<?php echo $mainImgAlt; ?>">
            </div>
            
        <?php endif; ?>

        <div class="product-slide__front">
            <?php if($supTitle): ?>
                <span class="product-slide__sup"><?php echo $supTitle; ?></span>
            <?php endif; ?>
            <a href="<?php echo the_permalink(); ?>" class="btn btn--uppercase product-slide__cta" style="--bg-shadow: <?php echo $color; ?>" data-curtain="<?php echo $color; ?>"><span>EAT ME!</span></a>
            
            <h2 class="product-slide__title" style="--numOfLetter: <?php echo $numOfLetter; ?>">
            <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" data-curtain="<?php echo $color; ?>">
                <?php 
                    foreach ($titleArray as $letter) {
                        echo '<span class="product-slide__letter product-slide__letter--upper">'. $letter .'</span>';
                    }
                ?>
            </a>
            </h2>
            <?php if($weight): ?>
                <span class="product-slide__sub"><?php echo $weight; ?></span>
            <?php endif; ?>

        </div>
        </div>
    </div>
    <?php endwhile; ?>
    <!-- <div class="block block--product-slide">
        <div class="product-slide product-slide--2 product-slide--right anim-bg-2" style="--color: #00BF72">
        <div class="product-slide__media">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/media/img/product-slide-img-2.jpg" alt="">
        </div>
        <div class="product-slide__front">
            <span class="product-slide__sup">Antichi Grani<br> from Sicily<br> –timilia<sup>®</sup>–</span>
            <a href="#" class="btn btn--uppercase product-slide__cta" style="--bg-shadow: #00BF72" data-curtain="#00BF72"><span>EAT ME!</span></a>
            <h2 class="product-slide__title">
            <a href="#" title="ORECCHIETTE">
                <span class="product-slide__letter product-slide__letter--upper">O</span>
                <span class="product-slide__letter product-slide__letter--upper">r</span>
                <span class="product-slide__letter product-slide__letter--upper">e</span>
                <span class="product-slide__letter product-slide__letter--upper">c</span>
                <span class="product-slide__letter product-slide__letter--upper">c</span>
                <span class="product-slide__letter product-slide__letter--upper">h</span>
                <span class="product-slide__letter product-slide__letter--upper">i</span>
                <span class="product-slide__letter product-slide__letter--upper">e</span>
                <span class="product-slide__letter product-slide__letter--upper">t</span>
                <span class="product-slide__letter product-slide__letter--upper">t</span>
                <span class="product-slide__letter product-slide__letter--upper">e</span>
            </a>
            </h2>
            <span class="product-slide__sub">400 gr. netto</span>

        </div>
        </div>
    </div>
    <div class="block block--product-slide">
        <div class="product-slide product-slide--3 product-slide--left anim-bg-3" style="--color: #0078D7">
        <div class="product-slide__media">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/media/img/product-slide-img-3.jpg" alt="">
        </div>
        <div class="product-slide__front">
            <span class="product-slide__sup">Antichi Grani<br> from Sicily<br> –timilia<sup>®</sup>–</span>
            <a href="#" class="btn btn--uppercase product-slide__cta" style="--bg-shadow: #0078D7" data-curtain="#0078D7"><span>EAT ME!</span></a>
            <h2 class="product-slide__title">
            <a href="#" title="Penne">
                <span class="product-slide__letter">R</span>
                <span class="product-slide__letter product-slide__letter--upper">i</span>
                <span class="product-slide__letter product-slide__letter--upper">g</span>
                <span class="product-slide__letter product-slide__letter--upper">a</span>
                <span class="product-slide__letter">t</span>
                <span class="product-slide__letter">o</span>
                <span class="product-slide__letter">n</span>
                <span class="product-slide__letter">i</span>
            </a>
            </h2>
            <span class="product-slide__sub">400 gr. netto</span>
        </div>
        </div>
    </div> -->
</section>

<?php endif; wp_reset_postdata(); ?>