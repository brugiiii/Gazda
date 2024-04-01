<?php
$address = get_field('address', 16);
$number = get_field('number', 16);
$current_lang = pll_current_language();
?>

<div class="d-lg-flex justify-content-lg-between footer-content">
    <?php the_custom_logo(); ?>
    <span class="footer-content__socials fs-6 text-white d-lg-none d-block mb-3 text-center">
                <?= translate_and_output('socials'); ?>
            </span>
    <div class="d-lg-none">
        <?php get_template_part('templates/socialsList'); ?>
    </div>
    <?= get_template_part('templates/navigation', null, array('location' => 'menu-footer')); ?>
    <div class="d-none d-lg-block">
        <?php get_template_part('templates/socialsList'); ?>
    </div>
</div>
<div class="footer-wrapper d-flex flex-column flex-lg-row justify-content-lg-between">
    <div class="footer-wrapper__item d-flex flex-column justify-content-lg-between align-items-center align-items-lg-start text-center text-lg-start order-4 order-lg-1">
        <span class="footer-wrapper__title">
            <?= translate_and_output('copyright') . ' ' . get_bloginfo('name'); ?>
        </span>
        <div>
            <a class="footer-wrapper__link" href="<?= get_permalink(pll_get_post(6643, $current_lang)) ?>">
                <?= translate_and_output('policy'); ?>
            </a>
            <a class="footer-wrapper__link" href="<?= get_permalink(pll_get_post(6650, $current_lang)) ?>">
                <?= translate_and_output('cookies'); ?>
            </a>
        </div>
    </div>
    <div class="footer-wrapper__item d-flex flex-column justify-content-lg-between alignitemscenter align-items-lg-start text-center text-lg-start order-2">
                <span class="footer-wrapper__title">
                    <?= translate_and_output('address'); ?>
                </span>
        <a class="footer-wrapper__link" target="<?php echo $address['target']; ?>"
           href="<?php echo $address['url']; ?>">
            <?php echo $address['title']; ?>
        </a>
    </div>
    <div class="footer-wrapper__item d-flex flex-column justify-content-lg-between alignitemscenter align-items-lg-start text-center text-lg-start order-3">
                <span class="footer-wrapper__title">
                    <?= translate_and_output('number'); ?>
                </span>
        <a class="footer-wrapper__link"
           href="<?php echo $number['url']; ?>">
            <?php echo $number['title']; ?>
        </a>
    </div>
    <div class="footer-wrapper__item alignitemscenter align-items-lg-start text-center text-lg-start order-1 order-lg-4">
                <span class="footer-wrapper__title--mob text-white mb-3 d-block text-center d-lg-none d-block">
                    <?= translate_and_output('app'); ?>
                </span>
        <?php get_template_part('templates/appList'); ?>
    </div>
</div>