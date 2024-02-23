<?php
$image_id = get_field('about_image');
$peoples = get_field('about_peoples');
$area = get_field('about_area');
$parking = get_field('about_parking');
$price = get_field('about_price');
$button = get_field('about_button');
?>

<section class="about">
    <div class="container">
        <div class="about-wrapper d-md-flex overflow-hidden">
            <div class="about-thumb flex-grow-1 flex-shrink-0">
                <?= wp_get_attachment_image($image_id, 'full', false, array('class' => '')); ?>
            </div>
            <div class="about-content flex-grow-1">
                <h2 class="about-title title mb-3">
                    <?= the_field('about_title'); ?>
                </h2>
                <?php
                if ($peoples || $area || $parking) {
                    ?>
                    <ul class="data-list d-flex flex-wrap mb-3">
                        <?php
                        if ($peoples) {
                            ?>
                            <li class="data-list__item peoples d-flex gap-2 align-items-center">
                                <?= $peoples; ?>
                            </li>
                            <?php
                        }
                        if ($area) {
                            ?>
                            <li class="data-list__item area d-flex gap-2 align-items-center">
                                <?= $area; ?>
                            </li>
                            <?php
                        }
                        if ($parking) {
                            ?>
                            <li class="data-list__item parking d-flex gap-2 align-items-center">
                                <?= $parking; ?>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                the_field('about_description');
                if ($price || $button) {
                    ?>
                    <div class="price-wrapper d-flex align-items-sm-start flex-column gap-3">
                        <?php
                        if ($price) {
                            ?>
                            <p class="price-wrapper__cost mb-0">
                                <span>
                                    <?= translate_and_output('cost') . ' - ' ?>
                                </span>
                                <?= $price; ?>
                            </p>
                            <?php
                        }
                        if ($button) {
                            ?>
                            <a class="price-wrapper__link button-secondary text-center d-inline-block text-white" href="#cta">
                                <?= $button; ?>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>