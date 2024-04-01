<?php
// Отримуємо ідентифікатор поточного товару
$product_id = get_the_ID();

// Отримуємо об'єкт товару
$product = wc_get_product($product_id);

// Перевіряємо, чи є товар об'єктом класу WC_Product
if ($product && is_a($product, 'WC_Product')) {
// Отримуємо галерею зображень для товару
    $gallery_ids = $product->get_gallery_image_ids();

// Якщо є галерея зображень
    if ($gallery_ids) {
        ?>
        <div class="swiper product-swiper">
            <ul class="swiper-wrapper gallery-list">
                <?php foreach ($gallery_ids as $gallery_id): ?>
                    <li class="swiper-slide gallery-list__item">
                        <div class="gallery-list__thumb">
                            <?php echo wp_get_attachment_image($gallery_id, 'full', false, array('class' => '')); ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="swiper thumbs-swiper">
            <ul class="swiper-wrapper thumbs-list">
                <?php foreach ($gallery_ids as $gallery_id): ?>
                    <li class="swiper-slide thumbs-list__item">
                        <div class="thumbs-list__thumb">
                            <?php echo wp_get_attachment_image($gallery_id, 'full', false, array('class' => '')); ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    } else {
        ?>
        <div class="hero-thumb">
            <?php
            $main_image_id = get_post_thumbnail_id($product_id);

            if ($main_image_id) {
                wp_get_attachment_image($main_image_id, 'full', false, array('class' => ''));
            } else {
                echo wc_placeholder_img('full');
            }
            ?>
        </div>
        <?php
    }
}
?>
