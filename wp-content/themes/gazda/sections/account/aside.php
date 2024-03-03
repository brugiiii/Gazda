<aside class="aside d-flex flex-column bg-white rounded-3 p-3 flex-shrink-0">
    <h2 class="aside__title text-uppercase">
        <?= translate_and_output('personal_office'); ?>
    </h2>
    <ul class="nav-list mb-auto">
        <li class="nav-list__item">
            <button class="nav-list__button w-100 d-flex align-items-center gap-2 border-0 bg-transparent text-start p-0 is-active" data-content="personal-data">
                <svg class="nav-list__icon" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-user'); ?>"></use>
                </svg>
                <?= translate_and_output('personal_data'); ?>
            </button>
        </li>
        <li class="nav-list__item">
            <button class="nav-list__button w-100 d-flex align-items-center gap-2 border-0 bg-transparent text-start p-0" data-content="change-password">
                <svg class="nav-list__icon" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon_lock'); ?>"></use>
                </svg>
                <?= translate_and_output('change_password'); ?>
            </button>
        </li>
        <li class="nav-list__item">
            <button class="nav-list__button w-100 d-flex align-items-center gap-2 border-0 bg-transparent text-start p-0" data-content="orders-history">
                <svg class="nav-list__icon" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-shopping-cart'); ?>"></use>
                </svg>
                <?= translate_and_output('orders_history'); ?>
            </button>
        </li>
        <li class="nav-list__item">
            <button class="nav-list__button w-100 d-flex align-items-center gap-2 border-0 bg-transparent text-start p-0" data-content="delivery-addresses">
                <svg class="nav-list__icon" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon_location'); ?>"></use>
                </svg>
                <?= translate_and_output('delivery_addresses'); ?>
            </button>
        </li>
    </ul>
    <a href="<?php echo wp_logout_url(pll_home_url()); ?>" class="aside__link d-flex align-items-center gap-2">
        <svg class="nav-list__icon" width="24" height="24">
            <use href="<?php get_image('sprite.svg#icon-user'); ?>"></use>
        </svg>
        <?= translate_and_output('exit'); ?>
    </a>
</aside>