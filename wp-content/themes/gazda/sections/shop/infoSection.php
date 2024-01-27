<?php
$current_lang = pll_current_language();
?>

<section class="info">
    <div class="container">
        <div class="section-wrapper">
            <div class="text-content">
                <div class="text-content__visible">
                    <?= is_shop() ? get_field('content_visible', 6354) : get_field('content_visible'); ?>
                </div>
                <div class="text-content__hidden">
                    <?= is_shop() ? get_field('content_hidden', 6354) : get_field('content_hidden'); ?>
                </div>
                <button class="text-content__button d-block py-0 border-0 mx-auto mt-3 text-white" type="button">
                    <span class="show">
                        <?= translate_and_output('read_more'); ?>
                    </span>
                    <span class="hide">
                        <?= translate_and_output('hide'); ?>
                    </span>
                </button>
            </div>
        </div>
    </div>
</section>