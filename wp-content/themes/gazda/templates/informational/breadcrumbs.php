<?php
$current_lang = pll_current_language();
$home_page = pll_get_post(16, $current_lang);

$parent_id = wp_get_post_parent_id(get_the_ID());
?>

<div class="breadcrumb px-3 px-lg-0">
    <a href="<?= get_permalink($home_page); ?>">
        <?= get_the_title($home_page); ?>
    </a>
    <?php
    get_template_part('helpers/separator');
    if ($parent_id) {
        ?>
        <a href="<?= get_permalink($parent_id); ?>">
            <?= get_the_title($parent_id); ?>
        </a>
        <?php
        get_template_part('helpers/separator');
    }
    ?>
    <span class="current">
        <?php the_title() ?>
    </span>
</div>