<?php
$current_lang = pll_current_language();
$home_page = pll_get_post(16, $current_lang);
?>

<div class="breadcrumb">
    <a href="<?= get_permalink($home_page); ?>">
        <?= get_the_title($home_page); ?>
    </a>
    <?= get_template_part('helpers/separator'); ?>
    <span>
                <?= is_shop() ? woocommerce_page_title() : get_the_title(6386); ?>
            </span>
    <?= get_template_part('helpers/separator'); ?>
    <span class="current">
                <?= translate_and_output('all_products'); ?>
            </span>
</div>