<?php
$is_modal = $args['is_modal'] ?? false;
$fields = $is_modal ? get_field('vacancies_fields', 6955) : get_field('fields', 6955);
if ($fields) {
    ?>
    <form class="cta-form text-center">
        <?php
        foreach ($fields as $field) {
            $type = $field['type'];
            $options = $field['options'];
            $is_required = $field['is_required'];
            $name = $field['name'];
            ?>
            <label class="cta-form__field position-relative d-flex flex-column">
            <span class="cta-form__title form-title mb-1 d-flex text-white fs-6">
                <?= $field['title']; ?>
            </span>
                <?php
                if ($type === 'select') {
                    ?>
                    <button class="cta-form__input d-flex align-items-center justify-content-between py-2 bg-white border-0 text-start select-button-js"
                            type="button" <?= $is_required ? 'required' : '' ?>>
                    <span class="cta-form__item">
                        <?= $options[0]; ?>
                    </span>
                        <svg class="cta-form___icon" width="24" height="24">
                            <use href="<?php get_image('sprite.svg#icon-caret-down'); ?>"></use>
                        </svg>
                    </button>
                    <input hidden type="text" name="<?= $name; ?>" value="<?= $options[0]; ?>" readonly/>
                    <ul class="options-list position-absolute z-1 start-0 w-100 overflow-hidden bg-white">
                        <?php foreach ($options as $option): ?>
                            <li class="options-list__item">
                                <button type="button"
                                        class="options-list__button d-block w-100 text-start border-0 <?= $options[0] === $option ? 'is-active' : ''; ?>">
                                    <?= $option; ?>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php
                } else {
                    ?>
                    <input class="cta-form__input border-0" type="<?= $type ?>"
                           name="<?= $name; ?>"
                           placeholder="<?= $field['placeholder']; ?>"
                        <?= $is_required ? 'required' : '' ?>
                    >
                    <?php
                }
                ?>
            </label>
            <?php
        }
        echo $is_modal ? '<input type="text" name="title" hidden readonly>' : '';
        ?>
        <button type="submit" class="cta-button border-0 fs-6">
            НАДІСЛАТИ ЗАЯВКУ
        </button>
    </form>
    <?php
}
?>


