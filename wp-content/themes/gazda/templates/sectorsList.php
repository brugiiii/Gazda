<?php
$is_address_visible = $args['is_address_visible'] ?? true;
$is_grid = $args['is_grid'] ?? true;

$current_lang = pll_current_language();
$sectors = get_field('sectors', pll_get_post(16, $current_lang));
?>

<ul class="sectors-list <?= $is_grid ? 'd-flex flex-column flex-sm-row flex-sm-wrap' : ''; ?>">
    <?php foreach ($sectors as $sector) : ?>
        <li class="sectors-list__item d-flex flex-column">
            <h3 class="sectors-list__title">
                <?php echo $sector['title']; ?>
            </h3>
            <span class="sectors-list__name">
                <?php echo $sector['name']; ?>
            </span>
            <?php
            if ($is_address_visible) {
                ?>
                <a class="sectors-list__link" target="<?= $sector['address']['target']; ?>"
                   href="<?php echo $sector['address']['url']; ?>">
                    <?php echo $sector['address']['title']; ?>
                </a>
                <?php
            }
            ?>
            <a class="sectors-list__link" href="<?php echo $sector['number']['url']; ?>">
                <?php echo $sector['number']['title']; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>