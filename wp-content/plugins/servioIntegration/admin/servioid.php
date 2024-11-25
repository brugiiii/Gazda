<?php

add_filter('manage_edit-product_columns', 'add_custom_column_to_products_list');
function add_custom_column_to_products_list($columns)
{
    $columns['servio_product_id'] = 'Servio Product ID';
    return $columns;
}

add_action('manage_product_posts_custom_column', 'fill_custom_column_in_products_list', 10, 2);
function fill_custom_column_in_products_list($column, $post_id)
{
    if ($column === 'servio_product_id') {
        $servio_product_id = get_post_meta($post_id, 'servio_product_id', true);
        echo $servio_product_id;
    }
}
