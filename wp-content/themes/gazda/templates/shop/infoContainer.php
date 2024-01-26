<?php
$current_lang = pll_current_language();
?>

<div class="info-container">
    <div class="content">
        <?= $current_lang === 'en' ? get_field('content_visible', 6386) : get_field('content_visible'); ?>
    </div>
    <div class="content">
        <?= $current_lang === 'en' ? get_field('content_hidden', 6386) : get_field('content_hidden'); ?>
    </div>
    <h2 class="faq-title">
        <?= the_field('faq_title'); ?>
    </h2>
    <?= get_template_part('templates/shop/faqList'); ?>
</div>