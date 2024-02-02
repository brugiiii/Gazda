<?php
$current_lang = pll_current_language();
$home_page = pll_get_post(16, $current_lang);
$product_categories = wc_get_product_terms(get_the_ID(), 'product_cat', array('orderby' => 'parent'));
?>

<div class="breadcrumb">
    <a href="<?= get_permalink($home_page); ?>">
        <?= get_the_title($home_page); ?>
    </a>
    <?= get_template_part('helpers/separator'); ?>
    <span>
        <?php
        if (!empty($product_categories)) {
            echo esc_html($product_categories[0]->name);
        }
        ?>
    </span>
    <?= get_template_part('helpers/separator'); ?>
    <span class="current">
        <?= the_title(); ?>
    </span>
</div>
