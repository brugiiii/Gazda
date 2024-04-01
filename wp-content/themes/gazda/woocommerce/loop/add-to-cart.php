<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if (!defined('ABSPATH')) {
    exit;
}

global $product;

?>
<div class="px-2 px-lg-3 pb-2 pb-lg-3">
    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
       data-quantity="<?php echo esc_attr(isset($args['quantity']) ? $args['quantity'] : 1); ?>"
       class="<?php echo esc_attr(isset($args['class']) ? $args['class'] : 'button'); ?> position-relative button-primary d-block buy-button button-loading" <?php echo isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : ''; ?>>
        <span class="d-flex align-items-center justify-content-center gap-2 h-100">
            <svg class="product-list__icon" width="24" height="24">
                <use href="<?php get_image('sprite.svg#icon-shopping-cart'); ?>"></use>
            </svg>
            <?= esc_html($product->add_to_cart_text()); ?>
        </span>
        <?= get_template_part('templates/loader'); ?>
    </a>
</div>
