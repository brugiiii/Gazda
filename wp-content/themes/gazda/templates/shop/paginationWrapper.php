<?php
$page = $args['page'] ?? 1;
$query = $args['query'] ?? null;
?>

<div class="pagination-wrapper">
    <button type="button"
            class="load-more mx-auto d-flex align-items-center justify-content-center gap-2 border-0">
        <svg class="load-more__icon" width="24" height="24">
            <use href="<?php get_image('sprite.svg#icon-arrow-circle'); ?>"></use>
        </svg>
        <?= translate_and_output('load_more'); ?>
    </button>

    <?php
    get_template_part('templates/shop/pagination', null, array('page' => $page, 'query' => $query));
    ?>
</div>