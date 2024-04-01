<ul class="features-list d-flex bg-white rounded-4 p-3">
    <li class="features-list__item d-flex flex-column flex-md-row align-items-md-center">
        <svg class="features-list__icon flex-shrink-0" width="32" height="32">
            <use href="<?php get_image('sprite.svg#icon-bag'); ?>"></use>
        </svg>
        <span class="features-list__text">
            <?= translate_and_output('features_bag_text'); ?>
        </span>
    </li>
    <li class="features-list__item d-flex flex-column flex-md-row align-items-md-center">
        <svg class="features-list__icon flex-shrink-0" width="32" height="32">
            <use href="<?php get_image('sprite.svg#icon-camera'); ?>"></use>
        </svg>
        <span class="features-list__text">
            <?= translate_and_output('features_camera_text'); ?>
        </span>
    </li>
    <li class="features-list__item d-flex flex-column flex-md-row align-items-md-center">
        <svg class="features-list__icon flex-shrink-0" width="32" height="32">
            <use href="<?php get_image('sprite.svg#icon-truck'); ?>"></use>
        </svg>
        <span class="features-list__text">
            <?= translate_and_output('features_truck_text'); ?>
        </span>
    </li>
</ul>