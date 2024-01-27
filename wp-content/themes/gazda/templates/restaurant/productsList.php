<?php
$menu_items_hierarchy = process_menu_items_hierarchy();

function display_category_products($category_hierarchy)
{
    foreach ($category_hierarchy as $category_data) {
        $category = isset($category_data['category']) ? $category_data['category'] : null;

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 1,
            'product_cat' => $category->slug,
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) {
            ?>
            <section class="products" id="<?= esc_attr($category->slug) ?>">
                <h2 class="products-title"><?= esc_html($category->name) ?></h2>
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => -1,
                    'product_cat' => $category->slug,
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) : ?>
                    <ul class="products-list">
                        <?php while ($query->have_posts()) : $query->the_post();
                            $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                            $weight = get_field('weight');
                            $time = get_field('time');
                            $ingredients = get_field('ingredients');
                            $allergens_ua = get_field('allergens_ua');
                            $allergens_eng = get_field('allergens_eng');
                            $labels = get_field('label');
                            ?>
                            <li class="products-list__item d-md-flex gap-3 py-3">
                                <div class="products-list__wrapper gap-3">
                                    <div class="products-list__thumb overflow-hidden flex-shrink-0">
                                        <?= $thumbnail_id ? wp_get_attachment_image($thumbnail_id, 'full', false, array('class' => '')) : wc_placeholder_img(array('class' => '')); ?>
                                    </div>
                                    <div class="d-flex flex-column justify-content-between">
                                        <h3 class="products-list__title mb-0 d-md-none">
                                            <?= get_the_title() ?>
                                        </h3>
                                        <span class="products-list__price d-md-none">
                                            <?= get_template_part('templates/price.php'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="products-list__content-wrapper  flex-grow-1 d-flex flex-column justify-content-between">
                                    <h3 class="products-list__title mb-0 d-none d-md-block order-1">
                                        <?= get_the_title() ?>
                                    </h3>

                                    <?php if ($ingredients || $allergens_ua || $allergens_eng) : ?>
                                        <div class="products-list__content order-3 order-md-2">
                                            <?php if ($ingredients) : ?>
                                                <span class="mb-1 d-block">
                                                    <?= translate_and_output('ingredients') . ': ' . $ingredients; ?>
                                                </span>
                                            <?php endif; ?>

                                            <?php if ($allergens_ua) : ?>
                                                <?php
                                                $allergens_length = count($allergens_ua);
                                                $counter = 1;
                                                ?>
                                                <span class="d-block">
                                                    <?php
                                                    echo translate_and_output('allergens') . ': ';
                                                    foreach ($allergens_ua as $allergen) :
                                                        echo $allergen['label'];
                                                        if ($counter < $allergens_length) {
                                                            echo ', ';
                                                        }
                                                        $counter++;
                                                    endforeach;
                                                    ?>
                                                </span>
                                            <?php elseif ($allergens_eng) : ?>
                                                <?php
                                                $allergens_length = count($allergens_eng);
                                                $counter = 1;
                                                ?>
                                                <span class="d-block">
                                                    <?php
                                                    echo translate_and_output('allergens') . ': ';
                                                    foreach ($allergens_eng as $allergen) :
                                                        echo $allergen['label'];
                                                        if ($counter < $allergens_length) {
                                                            echo ', ';
                                                        }
                                                        $counter++;
                                                    endforeach;
                                                    ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>


                                    <?php if ($weight || $time) : ?>
                                        <div class="products-list__content d-flex gap-3 order-4 order-md-3">
                                            <?php if ($weight) : ?>
                                                <span class="d-flex align-items-center gap-1">
                                                    <svg class="products-list__icon" width="16" height="16">
                                                      <use href="<?php get_image('sprite.svg#icon-weight'); ?>"></use>
                                                    </svg>
                                                    <?= $weight; ?>
                                                </span>
                                            <?php endif; ?>

                                            <?php if ($time) : ?>
                                                <span class="d-flex align-items-center gap-1">
                                                    <svg class="products-list__icon" width="16" height="16">
                                                        <use href="<?php get_image('sprite.svg#icon-time'); ?>"></use>
                                                    </svg>
                                                    <?= $time; ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    if ($labels) : ?>
                                        <ul class="tags-list d-flex flex-wrap gap-2 order-2 order-md-last">
                                            <?php
                                            $classMapping = [
                                                'own' => 'sprout',
                                                'kitchen' => 'kitchen',
                                                'recommended' => 'like',
                                                'new' => 'fire',
                                            ];

                                            foreach ($labels as $label) :
                                                $class = isset($classMapping[$label['value']]) ? $classMapping[$label['value']] : '';
                                                ?>
                                                <li class="tags-list__item d-flex gap-2 align-items-center px-2 py-1 rounded-3 <?= $class; ?>">
                                                    <?= translate_and_output($label['value']); ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>

                                </div>

                                <div class="d-flex flex-column justify-content-between">
                                    <span class="products-list__price d-none d-md-block">
                                    <?= get_template_part('templates/price.php'); ?>
                                    </span>
                                    <span class="products-list__favorite">
                                        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                                    </span>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </section>
            <?php
        }

        if (!empty($category_data['children'])) {
            display_category_products($category_data['children']);
        }
    }
}

foreach ($menu_items_hierarchy as $top_level_category) {
    if (!empty($top_level_category['children'])) {
        display_category_products($top_level_category['children']);
    }
}

wp_reset_postdata();
?>