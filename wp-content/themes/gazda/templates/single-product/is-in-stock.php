<?php
$is_in_stock = $args['is_in_stock'] ?? true;

if ($is_in_stock) {
    ?>
    <span class="availability in-stock d-inline-block text-white py-2 px-3">
        <?= translate_and_output('in_stock'); ?>
    </span>
    <?php
} else {
    ?>
    <span class="availability out-of-stock d-inline-block text-white py-2 px-3">
        <?= translate_and_output('out_of_stock'); ?>
    </span>
    <?php
}
?>