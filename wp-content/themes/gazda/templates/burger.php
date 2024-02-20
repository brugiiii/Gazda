<div class="burger position-absolute top-100 start-0 w-100 z-2">
    <div class="burger-wrapper">

        <label class="burger-search position-relative d-block d-sm-none">
            <svg class="search-icon position-absolute top-50 translate-middle-y" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon-search'); ?>"></use>
            </svg>
            <input class="search-input" type="search" placeholder="<?= translate_and_output('search'); ?>">
        </label>

        <?php get_template_part('templates/navigation', null, array('location' => 'menu-burger')); ?>

        <a href="" class="burger-signin d-flex align-items-center justify-content-center gap-2 mx-auto d-sm-none">
            <?php translate_and_output('signin'); ?>
            <svg class="burger-signin__icon" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon-user'); ?>"></use>
            </svg>
        </a>
    </div>
</div>