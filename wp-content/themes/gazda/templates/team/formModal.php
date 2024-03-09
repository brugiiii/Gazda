<div class="backdrop is-hidden d-flex align-items-center" id="form-modal">
    <div class="form-modal w-100 mx-auto overflow-auto position-relative">
        <div class="form-modal__wrapper position-absolute top-0 end-0 h-100">
            <button class="form-modal__close position-sticky border-0 bg-transparent" type="button">
                <svg class="form-modal__icon" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-close'); ?>"></use>
                </svg>
            </button>
        </div>
        <h2 class="form-modal__title fw-semibold text-uppercase text-center"></h2>
        <p class="form-modal__text text-uppercase text-center text-white">
            <?= the_field('cta_title', 6955); ?>
        </p>
        <?= get_template_part('templates/team/ctaForm', null, array('is_modal' => true)); ?>
    </div>
</div>