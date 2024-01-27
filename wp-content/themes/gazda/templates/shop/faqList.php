<ul class="faq-list mx-auto">
    <?php
    $args = array(
        'post_type' => 'faq',
        'posts_per_page' => -1,
        'order' => 'ASC',
    );

    $query = new WP_Query($args);
    $counter = 0;

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $counter++;
            ?>
            <li class="faq-list__item">
                <div class="faq-list__wrapper d-flex align-items-lg-center gap-2">
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