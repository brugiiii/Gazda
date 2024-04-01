<?php
$current_user = wp_get_current_user();

$current_wc_user = new WC_Customer($current_user->ID);

$name = $current_wc_user->get_first_name();
$surname = $current_wc_user->get_last_name();
$email = $current_wc_user->get_email();
$phone = $current_wc_user->get_billing_phone();
?>

<div class="section__item" data-content="personal-data">
    <h2 class="text-uppercase mb-3">
        <?= translate_and_output('personal_data'); ?>
    </h2>

    <form class="personal-form d-flex flex-column">
        <label class=" form-field d-flex flex-column">
            <span class="form-title mb-1">
                <?= translate_and_output('name'); ?>
            </span>
            <input class=" border-0" name="name" type="text"
                   value="<?= isset($name) ? esc_html($name) : ''; ?>"
                   placeholder="<?= translate_and_output('write_your_name'); ?>" required>
        </label>

        <label class=" form-field d-flex flex-column">
            <span class="form-title mb-1">
                <?= translate_and_output('surname'); ?>
            </span>
            <input class=" border-0" name="surname" type="text"
                   value="<?= isset($surname) ? esc_html($surname) : ''; ?>"
                   placeholder="<?= translate_and_output('write_your_surname'); ?>">
        </label>

        <label class=" form-field d-flex flex-column">
            <span class="form-title mb-1">
                Email
            </span>
            <input class=" border-0" name="email" type="email" inputmode="email"
                   value="<?= isset($email) ? esc_html($email) : ''; ?>"
                   placeholder="<?= translate_and_output('write_your_mail'); ?>" required>
        </label>

        <label class=" form-field d-flex flex-column">
            <span class="form-title mb-1">
                <?= translate_and_output('number'); ?>
            </span>
            <input class=" border-0" id="phone" name="phone" type="tel" inputmode="tel"
                   value="<?= isset($phone) ? esc_html($phone) : ''; ?>"
                   placeholder="+380 (XX) XXX XX XX">
        </label>

        <button type="submit" class="button-primary position-relative border-0 fs-6 button-loading">
            <span class="d-inline-block">
                <?= translate_and_output('save_changes'); ?>
            </span>
            <?= get_template_part('templates/loader'); ?>
        </button>

    </form>
</div>
