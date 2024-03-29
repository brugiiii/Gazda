<?php
/*
Template Name: Search
*/
?>

<?php get_header(); ?>

<main id="search">
    <section class="section tools overflow-x-visible">
        <div class="container">
            <?= get_template_part('templates/search/breadcrumbs'); ?>
            <?= get_template_part('templates/shop/toolbar', null, array('page' => 'search')); ?>
        </div>
        <div class="container">
            <div class="products-items">
                <ul class="products-list flex-wrap"></ul>
                <div class="pagination-container"></div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
