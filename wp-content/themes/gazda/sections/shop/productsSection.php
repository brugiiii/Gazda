<?php
$current_lang = pll_current_language();
$home_page = pll_get_post(16, $current_lang);
?>

<section class="section">
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
            <span class="current"></span>
        </div>
        <div class="products-wrapper d-lg-flex">
            <div class="nav-wrapper bg-white flex-shrink-0 rounded-3 p-3">
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
                                <button class="toolbar-els__button d-flex align-items-center gap-2" type="button">
                                    <?= translate_and_output('low_to_high'); ?>
                                    <svg class="" width="24" height="24">
                                        <use href="<?php get_image('sprite.svg#icon-sort'); ?>"></use>
                                    </svg>
                                </button>
                                <div class="position-absolute">

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
