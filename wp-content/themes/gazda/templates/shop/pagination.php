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
        <button class="pagination__item border-0 p-0 d-inline-flex align-items-center align-items-center justify-content-center"
                type="button" href="#" data-action="first" <?= $current_page === 1 ? 'disabled' : ''; ?>>
            <svg class="pagination__icon" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon_caret_left_stop'); ?>"></use>
            </svg>
        </button>
        <?php
    }
    ?>
    <button class="pagination__item border-0 p-0 d-inline-flex align-items-center align-items-center justify-content-center"
            type="button" href="#" data-action="prev" <?= $current_page === 1 ? 'disabled' : ''; ?>>
        <svg class="pagination__icon" width="24" height="24">
            <use href="<?php get_image('sprite.svg#icon-caret-left'); ?>"></use>
        </svg>
    </button>
    <?php

    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == 1 || $i == $total_pages || ($i >= $current_page - $pagination_range && $i <= $current_page + $pagination_range)) {
            ?>
            <button class="pagination__item number rounded-3 border-0 p-0 d-inline-flex align-items-center align-items-center justify-content-center <?= $i === $current_page ? 'current' : ''; ?>"
                    type="button" data-page="<?php echo $i; ?>"><?php echo $i; ?></button>
            <?php
        } elseif ($i == $current_page - $pagination_range - 1 || $i == $current_page + $pagination_range + 1) {
            ?>
            <span class="swiper-pagination-bullet-ellipsis  d-inline-flex align-items-center justify-content-center">...</span>
            <?php
        }
    }
    ?>
    <button class="pagination__item border-0 p-0 d-inline-flex align-items-center align-items-center justify-content-center"
            type="button" href="#" data-action="next" <?= $current_page == $total_pages ? 'disabled' : ''; ?>>
        <svg class="pagination__icon" width="24" height="24">
            <use href="<?php get_image('sprite.svg#icon-caret-right'); ?>"></use>
        </svg>
    </button>
    <?php
    if ($total_pages > 4) {
        ?>
        <button class="pagination__item border-0 p-0 d-inline-flex align-items-center align-items-center justify-content-center"
                type="button" href="#" data-action="last"
                data-last-page="<?= $total_pages; ?>" <?= $current_page == $total_pages ? 'disabled' : ''; ?>>
            <svg class="pagination__icon" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon_caret_right_stop'); ?>"></use>
            </svg>
        </button>
        <?php
    }
    ?>
    <?php
    ?>
</div>