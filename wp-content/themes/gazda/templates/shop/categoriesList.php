<?php
$categories = $args['categories'] ?? null;

if (count($categories) === 1) {
    // Отримання тегів за заданою категорією
    $tags_args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $categories,
                'operator' => 'IN',
            ),
        ),
    );

    $tags_query = new WP_Query($tags_args);

    // Перевірка, чи є хоча б один тег
    $has_tags = false;

    while ($tags_query->have_posts()) {
        $tags_query->the_post();

        // Отримання тегів для поточного поста
        $post_tags = wp_get_post_terms(get_the_ID(), 'product_tag', array('fields' => 'ids'));

        if (!empty($post_tags)) {
            $has_tags = true;
            break; // Якщо знайдено хоча б один тег, виходимо з циклу
        }
    }

    // Виведення div тільки якщо є хоча б один тег
    if ($has_tags) {
        ?>
        <div class="filter-wrapper">
            <?php
            // Повторне перебирання для виведення тегів
            $tags_query->rewind_posts();
            while ($tags_query->have_posts()) {
                $tags_query->the_post();

                // Отримання тегів для поточного поста
                $post_tags = wp_get_post_terms(get_the_ID(), 'product_tag', array('fields' => 'ids'));

                // Виведення чекбоксів
                foreach ($post_tags as $tag_id) {
                    ?>
                    <label class="filter-wrapper__field d-flex align-items-center gap-2">
                        <input class="filter-wrapper__input" type="checkbox" value="<?= esc_attr($tag_id); ?>">
                        <?= esc_html(get_term($tag_id, 'product_tag')->name); ?>
                    </label>
                    <?php
                }
            }
            ?>
        </div>
        <?php
        // Закриття петлі запиту
        wp_reset_postdata();
    }
}
?>
