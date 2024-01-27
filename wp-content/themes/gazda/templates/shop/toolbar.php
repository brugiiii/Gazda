<div class="products-toolbar bg-white rounded-3 py-3">
    <div class="toolbar-wrapper d-flex align-items-center justify-content-between">
        <h2 class="toolbar-wrapper__title fw-semibold text-uppercase mb-0">
            <?= translate_and_output('all_products'); ?>
        </h2>
        <div class="toolbar-els d-flex gap-3">
            <div class="position-relative toolbar-filter d-none">
                <button class="toolbar-els__button filter-button d-flex align-items-center gap-2" type="button">
                    <?= translate_and_output('filter'); ?>
                    <svg width="24" height="24">
                        <use href="<?php get_image('sprite.svg#icon-more'); ?>"></use>
                    </svg>
                </button>
                <div class="filter-container is-hidden position-absolute end-0 z-1 rounded-4 overflow-hidden"></div>
            </div>
            <div class="position-relative">
                <button class="toolbar-els__button order-button d-flex align-items-center gap-2"
                        type="button">
                    <span class="order-button__text">
                        <?= translate_and_output('high_to_low'); ?>
                    </span>
                    <svg width="24" height="24">
                        <use href="<?php get_image('sprite.svg#icon-sort'); ?>"></use>
                    </svg>
                </button>
                <div class="order-list is-hidden position-absolute end-0 z-1 rounded-4 overflow-hidden">
                    <button class="order-list__button border-0" type="button"
                            data-order="ASC">
                        <?= translate_and_output('low_to_high'); ?>
                    </button>
                    <button class="order-list__button is-active border-0" type="button" data-order="DESC">
                        <?= translate_and_output('high_to_low'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>