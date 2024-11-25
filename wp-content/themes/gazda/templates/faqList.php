<?php
$parent_id = wp_get_post_parent_id(get_the_ID());

if (is_shop() || ($parent_id === 6354)) {
    $faq = get_field('faq', 6354);
} else if ($parent_id === 6562) {
    $faq = get_field('faq', 6562);
} else {
    $faq = get_field('faq');
}
?>

<ul class="faq-list mx-auto">
    <?php
    foreach ($faq as $index => $qna) {
        ?>
        <li class="faq-list__item">
            <div class="faq-list__wrapper d-flex align-items-center gap-2">
                <div class="faq-list__icon <?= $index === 0 ? 'rotated' : ''; ?>"></div>
                <h3 class="faq-list__title mb-0">
                    <?= $qna['question']; ?>
                </h3>
            </div>
						<?= $qna['answer']; ?>
        </li>
        <?php
    }
    ?>
</ul>
