<?php
/**
 * Footer Buttons
 *
 * This template can be overridden by copying it to yourtheme/templates/side-cart-woocommerce/global/footer/buttons.php.
 *
 * HOWEVER, on occasion we will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen.
 * @see     https://docs.xootix.com/side-cart-woocommerce/
 * @version 2.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$current_lang = '';



extract( Xoo_Wsc_Template_Args::footer_buttons() );

do_action( 'xoo_wsc_before_footer_btns' );

$buttonHTML = '<a href="%1$s" class="%2$s">%3$s</a>';

?>
<div class="xoo-wsc-ft-buttons-cont">

    <?php
    if(count($buttons) > 1){
    // Виводити посилання на сторінку оплати

        $checkout_page_id =  wc_get_page_id( 'checkout' );
        ?>
        <a class="cart-button" href="<?= get_permalink($checkout_page_id); ?>">
            <?= translate_and_output("to_order"); ?>

        </a>
        <?php
    } else {
   // Посилання на сторінку магазину
        $shop_page_id = wc_get_page_id( 'shop' )
        ?>
        <img  alt="" src="<?= get_image("image_no_products.svg"); ?>"/>
        <a class="cart-button" href="<?= get_permalink($shop_page_id); ?>">
            <?= translate_and_output("view_products"); ?>
        </a>

            <?php
    }
    ?>

</div>

<?php do_action( 'xoo_wsc_after_footer_btns' ); ?>