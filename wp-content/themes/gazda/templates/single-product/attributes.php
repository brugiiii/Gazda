<?php
$product = wc_get_product(get_the_ID());

if ($product->is_type('variable')) {
    $attributes = $product->get_variation_attributes();

    foreach ($attributes as $attribute_name => $options) {
        ?>
        <h3 class="attributes-title mb-2 text-uppercase fw-bold">
            <?= translate_and_output(strtolower(wc_attribute_label($attribute_name))); ?>
        </h3>
        <ul class="variations-list d-flex align-items-center gap-2">
            <?php
            $attribute_terms = get_terms(array(
                'taxonomy' => $attribute_name,
                'orderby' => 'term_order', // Сортування за адмінським порядком
                'hide_empty' => false,
            ));

            foreach ($attribute_terms as $attribute_term) {
                $option = $attribute_term->slug;
                $is_default = $option === $product->get_variation_default_attribute($attribute_name);
                ?>
                <li class="variations-list__item">
                    <label class="variations-list__label">
                        <input class="variations-list__input" type="radio" name="<?= $attribute_term->taxonomy; ?>"
                               value="<?= $attribute_term->slug; ?>" <?= $is_default ? ' checked' : '' ?>>
                        <span class="variations-list__name d-inline-block px-3">
                            <?= $attribute_term->name; ?>
                        </span>
                    </label>
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
    }
}
?>
