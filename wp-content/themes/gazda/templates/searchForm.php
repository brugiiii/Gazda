<?php
$is_search_page = is_page_template('pages/search.php');
?>

<div class="search-form position-absolute top-100 start-0 w-100 z-2 <?= $is_search_page ? 'visible' : 'hidden'; ?>">
    <div class="container">
        <label class="search-form__field position-relative d-block">
            <svg class="search-icon position-absolute top-50 translate-middle-y" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon-search'); ?>"></use>
            </svg>
            <input class="search-form__input search-input" type="search"
                   placeholder="<?= translate_and_output('search'); ?>">
        </label>
    </div>
</div>