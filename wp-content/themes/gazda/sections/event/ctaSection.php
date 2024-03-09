<?php
$form_fields = get_field('form_fields');
$select_options = get_field('select_options');
$required_fields = get_field('required_fields');

$currentDateTime = new DateTime('+2 hour');
$currentDateTime->setTime(8, 0);

$minDateTime = clone $currentDateTime;
$minDateTime = $minDateTime->modify('+1 day')->format('Y-m-d\TH:i');

$maxDateTime = clone $currentDateTime;
$maxDateTime = $maxDateTime->modify('+1 year')->format('Y-m-d\TH:i');
?>

<section class="cta" id="cta">
    <div class="container">
        <h2 class="cta-title title py-2 text-center ">
            <?= the_field('cta_title'); ?>
        </h2>
        <div class="form-wrapper mx-auto">
            <?php
            if ($form_fields) {
                ?>
                <form id="cta-form" class="cta-form d-flex flex-column mb-3"
                      action="<?= admin_url('admin-ajax.php'); ?>"
                      method="post">
                    <?php
                    if (in_array('select', $form_fields)) {
                        ?>
                        <label class="cta-form__field position-relative d-flex flex-column">
                        <span class="cta-form__title form-title mb-1 d-flex ">
                            <?= the_field('select_title'); ?>
                        </span>
                            <button class="cta-form__input d-flex align-items-center justify-content-between py-2 bg-white border-0 text-start select-button-js"
                                    type="button" <?= in_array('select', $required_fields) ? 'required' : ''; ?>>
                                <span class="cta-form__item">
                                    <?= $select_options[0]; ?>
                                </span>
                                <svg class="cta-form___icon" width="24" height="24">
                                    <use href="<?php get_image('sprite.svg#icon-caret-down'); ?>"></use>
                                </svg>
                            </button>
                            <input hidden type="text" name="event" value="<?= $select_options[0]; ?>"/>
                            <ul class="options-list position-absolute start-0 w-100 overflow-hidden is-hidden">
                                <?php foreach ($select_options as $option): ?>
                                    <li class="options-list__item">
                                        <button type="button"
                                                class="options-list__button d-block w-100 px-3 text-start border-0 <?= $select_options[0] === $option ? 'is-active' : ''; ?>">
                                            <?= $option; ?>
                                        </button>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </label>
                        <?php
                    }
                    if (in_array('company_name', $form_fields)) {
                        ?>
                        <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title form-title mb-1 d-flex ">
                            <?= translate_and_output('company_name'); ?>
                        </span>
                            <input class="cta-form__input border-0" type="text"
                                   name="company_name"
                                   placeholder="<?= translate_and_output('write_company_name'); ?>" <?= in_array('company_name', $required_fields) ? 'required' : ''; ?>>
                        </label>
                        <?php
                    }
                    if (in_array('name', $form_fields)) {
                        ?>
                        <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title form-title mb-1 d-flex ">
                            <?= translate_and_output('name'); ?>
                        </span>
                            <input class="cta-form__input border-0" name="name" type="text"
                                   placeholder="<?= translate_and_output('write_your_name'); ?>" <?= in_array('name', $required_fields) ? 'required' : ''; ?>>
                        </label>
                        <?php
                    }
                    if (in_array('phone', $form_fields)) {
                        ?>
                        <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title form-title mb-1 d-flex ">
                            <?= translate_and_output('number'); ?>
                        </span>
                            <input class="cta-form__input border-0" id="phone" name="phone" type="tel" inputmode="tel"
                                   placeholder="+380 (XX) XXX XX XX" <?= in_array('phone', $required_fields) ? 'required' : ''; ?>>
                        </label>
                        <?php
                    }
                    if (in_array('email', $form_fields)) {
                        ?>
                        <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title form-title mb-1 d-flex ">
                            Email
                        </span>
                            <input class="cta-form__input border-0" name="email" type="email" inputmode="email"
                                   placeholder="<?= translate_and_output('write_your_mail'); ?>" <?= in_array('email', $required_fields) ? 'required' : ''; ?>>
                        </label>
                        <?php
                    }
                    if (in_array('date_and_time', $form_fields)) {
                        ?>
                        <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title form-title mb-1 d-flex ">
                            <?= translate_and_output('date_and_time'); ?>
                        </span>
                            <input class="cta-form__input border-0" name="date" type="datetime-local"
                                   placeholder="<?= translate_and_output('write_date_and_time'); ?>" <?= in_array('date_and_time', $required_fields) ? 'required' : ''; ?>
                                   min="<?= $minDateTime; ?>" max="<?= $maxDateTime; ?>">
                        </label>
                        <?php
                    }
                    if (in_array('number_of_guests', $form_fields)) {
                        ?>
                        <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title form-title mb-1 d-flex ">
                            <?= translate_and_output('guests_count'); ?>
                        </span>
                            <input class="cta-form__input border-0" name="quests_count" type="number"
                                   placeholder="<?= translate_and_output('write_quests_count'); ?>" min="1" max="150"
                                <?= in_array('number_of_guests', $required_fields) ? 'required' : ''; ?>>
                        </label>
                        <?php
                    }
                    if (in_array('message', $form_fields)) {
                        ?>
                        <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title form-title mb-1 d-flex ">
                            <?= translate_and_output('message'); ?>
                        </span>
                            <textarea class="cta-form__input cta-form__textarea border-0" name="message"
                                      placeholder="<?= translate_and_output('write_your_message'); ?>" <?= in_array('message', $required_fields) ? 'required' : ''; ?>></textarea>
                        </label>
                        <?php
                    }
                    ?>
                    <button class="cta-form__button button-primary text-white border-0 w-100" type="submit">
                        <?= translate_and_output('send'); ?>
                    </button>
                </form>
                <p class="form-wrapper__text text-center">
                    <?= translate_and_output('legal'); ?>
                </p>
                <?php
            }
            ?>
        </div>
    </div>
</section>