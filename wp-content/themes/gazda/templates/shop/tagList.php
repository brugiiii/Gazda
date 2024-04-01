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
    if ($tags_query->have_posts()) {
        // Масив для зберігання вже виведених тегів
        $displayed_tags = array();

        // Флаг для перевірки наявності хоча б одного унікального тегу
        $has_tags = false;

        while ($tags_query->have_posts()) {
            $tags_query->the_post();

            // Отримання тегів для поточного поста
            $post_tags = wp_get_post_terms(get_the_ID(), 'product_tag', array('fields' => 'ids'));

            // Перевірка, чи є хоча б один унікальний тег
            foreach ($post_tags as $tag_id) {
                if (!in_array($tag_id, $displayed_tags)) {
                    $displayed_tags[] = $tag_id; // Додаємо тег до вже виведених
                    $has_tags = true; // Встановлюємо флаг на true
                    break; // Вихід з циклу, якщо знайдено унікальний тег
                }
            }
        }

        // Виведення <div class="filter-wrapper"> тільки якщо є хоча б один унікальний тег
        if (count($displayed_tags) > 1) {
            ?>
            <div class="filter-wrapper">
                <?php
                // Виведення чекбоксів для тегів
                foreach ($displayed_tags as $tag_id) {
                    ?>
                    <label class="filter-wrapper__field d-flex align-items-center gap-2">
                        <input class="filter-wrapper__input" type="checkbox" value="<?= esc_attr($tag_id); ?>">
                        <?= esc_html(get_term($tag_id, 'product_tag')->name); ?>
                    </label>
                    <?php
                }
                ?>
            </div>

            <select class="filter-select d-lg-none" multiple>
                <?php
                foreach ($displayed_tags as $tag_id) {
                    ?>
                    <option value="<?= esc_attr($tag_id); ?>">
                        <?= esc_html(get_term($tag_id, 'product_tag')->name); ?>
                    </option>
                    <?php
                }
                ?>
            </select>
            <?php
        }

        // Закриття петлі запиту
        wp_reset_postdata();
    }
}
?>
