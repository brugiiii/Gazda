<?php
$fields = get_field('fields');
?>
<section class="cta" id="cta">
    <div class="container">
        <h2 class="cta-title title py-2 text-center ">
            <?= the_field('cta_title'); ?>
        </h2>
        <?php
        if ($fields) {
            ?>
            <div class="form-wrapper mx-auto">
                <form class="cta-form text-center form-js" id="loyalty">
                    <?php
                    foreach ($fields as $field) {
                        $type = $field['type'];
                        $options = $field['options'];
                        $is_required = $field['is_required'];
                        $name = $field['name'];
                        ?>
                        <label class="cta-form__field position-relative d-flex flex-column">
                            <span class="cta-form__title form-title mb-1 d-flex">
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
                    ?>
                    <button class="cta-form__button button-primary text-white border-0 w-100" type="submit">
                        <?= translate_and_output('send'); ?>
                    </button>
                </form>
            </div>
            <?php
        }
        ?>
    </div>
</section>

