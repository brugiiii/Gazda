<?php
$categories = $_POST['categories'] ?? array();
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 12;
$order = isset($_POST['order']) ? $_POST['order'] : 'ASC';

// Захист від SQL-ін'єкцій
$categories = array_map('intval', $categories);
$page = intval($page);

$args = array(
    'post_type' => 'product',
    'posts_per_page' => $posts_per_page,
    'paged' => $page,
    'order' => $order,
    'orderby' => 'meta_value_num',
    'meta_key' => '_price',
);

$args['tax_query'] = array(
    array(
        'taxonomy' => 'product_cat',
        'field' => 'id',
        'terms' => $categories,
        'operator' => 'IN',
    ),
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    ?>
    <ul class="products-list d-flex flex-wrap">
        <?php
        while ($query->have_posts()) {
            $query->the_post();
            $thumbnail_id = get_post_thumbnail_id(get_the_ID());
            ?>
            <li class="products-list__item position-relative">
                <div class="product-list__wrapper bg-white position-absolute top-0 start-0 rounded-3 overflow-hidden d-flex flex-column w-100">
                    <div class="products-list__thumb">
                        <?= $thumbnail_id ? wp_get_attachment_image($thumbnail_id, 'full', false, array('class' => '')) : wc_placeholder_img(array('class' => '')); ?>
                    </div>
                    <div class="product-list__details px-3 pb-3 pt-2 flex-grow-1">
                        <h3 class="product-list__title mb-2">
                            <?php the_title(); ?>
                        </h3>
                        <span class="product-list__price mb-1 d-block">
                                <?= get_template_part('templates/price'); ?>
                            </span>
                        <button class="product-list__button button-primary w-100 border-0 d-flex align-items-center justify-content-center gap-2"
                                data-product-id="<?= get_the_ID(); ?>">
                            <svg class="product-list__icon" width="24" height="24">
                                <use href="<?php get_image('sprite.svg#icon-shopping-cart'); ?>"></use>
                            </svg>
                            <?= translate_and_output('buy'); ?>
                        </button>
                        <div class="quantity align-items-center justify-content-center mt-2">
                            <button class="quantity__button bg-transparent border-0 p-0 decrement">
                                <svg class="quantity__icon" width="24" height="24">
                                    <use href="<?php get_image('sprite.svg#icon-minus'); ?>"></use>
                                </svg>
                            </button>
                            <span class="quantity__value d-flex align-items-center justify-content-center rounded-3 bg-white">1</span>
                            <button class="quantity__button bg-transparent border-0 p-0 increment">
                                <svg class="quantity__icon" width="24" height="24">
                                    <use href="<?php get_image('sprite.svg#icon-plus'); ?>"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
    <?php
    if ($query->max_num_pages > 1) {
        ?>
        <button type="button" class="load-more mx-auto d-flex align-items-center justify-content-center gap-2 border-0">
            <svg class="load-more__icon" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon-arrow-circle'); ?>"></use>
            </svg>
            <?= translate_and_output('load_more'); ?>
        </button>
        <?php
        get_template_part('templates/shop/pagination', null, array('page' => $page, 'query' => $query));
    }
} else {
    ?>
    <h2 class="section-title-secondary mb-0">
        <?= translate_and_output('no_products'); ?>
    </h2>
    <?php
}

wp_die();

?>
