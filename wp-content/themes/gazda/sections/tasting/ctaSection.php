<?php
$form = get_field('form');

$currentDateTime = new DateTime('+2 hour');
$currentDateTime->setTime(8, 0);

$minDateTime = clone $currentDateTime;
$minDateTime = $minDateTime->modify('+1 day')->format('Y-m-d\TH:i');

$maxDateTime = clone $currentDateTime;
$maxDateTime = $maxDateTime->modify('+1 year')->format('Y-m-d\TH:i');
?>

<section class="cta" id="cta">
    <div class="container">
        <h2 class="cta-title title py-2 text-center">
            <?= the_field('cta_title'); ?>
        </h2>
        <div class="form-wrapper mx-auto">
            <?php
            if ($form === 'tasting') {
                ?>
                <form id="cta-form" class="cta-form d-flex flex-column"
                      action="<?= admin_url('admin-ajax.php'); ?>"
                      method="post">
                    <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title mb-1 d-flex ">
                            <?= translate_and_output('company_name'); ?>
                        </span>
                        <input class="cta-form__input border-0" type="text"
                               placeholder="<?= translate_and_output('write_company_name'); ?>">
                    </label>
                    <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title mb-1 d-flex ">
                            <?= translate_and_output('name'); ?>
                        </span>
                        <input class="cta-form__input border-0" name="name" type="text"
                               placeholder="<?= translate_and_output('write_your_name'); ?>" required>
                    </label>
                    <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title mb-1 d-flex ">
                            <?= translate_and_output('number'); ?>
                        </span>
                        <input class="cta-form__input border-0" id="phone" name="number" type="tel" inputmode="tel"
                               placeholder="+380 (___) ___ __ __" required>
                    </label>
                    <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title mb-1 d-flex ">
                            Email
                        </span>
                        <input class="cta-form__input border-0" name="email" type="email" inputmode="email"
                               placeholder="<?= translate_and_output('write_your_mail'); ?>">
                    </label>
                    <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title mb-1 d-flex ">
                            <?= translate_and_output('date_and_time'); ?>
                        </span>
                        <input class="cta-form__input border-0" name="date" type="datetime-local"
                               placeholder="<?= translate_and_output('write_date_and_time'); ?>" required
                               min="<?= $minDateTime; ?>" max="<?= $maxDateTime; ?>">
                    </label>
                    <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title mb-1 d-flex ">
                            <?= translate_and_output('guests_count'); ?>
                        </span>
                        <input class="cta-form__input border-0" name="quests_count" type="number"
                               placeholder="<?= translate_and_output('write_quests_count'); ?>" min="1" max="150"
                               required>
                    </label>
                    <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title mb-1 d-flex ">
                            <?= translate_and_output('message'); ?>
                        </span>
                        <textarea class="cta-form__textarea border-0" name="message"
                                  placeholder="<?= translate_and_output('write_your_message'); ?>"></textarea>
                    </label>
                    <button class="cta-form__button button-primary text-white border-0 w-100" type="submit">
                        <?= translate_and_output('send'); ?>
                    </button>
                </form>
                <?php
            } else {
                ?>
                <form id="cta-form" class="cta-form d-flex flex-column mx-auto"
                      action="<?= admin_url('admin-ajax.php'); ?>"
                      method="post">
                    <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title mb-1 d-flex">
                            <?= translate_and_output('choose_event'); ?>
                        </span>
                        <select class="cta-form__input border-0" required>
                            <option value="qwe">Подія 1</option>
                            <option value="qwe">Подія 2</option>
                            <option value="qwe">Подія 3</option>
                            <option value="qwe">Подія 4</option>
                        </select>
                    </label>
                    <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title mb-1 d-flex">
                            <?= translate_and_output('name'); ?>
                        </span>
                        <input class="cta-form__input border-0" name="name" type="text"
                               placeholder="<?= translate_and_output('write_your_name'); ?>" required>
                    </label>
                    <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title mb-1 d-flex">
                            <?= translate_and_output('number'); ?>
                        </span>
                        <input class="cta-form__input border-0" id="phone" name="number" type="tel" inputmode="tel"
                               placeholder="+380 (___) ___ __ __" required>
                    </label>
                    <label class="cta-form__field d-flex flex-column">
                        <span class="cta-form__title mb-1 d-flex ">
                            Email
                        </span>
                        <input class="cta-form__input border-0" name="email" type="email" inputmode="email"
                               placeholder="<?= translate_and_output('write_your_mail'); ?>">
                    </label>
                    <button class="cta-form__button button-primary text-white border-0 w-100" type="submit">
                        <?= translate_and_output('send'); ?>
                    </button>
                </form>
                <?php
            }
            ?>
        </div>
    </div>
</section>