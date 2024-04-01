<?php
$cards = get_field('cards');
?>

<section class="section about">
    <div class="container">
        <h2 class="about-title h2 text-center text-uppercase">
            <?= the_field('about_title'); ?>
        </h2>
        <?php
        if ($cards) {
            ?>
            <ul class="cards-list">
                <?php
                foreach ($cards as $card) {
                    $image_id = $card['image']
                    ?>
                    <li class="cards-list__item d-lg-flex rounded-4 overflow-hidden bg-white">
                        <div class="cards-list__thumb flex-shrink-0">
                            <?= wp_get_attachment_image($image_id, 'full', false, array('class' => 'cards-list__image')); ?>
                        </div>
                        <div class="cards-list__content align-self-center">
                            <h3 class="cards-list__title mb-3 text-uppercase">
                                <?= $card['title']; ?>
                            </h3>
                            <p class="cards-list__text mb-0">
                                <?= $card['text']; ?>
                            </p>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php
        }
        ?>
    </div>
</section>