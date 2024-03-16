<div class="section__item" data-content="change-password">
    <h2 class="text-uppercase mb-3">
        <?= translate_and_output('change_password'); ?>
    </h2>

    <form class="password-form d-flex flex-column">
        <label class="form-field position-relative d-flex flex-column">
            <span class="form-title mb-1">
                <?= translate_and_output('old_password'); ?>
            </span>
            <button type="button" class="form-field__button position-absolute bottom-0 end-0 border-0 bg-transparent">
                <svg class="form-field__icon show" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-eye'); ?>"></use>
                </svg>
                <svg class="form-field__icon hide" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-eye-blocked'); ?>"></use>
                </svg>
            </button>
            <input class=" border-0" name="old-password" type="password"
                   placeholder="<?= translate_and_output('write_old_password'); ?>" required min="6">
        </label>

        <label class="form-field position-relative d-flex flex-column">
            <span class="form-title mb-1">
                <?= translate_and_output('new_password'); ?>
            </span>
            <button type="button" class="form-field__button position-absolute bottom-0 end-0 border-0 bg-transparent">
                <svg class="form-field__icon show" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-eye'); ?>"></use>
                </svg>
                <svg class="form-field__icon hide" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-eye-blocked'); ?>"></use>
                </svg>
            </button>
            <input class=" border-0" name="new-password" type="password"
                   placeholder="<?= translate_and_output('write_new_password'); ?>" required min="6">
        </label>

        <label class="form-field position-relative d-flex flex-column">
            <span class="form-title mb-1">
                <?= translate_and_output('repeat_new_password'); ?>
            </span>
            <button type="button" class="form-field__button position-absolute bottom-0 end-0 border-0 bg-transparent">
                <svg class="form-field__icon show" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-eye'); ?>"></use>
                </svg>
                <svg class="form-field__icon hide" width="24" height="24">
                    <use href="<?php get_image('sprite.svg#icon-eye-blocked'); ?>"></use>
                </svg>
            </button>
            <input class=" border-0" name="repeat-new-password" type="password"
                   placeholder="<?= translate_and_output('write_new_password'); ?>" required min="6">
        </label>

        <button type="submit" class="button-primary position-relative border-0 fs-6  button-loading">
            <span class="d-inline-block">
                <?= translate_and_output('save_changes'); ?>
            </span>
            <?= get_template_part('templates/loader'); ?>
        </button>

    </form>
</div>
