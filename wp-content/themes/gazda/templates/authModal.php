<?php
$post = pll_get_post(16, pll_current_language())
?>

<div class="backdrop is-hidden" id="auth">
    <div class="auth d-flex position-absolute top-50 start-50 translate-middle bg-white rounded-4 login-form">
        <div class="login w-100 flex-shrink-0">
            <h2 class="auth-title text-center">
                <?= the_field('login_title', $post); ?>
            </h2>
            <p class="auth-undertitle text-center">
                <?= the_field('login_undertitle', $post); ?>
            </p>
            <form class="auth-form d-flex flex-column" id="login-form">
                <label class="auth-form__field d-flex flex-column">
                    <span class="form-title auth-form__title mb-1">
                        <?= translate_and_output('login_or_email'); ?>
                    </span>
                    <input class="auth-form__input border-0" type="text" name="login_or_email" autocomplete="username"
                           placeholder="<?= translate_and_output('write_login_or_email'); ?>" required>
                </label>
                <label class="auth-form__field d-flex flex-column">
                    <span class="form-title auth-form__title mb-1">
                        <?= translate_and_output('password'); ?>
                    </span>
                    <input class="auth-form__input border-0" type="password" name="password"
                           autocomplete="current-password" placeholder="<?= translate_and_output('write_your_password'); ?>" required>
                </label>
                <button class="auth-form__button button-primary position-relative border-0 fs-6" type="submit">
                    <span class="d-inline-block">
                        <?= translate_and_output('sign_in_to_account'); ?>
                    </span>
                    <div class="loader-container position-absolute top-50 start-50 translate-middle">
                        <div class="loader">
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                        </div>
                    </div>
                </button>
            </form>
            <p class="register-text text-center mb-0">
                <?= translate_and_output('still_not_registered'); ?>
                <button type="button" class="border-0 p-0 bg-transparent form-switcher">
                    <?= translate_and_output('create_account'); ?>
                </button>
            </p>
        </div>
        <div class="register w-100 flex-shrink-0">
            <h2 class="auth-title text-center">
                <?= the_field('registration_title', $post); ?>
            </h2>
            <form class="auth-form d-flex flex-column" id="register-form">
                <label class="auth-form__field d-flex flex-column">
                    <span class="form-title auth-form__title mb-1">
                        <?= translate_and_output('login'); ?>
                    </span>
                    <input class="auth-form__input border-0" type="text" name="login"
                           placeholder="<?= translate_and_output('write_your_login'); ?>" required>
                </label>
                <label class="auth-form__field d-flex flex-column">
                    <span class="form-title auth-form__title mb-1">
                        Email
                    </span>
                    <input class="auth-form__input border-0" type="email" name="email" inputmode="email"
                           autocomplete="username" placeholder="<?= translate_and_output('write_your_email'); ?>"
                           required>
                </label>
                <label class="auth-form__field d-flex flex-column">
                    <span class="form-title auth-form__title mb-1">
                        <?= translate_and_output('password'); ?>
                    </span>
                    <input class="auth-form__input border-0" type="password" name="password"
                           autocomplete="current-password"
                           placeholder="<?= translate_and_output('write_your_password'); ?>" required>
                </label>
                <p class="auth-terms text-center">
                    <?= the_field('registration_terms', $post); ?>
                </p>
                <button class="auth-form__button button-primary position-relative border-0 fs-6" type="submit">
                    <span class="d-inline-block">
                        <?= translate_and_output('create_account'); ?>
                    </span>
                    <div class="loader-container position-absolute top-50 start-50 translate-middle">
                        <div class="loader">
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                        </div>
                    </div>
                </button>
            </form>
            <p class="register-text text-center mb-0">
                <?= translate_and_output('already_registered'); ?>
                <button type="button" class="border-0 p-0 bg-transparent form-switcher">
                    <?= translate_and_output('sign_in'); ?>
                </button>
            </p>
        </div>
    </div>
</div>