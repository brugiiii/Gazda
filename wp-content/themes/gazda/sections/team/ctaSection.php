<?php
$text = get_field('cta_text');
?>

<section class="section" id="cta">
    <div class="container">
        <div class="cta-wrapper mx-auto">
            <h2 class="cta-title text-center text-white text-uppercase">
                <?= the_field('cta_title'); ?>
            </h2>
            <?php
            if ($text) {
                ?>
                <p class="cta-text text-center text-white">
                    <?= the_field('cta_text'); ?>
                </p>
                <?php
            }
            get_template_part('templates/ctaForm');
            ?>
        </div>
    </div>
</section>