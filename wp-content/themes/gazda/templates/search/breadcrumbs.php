<?php
$current_lang = pll_current_language();
$home_page = pll_get_post(16, $current_lang);
?>

<div class="breadcrumb px-3 px-lg-0">
    <a href="<?= get_permalink($home_page); ?>">
        <?= get_the_title($home_page); ?>
    </a>
    <?= get_template_part('helpers/separator'); ?>
    <span class="current">
        <?php the_title() ?>
    </span>
</div>