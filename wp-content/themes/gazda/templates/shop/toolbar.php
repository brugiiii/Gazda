<?php
$page = $args['page'] ?? 'shop';
?>

<div class="products-toolbar py-lg-3">
    <div class="toolbar-wrapper d-md-flex align-items-md-center justify-content-md-between">
        <h2 class="toolbar-wrapper__title mb-md-0"></h2>
        <div class="toolbar-els d-flex">
            <div class="position-relative toolbar-filter d-none">
                <button class="toolbar-els__button filter-button d-flex align-items-center" type="button">
                    <?= translate_and_output('filter'); ?>
                    <svg width="24" height="24">
                        <use href="<?php get_image('sprite.svg#icon-more'); ?>"></use>
                    </svg>
                </button>
                <div class="filter-container is-hidden position-absolute end-0 z-1 rounded-4 overflow-hidden"></div>
                <div class="select-container"></div>
            </div>
            <div class="position-relative">
                <button class="toolbar-els__button order-button d-flex align-items-center d-none d-lg-block"
                        type="button">
                    <span class="order-button__text">
                        <?= translate_and_output('high_to_low'); ?>
                    </span>
                    <svg width="24" height="24">
                        <use href="<?php get_image('sprite.svg#icon-sort'); ?>"></use>
                    </svg>
                </button>
                <div class="order-list is-hidden position-absolute end-0 z-1 rounded-4 overflow-hidden d-none d-lg-block">
                    <button class="order-list__button border-0" type="button"
                            data-order="ASC">
                        <?= translate_and_output('low_to_high'); ?>
                    </button>
                    <button class="order-list__button is-active border-0" type="button" data-order="DESC">
                        <?= translate_and_output('high_to_low'); ?>
                    </button>
                </div>
                <select class="toolbar-els__button d-flex align-items-center d-lg-none">
                    <option value="DESC">
                        <?= translate_and_output('high_to_low'); ?>
                    </option>
                    <option value="ASC">
                        <?= translate_and_output('low_to_high'); ?>
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class="current-filter d-flex gap-2 flex-wrap"></div>
</div>

<?php
if ($page === 'shop') {
    ?>
    <div class="nav-wrapper d-flex d-lg-none">
        <button type="button" class="categories-button p-2 border-0 rounded-3">
            <svg class="categories-button__icon" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon-category'); ?>"></use>
            </svg>
        </button>
        <?= get_template_part('templates/shop/navigation', null, array('is_swiper' => true)); ?>
    </div>
    <?php
} else {
    ?>
    <div class="nav-wrapper px-0 d-lg-none">
        <?= get_template_part('templates/shop/navigation', null, array('is_swiper' => true, 'page' => $page)); ?>
    </div>
    <?php
}
?>

