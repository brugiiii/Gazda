<?php
$current_lang = pll_current_language();
$contacts_bg = get_field('contacts_bg');
$sectors = array(
    array(
        'title' => get_field('contacts_sectors_title_first'),
        'name' => get_field('contacts_sectors_name_first'),
        'address' => get_field('contacts_sectors_address_first'),
        'number' => get_field('contacts_sectors_number_first')
    ),
    array(
        'title' => get_field('contacts_sectors_title_second'),
        'name' => get_field('contacts_sectors_name_second'),
        'address' => get_field('contacts_sectors_address_second'),
        'number' => get_field('contacts_sectors_number_second')
    ),
    array(
        'title' => get_field('contacts_sectors_title_third'),
        'name' => get_field('contacts_sectors_name_third'),
        'address' => get_field('contacts_sectors_address_third'),
        'number' => get_field('contacts_sectors_number_third')
    )
);
?>

<div class="contacts-thumb d-lg-none overflow-hidden">
    <?php the_field('contacts_map'); ?>
</div>
<section class="contacts">
    <div class="container p-lg-0">
        <div class="contacts-wrapper d-lg-flex">
            <div class="contacts-thumb d-none d-lg-block flex-shrink-0 overflow-hidden align-self-lg-start">
                <?php the_field('contacts_map'); ?>
            </div>
            <div class="d-flex flex-column justify-content-lg-between">
                <h2 class="contacts-title mb-0 section-title text-center text-lg-start">
                    <?php the_field('contacts_title'); ?>
                </h2>
                <div class="contacts-content ">
                    <ul class="sectors-list d-flex flex-column flex-sm-row flex-sm-wrap">
                        <?php foreach ($sectors as $sector) : ?>
                            <li class="sectors-list__item d-flex flex-column">
                                <h3 class="sectors-list__title">
                                    <?php echo $sector['title']; ?>
                                </h3>
                                <span class="sectors-list__name">
                                    <?php echo $sector['name']; ?>
                                </span>
                                <a class="sectors-list__link" target="<?php echo $sector['address']['target']; ?>"
                                   href="<?php echo $sector['address']['url']; ?>">
                                    <?php echo $sector['address']['title']; ?>
                                </a>
                                <a class="sectors-list__link" href="<?php echo $sector['number']['url']; ?>">
                                    <?php echo $sector['number']['title']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <span class="contacts-content__schedule d-lg-none d-inline-block">
                        <?php the_field('schedule', pll_get_post(16, $current_lang)); ?>
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