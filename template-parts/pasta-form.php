<section class="section section--pasta-form section--bottom-b">
    <div class="block block--pasta-form">
        <div class="pasta-form">
        <?php if(get_field('pasta_form_title')): ?>
            <h2 class="intro__title title"><?php echo get_field('pasta_form_title'); ?></h2>
        <?php endif; ?>
        <?php echo do_shortcode( '[contact-form-7 id="a0ff853" title="New Pasta Form"]' ); ?>
        </div>
    </div>
</section>