<?php
$image_id = get_field('logo');
$home_url = get_home_url();
$home_url = str_replace(array('http://', 'https://'), '', $home_url);
$home_url = preg_replace('/^www\./', '', $home_url);
?>

<a class="back-link text-uppercase d-flex align-items-center gap-3"
   href="<?= home_url(); ?>">
    <svg class="back-link__icon" width="24" height="24">
        <use href="<?php get_image('sprite.svg#icon-caret-left'); ?>"></use>
    </svg>
    <span class="d-none d-md-block fs-6">
        <?= $home_url; ?>
    </span>
</a>
<a class="header-logo d-block" href="<?= get_permalink(6955); ?>">
    <?= wp_get_attachment_image($image_id, 'full', false, array('class' => 'logo')); ?>
</a>
<a class="header-anchor text-center text-uppercase" href="#cta">
    <?= the_field('header_button'); ?>
</a>