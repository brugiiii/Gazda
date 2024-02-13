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
        <?php
        if (is_page_template('pages/delivery.php')) {
            echo $current_lang === 'uk' ? get_the_title(6562) : get_the_title(6606);
        } else {
            echo is_shop() ? woocommerce_page_title() : get_the_title(6386);
        }
        ?>
    </span>
    <span class="d-none d-lg-inline">
        <?= get_template_part('helpers/separator'); ?>
    </span>
    <span class="current d-none d-lg-inline"></span>
</div>