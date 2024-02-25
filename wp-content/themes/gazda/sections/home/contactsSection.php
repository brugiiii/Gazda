<?php
$current_lang = pll_current_language();
$contacts_bg = get_field('contacts_bg');
?>

<div class="contacts-thumb d-lg-none overflow-hidden">
    <?php the_field('contacts_map'); ?>
</div>
<section class="contacts">
    <div class="container p-lg-0">
        <div class="contacts-wrapper d-lg-flex">
            <div class="contacts-thumb d-none d-lg-block flex-shrink-0 overflow-hidden align-self-lg-start">
                <?= the_field('map'); ?>
            </div>
            <div class="d-flex flex-column justify-content-lg-between">
                <h2 class="contacts-title mb-0 section-title text-center text-lg-start">
                    <?= translate_and_output('out_contacts'); ?>
                </h2>
                <div class="contacts-content ">
                    <?= get_template_part('templates/sectorsList'); ?>
                    <span class="contacts-content__schedule d-lg-none d-inline-block">
                        <?= the_field('schedule', pll_get_post(16, $current_lang)); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .contacts {
        background-image: -webkit-linear-gradient(0deg, rgba(9, 25, 22, 0.70) 0%, rgba(9, 25, 22, 0.70) 100%), url(<?= $contacts_bg; ?>);
        background-image: -moz-linear-gradient(0deg, rgba(9, 25, 22, 0.70) 0%, rgba(9, 25, 22, 0.70) 100%), url(<?= $contacts_bg; ?>);
        background-image: -o-linear-gradient(0deg, rgba(9, 25, 22, 0.70) 0%, rgba(9, 25, 22, 0.70) 100%), url(<?= $contacts_bg; ?>);
        background-image: -ms-linear-gradient(0deg, rgba(9, 25, 22, 0.70) 0%, rgba(9, 25, 22, 0.70) 100%), url(<?= $contacts_bg; ?>);
        background-image: linear-gradient(0deg, rgba(9, 25, 22, 0.70) 0%, rgba(9, 25, 22, 0.70) 100%), url(<?= $contacts_bg; ?>);
    }
</style>