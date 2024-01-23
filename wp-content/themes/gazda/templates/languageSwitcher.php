<?php
$languages = pll_the_languages(array('raw' => 1));
$current_language = pll_current_language();
?>

<div class="position-relative language-switcher-wrapper">
    <div class="selected-language text-uppercase">
        <?php echo $current_language; ?>
    </div>
    <ul class="languages-list top-100 start-50 translate-middle-x is-hidden position-absolute">
        <?php foreach ($languages as $lang_code => $language) : ?>
            <?php if ($lang_code !== $current_language) : ?>
                <li>
                    <a class="text-uppercase d-inline-block"
                       href="<?php echo esc_url($language['url']); ?>"><?php echo esc_html($lang_code); ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>
