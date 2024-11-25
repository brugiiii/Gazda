<?php
$image = get_field('benefits_image');
$display_option = get_field('display_option');
$with_image = $display_option === 'with_image' ? true : false;
?>

<section class="benefits mx-auto position-relative text-white <?= $display_option; ?>">
    <?php if ($with_image) {
        ?>
        <div class="benefits-thumb d-md-none">
            <?= wp_get_attachment_image($image['id'], 'full', false, array('class' => 'shop-thumb__image')); ?>
        </div>
        <?php
    } ?>
    <div class="container d-flex <?= $with_image ? 'flex-column flex-md-row' : 'flex-row '; ?> ">
        <div class="benefits-content <?= $with_image ? 'mx-auto mx-md-0' : 'w-100'; ?>">
            <h2 class="benefits-title title <?= $with_image ? 'mb-3' : 'text-uppercase'; ?>">
                <?= the_field('benefits_title'); ?>
            </h2>
            <?=
            $with_image ? get_field('benefits_default_list') : get_field('benefits_second_list');
            ?>
        </div>
    </div>
</section>

<?php if ($with_image) {
    ?>
    <style>
        .benefits::after {
            background-image: url(<?= $image['url']; ?>);
        }
    </style>
    <?php
} ?>

