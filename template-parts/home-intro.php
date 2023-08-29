<?php
    $homeIntro = get_field('home_intro');
    $topCircleText = get_field('home_intro_text_top_circle');
    $bottomCircleText = get_field('home_intro_text_bottom_circle');
?>
<section class="section section--intro">
    <div class="block block--intro">
        <div class="intro">
            <?php if($homeIntro): ?>
                <h2 class="intro__title title"><?php echo $homeIntro ?></h2>
            <?php endif; ?>
        <!-- <p>Pasta italiana a basso indice di glutine</p> -->
        <svg class="intro__circle" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 843 842.99995">
            <defs>
                <path class="cls-1" id="bottom-path" d="M497.09969,79.00489C265.9227,80.56456,79,268.45077,79,499.99511c0,232.51188,188.48812,421,421,421s421-188.48812,421-421c0-231.5315-186.902-419.40971-418.06122-420.99" transform="translate(-78.5 -78.50002)"/>
            <path class="cls-2" id="top-path" d="M498.90448,920.99863C266.89634,920.40767,79,732.14662,79,500,79,267.48814,267.48812,79,500,79S921,267.48814,921,500c0,232.44513-188.37991,420.89177-420.79975,421" transform="translate(-78.5 -78.50002)"/>
            </defs>
            <?php if($topCircleText): ?>
                <text text-anchor="middle">
                    <textPath xlink:href="#top-path" startOffset="50%" dominant-baseline="hanging"><?php echo $topCircleText; ?></textPath>
                </text>
            <?php endif; ?>
            <?php if($bottomCircleText): ?>
                <text text-anchor="middle">
                    <textPath xlink:href="#bottom-path" startOffset="50%" dominant-baseline="auto"><?php echo $bottomCircleText; ?></textPath>
                </text>
            <?php endif; ?>
            </svg>
        </div>
    </div>
</section>