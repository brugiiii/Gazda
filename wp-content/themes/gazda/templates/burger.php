<?php
$is_logged_in = is_user_logged_in();
?>

<div class="burger position-absolute top-100 start-0 w-100">
    <div class="burger-wrapper">
        <label class="burger-search position-relative d-block d-sm-none">
            <svg class="search-icon position-absolute top-50 translate-middle-y" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon-search'); ?>"></use>
            </svg>
            <input class="search-input" type="search" placeholder="<?= translate_and_output('search'); ?>">
        </label>

        <?php get_template_part('templates/navigation', null, array('location' => 'menu-burger-mobile')); ?>
        <?php get_template_part('templates/navigation', null, array('location' => 'menu-burger-desktop')); ?>

        <?= $is_logged_in ? '<a href="' . get_permalink(pll_get_post(6840, pll_current_language())) . '" class="burger-signin d-flex align-items-center justify-content-center gap-2 mx-auto d-sm-none">' : '<button type="button" class="burger-signin d-flex align-items-center justify-content-center gap-2 mx-auto d-sm-none bg-transparent auth-button-js">'; ?>
        <?= translate_and_output('sign_in'); ?>
        <svg class="burger-signin__icon" width="24" height="24">
            <use href="<?php get_image('sprite.svg#icon-user'); ?>"></use>
        </svg>
        <?= $is_logged_in ? '</a>' : '</button>'; ?>
    </div>
</div>