<?php
$image_id = get_field('about_image');
$peoples = get_field('about_peoples');
$area = get_field('about_area');
$parking = get_field('about_parking');
$price = get_field('about_price');
$button = get_field('about_button');

$cards = get_field('about_cards');
?>

<section class="about">
    <div class="container">
        <div class="about-wrapper position-relative">
            <div class="swiper about-swiper position-relative">
                <ul class="cards-list swiper-wrapper d-flex">
                    <?php foreach ($cards as $card): ?>
                        <li class="cards-list__item swiper-slide d-md-flex overflow-hidden">
                            <div class="cards-list__thumb flex-grow-1 flex-shrink-0">
                                <?= wp_get_attachment_image($card['about_image'], 'full', false, array('class' => '')); ?>
                            </div>
                            <div class="cards-list__content flex-grow-1">
                                <h2 class="cards-list__title title mb-3">
                                    <?= $card['about_title']; ?>
                                </h2>
                                <?php if ($card['about_peoples'] || $card['about_area'] || $card['about_parking']): ?>
                                    <ul class="data-list d-flex flex-wrap mb-3">
                                        <?php if ($card['about_peoples']): ?>
                                            <li class="data-list__item peoples d-flex gap-2 align-items-center">
                                                <?= $card['about_peoples']; ?>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($card['about_area']): ?>
                                            <li class="data-list__item area d-flex gap-2 align-items-center">
                                                <?= $card['about_area']; ?>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($card['about_parking']): ?>
                                            <li class="data-list__item parking d-flex gap-2 align-items-center">
                                                <?= $card['about_parking']; ?>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                                <?= $card['about_description']; ?>
                                <?php if ($card['about_price'] || $card['about_button']): ?>
                                    <div class="price-wrapper d-flex align-items-sm-start flex-column gap-3">
                                        <?php if ($card['about_price']): ?>
                                            <p class="price-wrapper__cost mb-0">
                                                <span><?= translate_and_output('cost') . ' - ' ?></span>
                                                <?= $card['about_price']; ?>
                                            </p>
                                        <?php endif; ?>
                                        <?php if ($card['about_button']): ?>
                                            <a class="price-wrapper__link button-secondary text-center d-inline-block text-white"
                                               href="#cta">
                                                <?= $card['about_button']; ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php get_template_part('templates/ctrls'); ?>
        </div>
    </div>
</section>