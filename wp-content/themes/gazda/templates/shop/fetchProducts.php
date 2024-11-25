<?php
$categories = $_REQUEST['categories'] ?? array();
$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
$posts_per_page = isset($_REQUEST['posts_per_page']) ? intval($_REQUEST['posts_per_page']) : 12;
$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : 'DESC';
$tags = $_REQUEST['tags'] ?? array();
$class = $_REQUEST['class'] ?? 'shop';
$idCat = $_REQUEST['categories'] ?? "NO";

// var_dump($categories);

// Захист від SQL-ін'єкцій
$categories = array_map('intval', $categories);
$tags = array_map('sanitize_text_field', $tags);
$page = intval($page);



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
	ob_start();
	$category = null;
	while ($query->have_posts()) {
		$query->the_post();
		$thumbnail_id = get_post_thumbnail_id(get_the_ID());
		$category = get_the_category();
		get_template_part('templates/shop/productCard', null, array('thumbnail_id' => $thumbnail_id));

	}


	if ($query->max_num_pages > 1) {
		?>
		<?php echo get_template_part('templates/shop/paginationWrapper', null, array('page' => $page, 'query' => $query)); ?>
	<?php
	}
} else {
	?>
	<h2 class="section-title-secondary mb-0">
		<?php echo translate_and_output('no_products'); ?>
	</h2>

	<?php
}

get_template_part('templates/shop/tagList', null, array('categories' => $categories));

$responce["productMarkup"] = ob_get_clean();
ob_start();
?>
<div class="text-content__visible">


	<?php


	// Отримання значення tag_ID з URL (наприклад, 205)
	

	// Перевірка, чи є значення tag_ID і чи існує тег з таким ID
//       $content_visible = get_field('content_visible', 'tag_ID=' . $categories);
	
	$fields = get_field('content_visible', 'product_cat_' . $categories[0]);
	if ($fields) {
		foreach ($fields as $value) {
			get_template_part('templates/shop/categoryDescription', null, $args = array("value" => $value));
		}
	}



	?>

</div>
<?php

$responce["productContent"] = ob_get_clean();

wp_die(json_encode($responce));

?>