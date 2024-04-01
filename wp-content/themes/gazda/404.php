<?php get_header(); ?>

<main id="error">
    <section class="section">
        <div class="container text-center">
            <div class="thumb mx-auto"></div>
            <p class="error-text">
                <?= translate_and_output('not_found'); ?>
            </p>
            <a class="error-link button-primary d-inline-block" href="<?= pll_home_url(); ?>">
                <?= translate_and_output('to_main'); ?>
            </a>
        </div>
    </section>
</main>

<?php get_footer(); ?>

