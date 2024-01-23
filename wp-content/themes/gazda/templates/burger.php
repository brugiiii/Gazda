<div class="burger position-absolute top-100 start-0 w-100 z-2">
    <div class="burger-wrapper">

        <label class="burger-search position-relative">
            <svg class="burger-search__icon position-absolute top-50 translate-middle-y" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon-search'); ?>"></use>
            </svg>
            <input type="search" placeholder="Пошук">
        </label>

        <?php get_template_part('templates/navigation', null, array('location' => 'menu-burger')); ?>

        <a href="" class="burger-signin d-flex align-items-center justify-content-center gap-2 mx-auto d-md-none">
            <?php translate_and_output('signin'); ?>
            <svg class="burger-signin__icon" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon-user'); ?>"></use>
            </svg>
        </a>
    </div>
</div>