<?php
$is_team_page = is_page_template("pages/team.php");
$is_modal = $args['is_modal'] ?? false;

$fields = $is_modal ? get_field('vacancies_fields') : get_field('fields');
$message_title = get_field('message_title');

if ($fields) {
    ?>
    <div class="form-wrapper mx-auto">
        <form id="cta-form-<?= get_the_ID(); ?>" class="cta-form text-center mb-3 form-js"
              data-title="<?= $is_modal ? "" : $message_title; ?>">
            <?php

            foreach ($fields as $field) {
                $type = $field['type'];
                $options = $field['options'];
                $is_required = $field['is_required'];
                $title = $field['title'];
                $transliteratedText = transliterator_transliterate('Any-Latin; Latin-ASCII', $title);
                $is_select = $type === 'select';
                $min_date = $field['min_date'];
                $max_date = $field['max_date'];
                $min_number = $field['min_number'];
                $max_number = $field['max_number'];
                $is_placeholder_shown = $type !== "date";
                $placeholder = $type === "tel" ? "+380 (ХХ) ХХХ ХХ ХХ" : $field['placeholder'];
                ?>
                <label class="cta-form__field position-relative d-flex flex-column">
                    <span class="cta-form__title form-title mb-1 d-flex">
                        <?= $title; ?>
                    </span>
                    <?php
                    if ($is_select) {
                        ?>
                        <input class="cta-form__input border-0 <?= $is_select ? "select" : ""; ?>" type="text"
                               name="<?= str_replace(' ', '_', $transliteratedText);; ?>"
                               value="<?= $options[0]; ?>"
                               data-title="<?= $field['message_title']; ?>"
                               readonly
                            <?= $is_required ? 'required' : '' ?>
                        >
                        <svg class="position-absolute cta-form___icon" width="24" height="24">
                            <use href="<?php get_image('sprite.svg#icon-caret-down'); ?>"></use>
                        </svg>
                        <ul class="options-list position-absolute start-0 w-100 overflow-hidden is-hidden z-1">
                            <?php foreach ($options as $option): ?>
                                <li class="options-list__item">
                                    <button type="button"
                                            class="options-list__button d-block w-100 px-3 text-start border-0 <?= $options[0] === $option ? 'is-active' : ''; ?>">
                                        <?= $option; ?>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php
                    } elseif ($type === "textarea") {
                        ?>
                        <textarea class="cta-form__input cta-form__textarea border-0"
                                  name="<?= str_replace(' ', '_', $transliteratedText); ?>"
                                  data-title="<?= $field['message_title']; ?>"
                                  placeholder="<?= $is_placeholder_shown ? $placeholder : ""; ?>" <?= $is_required ? 'required' : ''; ?>></textarea>
                        <?php
                    } else {
                        ?>
                        <input class="cta-form__input border-0" type="<?= $type ?>"
                               name="<?= str_replace(' ', '_', $transliteratedText); ?>"
                               placeholder="<?= $is_placeholder_shown ? $placeholder : ""; ?>"
                               data-title="<?= $field['message_title']; ?>"
                            <?php
                            if (!$is_team_page && ($min_number || $type === "date")) {
                                $date = $min_date ? $min_date : date('Y-m-d');
                                ?>
                                min="<?= $min_number ? $min_number : $date; ?>"
                                <?php
                            }
                            if ($max_number || $max_date) {
                                ?>
                                max="<?= $max_number ? $max_number : $max_date; ?>"
                                <?php
                            }
                            ?>
                            <?= $is_required ? 'required' : '' ?>
                        >
                        <?php
                    }
                    ?>
                </label>
                <?php
            }
            ?>
            <button class="cta-form__button button-primary border-0 button-loading position-relative <?= $is_team_page ? "" : "w-100"; ?>"
                    type="submit">
                <span class="d-block">
                    <?= get_field('send_button'); ?>
                </span>
                <?= get_template_part('templates/loader'); ?>
            </button>
        </form>
        <?php
        if (!$is_team_page) {
            ?>
            <p class="form-wrapper__text text-center">
                <?= translate_and_output('legal'); ?>
            </p>
            <?php
        }
        ?>
    </div>
    <?php
}
?>