<?php
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 10;
$search_term = isset($_POST['s']) ? $_POST['s'] : '';

$args = array(
    'post_type' => 'product',
    'posts_per_page' => $posts_per_page,
    'paged' => $page,
    's' => $search_term,
    'tax_query' => array(
        array(
            'taxonomy' => 'class',
            'operator' => 'EXISTS',
        ),
    ),
    'meta_key' => '_price',
    'orderby' => 'meta_value_num',
    'order' => isset($_POST['order']) ? $_POST['order'] : 'DESC',
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $thumbnail_id = get_post_thumbnail_id(get_the_ID());
        get_template_part('templates/shop/productCard', null, array('thumbnail_id' => $thumbnail_id));
    }

    if ($query->max_num_pages > 1) {
        ?>
        <?= get_template_part('templates/shop/paginationWrapper', null, array('page' => $page, 'query' => $query)); ?>
        <?php
    }
} else {
    ?>
    <div class="no-results">
        <div class="no-results__thumb mx-auto"></div>
        <p class="text-center no-results__text mb-0">
            <?= translate_and_output('no_results'); ?>
        </p>
    </div>
    <?php
}

wp_die();
?>