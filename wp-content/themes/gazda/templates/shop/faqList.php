<ul class="faq-list mx-auto">
    <?php
    $class_taxonomy = is_page_template('pages/delivery.php') || (is_page() && $post->post_parent && get_page_template_slug(get_post_ancestors($post->ID)[0]) === 'pages/delivery.php') ? 'delivery' : 'shop';

    $args = array(
        'post_type' => 'faq',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'class',
                'field' => 'slug',
                'terms' => $class_taxonomy,
            ),
        ),
    );

    $query = new WP_Query($args);
    $counter = 0;

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $counter++;
            ?>
            <li class="faq-list__item">
                <div class="faq-list__wrapper d-flex align-items-center gap-2">
                    <div class="faq-list__icon <?= $counter === 1 ? 'rotated' : ''; ?>"></div>
                    <h3 class="faq-list__title mb-0">
                        <?= the_field('question'); ?>
                    </h3>
                </div>
                <p class="faq-list__text mb-0 mt-2">
                    <?= the_field('answer'); ?>
                </p>
            </li>
        <?php endwhile;
        wp_reset_query();
    else :
        echo 'Немає постів для відображення.';
    endif;
    ?>
</ul>