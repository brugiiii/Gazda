<?php
$address = get_field('address', 16);
$email = get_field('email', 16);
$email_second = get_field('email_second', 16)
?>

<section class="hero text-white">
    <?= get_template_part('templates/breadcrumbs'); ?>
    <div class="container">
        <?= get_template_part('templates/breadcrumbs'); ?>
        <div class="hero-wrapper d-md-flex">
            <div class="flex-shrink-0">
                <h1 class="hero-title">
                    <?= translate_and_output('out_contacts'); ?>
                </h1>
                <div class="hero-content d-sm-flex">
                    <?= get_template_part('templates/sectorsList', null, array('is_address_visible' => false, 'is_grid' => false)); ?>
                    <div class="d-flex flex-column">
                        <span class="hero-content__title fs-6 mb-1">
                            <?= translate_and_output('address'); ?>
                        </span>
                        <a class="hero-content__link mb-3" href="<?= $address['url']; ?>" target="<?= $address['target']; ?>"
                           rel="noreferrer nofollow noopener">
                            <?= $address['title']; ?>
                        </a>
                        <span class="hero-content__title fs-6 mb-1">
                            E-mail
                        </span>
                        <a class="hero-content__link mb-3" href="<?= $email['url']; ?>" target="<?= $email['target']; ?>"
                           rel="noreferrer nofollow noopener">
                            <?= $email['title']; ?>
                        </a>
												<?php if(!empty($email_second)):?>
                        <a class="hero-content__link mb-3" href="<?= $email_second['url']; ?>" target="<?= $email_second['target']; ?>"
                           rel="noreferrer nofollow noopener">
                            <?= $email_second['title']; ?>
                        </a>
												<?php endif;?>
                        <span class="hero-content__title fs-6 mb-1">
                            <?= translate_and_output('socials'); ?>
                        </span>
                        <?= get_template_part('templates/socialsList'); ?>
                    </div>
                </div>
            </div>
            <div class="hero-thumb d-none d-md-block flex-shrink-0 overflow-hidden">
                <?= the_field('map', 16); ?>
            </div>
        </div>
    </div>
</section>
<div class="hero-thumb d-md-none">
    <?= the_field('map', 16); ?>
</div>