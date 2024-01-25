<?php
$current_lang = pll_current_language();
$home_page = pll_get_post(16, $current_lang);
?>

<section class="section products position-relative">
    <h1 class="visually-hidden">
        <?php woocommerce_page_title(); ?>
    </h1>
    <div class="container">
        <div class="breadcrumb">
            <a href="<?= get_permalink($home_page); ?>">
                <?= get_the_title($home_page); ?>
            </a>
            <?= get_template_part('helpers/separator'); ?>
            <span>
                <?= is_shop() ? woocommerce_page_title() : get_the_title(6357); ?>
            </span>
            <?= get_template_part('helpers/separator'); ?>
            <span class="current">
                <?= translate_and_output('all_products'); ?>
            </span>
        </div>
        <div class="products-wrapper d-lg-flex">
            <div class="nav-wrapper align-self-start bg-white flex-shrink-0 rounded-3 p-3">
                <h2 class="nav-wrapper__title text-uppercase fw-semibold">
                    <?= translate_and_output('categories'); ?>
                </h2>
                <?= get_template_part('templates/shop/navigation'); ?>
            </div>
            <div class="flex-grow-1">
                <div class="products-toolbar bg-white rounded-3 py-3">
                    <div class="toolbar-wrapper d-flex align-items-center justify-content-between">
                        <h2 class="toolbar-wrapper__title fw-semibold text-uppercase mb-0">
                            <?= translate_and_output('all_products'); ?>
                        </h2>
                        <div class="toolbar-els d-flex gap-3">
                            <div class="position-relative">
                                <button class="toolbar-els__button d-flex align-items-center gap-2" type="button">
                                    <?= translate_and_output('filter'); ?>
                                    <svg class="" width="24" height="24">
                                        <use href="<?php get_image('sprite.svg#icon-more'); ?>"></use>
                                    </svg>
                                </button>
                                <div class="position-absolute start-0">

                                </div>
                            </div>
                            <div class="position-relative">
                                <button class="toolbar-els__button order-button d-flex align-items-center gap-2" type="button">
                                    <span class="order-button__text">
                                        <?= translate_and_output('low_to_high'); ?>
                                    </span>
                                    <svg class="" width="24" height="24">
                                        <use href="<?php get_image('sprite.svg#icon-sort'); ?>"></use>
                                    </svg>
                                </button>
                                <div class="order-list is-hidden overflow-hidden rounded-4 position-absolute z-1">
                                    <button class="order-list__button is-active border-0" type="button" data-order="ASC">
                                        <?= translate_and_output('low_to_high'); ?>
                                    </button>
                                    <button class="order-list__button border-0" type="button" data-order="DESC">
                                        <?= translate_and_output('high_to_low'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="products-items"></div>
            </div>
        </div>
    </div>
</section>
