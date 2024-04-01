<?php
$page = is_page_template('pages/delivery.php') ? 'delivery' : 'shop';
?>

<div class="backdrop is-hidden" id="categories-menu">
    <div class="menu p-3">
        <div class="menu-header d-flex align-items-start justify-content-between">
            <h2 class="menu-title text-uppercase m-0 p-0 text-uppercase fw-semibold">
                <?= translate_and_output('categories'); ?>
            </h2>
            <button type="button" class="menu-button p-0 bg-transparent border-0">
                <svg class="menu-button__icon" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-close'); ?>"></use>
                </svg>
            </button>
        </div>
        <div class="nav-wrapper accordion mob">
            <?= get_template_part('templates/shop/navigation', null, array('page' => $page)); ?>
        </div>
    </div>
</div>