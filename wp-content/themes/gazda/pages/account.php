<?php
/*
Template Name: Account
*/
?>

<?php get_header(); ?>

<main id="account">
    <h1 class="visually-hidden">
        <?php the_title(); ?>
    </h1>

    <?= get_template_part('templates/breadcrumbs'); ?>

    <div class="container">
        <?= get_template_part('templates/breadcrumbs'); ?>
        <div class="account-wrapper d-flex flex-column flex-lg-row">
            <?= get_template_part('sections/account/aside'); ?>
            <section class="section bg-white rounded-3 px-3 pt-3 flex-grow-1">
                <?php
                get_template_part('sections/account/personalData');
                get_template_part('sections/account/changePassword');
                get_template_part('sections/account/ordersHistory');
                get_template_part('sections/account/deliveryAddresses');
                ?>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
