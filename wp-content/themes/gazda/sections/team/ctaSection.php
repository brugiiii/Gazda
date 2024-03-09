<section class="section" id="cta">
    <div class="container">
        <div class="cta-wrapper mx-auto">
            <h2 class="cta-title text-center text-white text-uppercase">
                <?= the_field('cta_title'); ?>
            </h2>
            <p class="cta-text text-center text-white">
                <?= the_field('cta_text'); ?>
            </p>
            <?= get_template_part('templates/team/ctaForm'); ?>
        </div>
    </div>
</section>