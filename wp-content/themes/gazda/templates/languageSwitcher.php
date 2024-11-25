<?php
$languages = pll_the_languages(array('raw' => 1));
$current_language = pll_current_language();
?>

<button class="language-switcher position-relative d-flex align-items-center gap-1 gap-sm-2 text-uppercase unset">
    <?= $current_language; ?>
    <svg class="language-switcher__icon" width="24" height="24">
        <use href="<?= get_image('sprite.svg#icon-caret-down'); ?>"></use>
    </svg>
    <ul class="languages-list position-absolute top-100 ">
        <?php foreach ($languages as $lang_code => $language) : ?>
            <?php if ($lang_code !== $current_language) : ?>
                <li class="languages-list__item">
                    <a class="languages-list__link text-uppercase d-inline-block"
                       href="<?= esc_url($language['url']); ?>">
                        <?= esc_html($lang_code); ?>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        <li class="languages-list__item">
            <a class="languages-list__link text-uppercase d-inline-block"
               href="<?= esc_url($languages[$current_language]['url']); ?>">
                <?= esc_html($current_language); ?>
            </a>
        </li>
    </ul>
</button>

