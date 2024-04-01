<?php
$categories = $_POST['categories'] ?? array();
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 12;
$order = isset($_POST['order']) ? $_POST['order'] : 'DESC';
$tags = $_POST['tags'] ?? array();
$class = $_POST['class'] ?? 'shop';

// Захист від SQL-ін'єкцій
$categories = array_map('intval', $categories);
$tags = array_map('sanitize_text_field', $tags);
$page = intval($page);

get_template_part('templates/shop/tagList', null, array('categories' => $categories));

$args = array(
    'post_type' => array('product', 'product_variation'),
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

$args['tax_query'][] = array(
    'taxonomy' => 'class',
    'field' => 'slug',
    'terms' => $class,
    'operator' => 'IN',
);

if (!empty($tags) && count($categories) === 1) {
    $args['tax_query'][] = array(
        'taxonomy' => 'product_tag',
        'field' => 'id',
        'terms' => $tags,
        'operator' => 'IN',
    );
}

$query = new WP_Query($args);

if ($query->have_posts()) {
    ?>
    <?php
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
    <h2 class="section-title-secondary mb-0">
        <?= translate_and_output('no_products'); ?>
    </h2>
    <?php
}

wp_die();

?>
