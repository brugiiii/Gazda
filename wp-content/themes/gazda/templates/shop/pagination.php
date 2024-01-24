<?php
$page = $args['page'] ?? 1;
$query = $args['query'] ?? '';

$current_page = (int)$page;
$total_pages = $query->max_num_pages;
$pagination_range = 2;
?>

<div class="pagination d-flex justify-content-center">
    <?php
    if ($total_pages > 4) {
        ?>
        <button class="pagination__item fw-medium d-inline-flex align-items-center justify-content-center align-items-center justify-content-center"
                type="button" href="#" data-action="first" <?= $current_page === 1 ? 'disabled' : ''; ?>>
            <svg class="pagination__icon" width="20" height="20">
                <use href="<?php get_image('sprite.svg#icon-double-carret-left'); ?>"></use>
            </svg>
        </button>
        <?php
    }
    ?>
    <button class="pagination__item fw-medium d-inline-flex align-items-center justify-content-center align-items-center justify-content-center"
            type="button" href="#" data-action="prev" <?= $current_page === 1 ? 'disabled' : ''; ?>>
        <svg class="pagination__icon" width="20" height="20">
            <use href="<?php get_image('sprite.svg#icon-carret-left'); ?>"></use>
        </svg>
    </button>
    <?php

    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == 1 || $i == $total_pages || ($i >= $current_page - $pagination_range && $i <= $current_page + $pagination_range)) {
            ?>
            <button class="pagination__item fw-medium d-inline-flex align-items-center justify-content-center align-items-center justify-content-center <?= $i === $current_page ? 'current' : ''; ?>"
                    type="button" data-page="<?php echo $i; ?>"><?php echo $i; ?></button>
            <?php
        } elseif ($i == $current_page - $pagination_range - 1 || $i == $current_page + $pagination_range + 1) {
            ?>
            <span class="swiper-pagination-bullet-ellipsis fw-medium d-inline-flex align-items-center justify-content-center">...</span>
            <?php
        }
    }
    ?>
    <button class="pagination__item fw-medium d-inline-flex align-items-center justify-content-center align-items-center justify-content-center"
            type="button" href="#" data-action="next" <?= $current_page == $total_pages ? 'disabled' : ''; ?>>
        <svg class="pagination__icon" width="20" height="20">
            <use href="<?php get_image('sprite.svg#icon-carret-right'); ?>"></use>
        </svg>
    </button>
    <?php
    if ($total_pages > 4) {
        ?>
        <button class="pagination__item fw-medium d-inline-flex align-items-center justify-content-center align-items-center justify-content-center"
                type="button" href="#" data-action="last"
                data-last-page="<?= $total_pages; ?>" <?= $current_page == $total_pages ? 'disabled' : ''; ?>>
            <svg class="pagination__icon" width="20" height="20">
                <use href="<?php get_image('sprite.svg#icon-double-carret-right'); ?>"></use>
            </svg>
        </button>
        <?php
    }
    ?>
    <?php
    ?>
</div>