<?php
$members = get_field('members');
?>

<section class="section team">
    <div class="container">
        <h2 class="team-title text-uppercase text-lg-center h2">
            <?= the_field('team_title'); ?>
        </h2>
        <?php
        if ($members) {
            ?>
            <div class="swiper team-swiper mx-0">
                <ul class="team-list swiper-wrapper align-items-stretch">
                    <?php
                    foreach ($members as $member) {
                        $image_id = $member['image']
                        ?>
                        <li class="team-list__item swiper-slide overflow-hidden text-center">
                            <div class="team-list__thumb mb-3">
                                <?= wp_get_attachment_image($image_id, 'full', false, array('class' => 'team-list__image')); ?>
                            </div>
                            <h3 class="team-list__name mb-1">
                                <?= $member['name']; ?>
                            </h3>
                            <span class="team-list__position text-uppercase">
                                <?= $member['position']; ?>
                            </span>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
            get_template_part('templates/single-product/ctrl');
        }
        ?>
    </div>
</section>