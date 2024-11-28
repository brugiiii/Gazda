<?php
$current_lang = pll_current_language();
$current_currency_symbol = get_woocommerce_currency_symbol();

$cart = WC()->cart;

$delivery_items = [];
$shop_items = [];

foreach ($cart->get_cart() as $cart_item) {
    $product = $cart_item['data'];
    if ($product->is_type('variation')) {
        $product = wc_get_product($product->get_parent_id());
    }

    $terms = get_the_terms($product->get_id(), 'class');

    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            if ($term->name === 'Delivery') {
                $delivery_items[] = $cart_item;
                break;
            } elseif ($term->name === 'Shop') {
                $shop_items[] = $cart_item;
                break;
            }
        }
    }
}

if (!$cart->is_empty()) {
    ?>
    <div class="cart-scroll-container">
        <ul class="cart-list">
            <?php
            foreach ([$delivery_items, $shop_items] as $index => $items) {
                if (empty($items)) continue;
                $items_total = 0;
                ?>
                <li class="cart-list__item">
                    <h3 class="cart-list__title fs-6 mb-0">
                        <?= translate_and_output($index ? 'poryadniy_shop' : 'restaurant'); ?>
                    </h3>

                    <ul class="cart-products">
                        <?php
                        foreach ($items as $item) {
                            $product = $item['data'];
                            $quantity = $item['quantity'];
                            $price = $product->get_price();
                            $total_price = $price * $quantity;
                            $product_id = $product->get_id();
                            $thumbnail_id = get_post_thumbnail_id($product_id);
                            $items_total += $total_price;
                            ?>
                            <li class="cart-products__item d-flex align-items-center gap-3 pb-3 position-relative" data-product-id="<?= $product_id; ?>">
                                <div class="cart-products__thumb flex-shrink-0">
                                    <?= $thumbnail_id ? wp_get_attachment_image($thumbnail_id, 'full', false, array('class' => 'cart-products__image')) : wc_placeholder_img(array('class' => 'cart-products__image')); ?>
                                </div>
                                <div class="cart-products__wrapper flex-grow-1">
                                    <div class="title-wrapper d-flex align-items-center gap-2">
                                        <h4 class="cart-products__title flex-grow-1 mb-0">
                                            <?= esc_html($product->get_name()); ?>
                                        </h4>

                                        <button class="delete-button flex-shrink-0 unset" type="button">
                                            <svg class="delete-button__icon" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.878 4.25C10.0333 3.81131 10.3207 3.43152 10.7007 3.16292C11.0807 2.89431 11.5346 2.75008 12 2.75008C12.4654 2.75008 12.9193 2.89431 13.2993 3.16292C13.6793 3.43152 13.9667 3.81131 14.122 4.25C14.1548 4.34291 14.2056 4.42844 14.2715 4.50172C14.3374 4.57499 14.4171 4.63457 14.506 4.67705C14.5949 4.71954 14.6913 4.74409 14.7897 4.74932C14.8881 4.75454 14.9866 4.74033 15.0795 4.7075C15.1724 4.67467 15.2579 4.62386 15.3312 4.55797C15.4045 4.49209 15.4641 4.41241 15.5066 4.3235C15.549 4.23459 15.5736 4.13818 15.5788 4.03978C15.584 3.94138 15.5698 3.84291 15.537 3.75C15.2784 3.01866 14.7995 2.38546 14.1662 1.93761C13.5328 1.48975 12.7762 1.24927 12.0005 1.24927C11.2248 1.24927 10.4682 1.48975 9.83483 1.93761C9.20148 2.38546 8.72255 3.01866 8.464 3.75C8.42929 3.84328 8.41349 3.94253 8.41752 4.04197C8.42155 4.14141 8.44534 4.23906 8.48749 4.32922C8.52964 4.41938 8.58931 4.50025 8.66303 4.56711C8.73675 4.63398 8.82304 4.6855 8.91687 4.71868C9.0107 4.75186 9.1102 4.76603 9.20956 4.76037C9.30893 4.75471 9.40617 4.72933 9.49563 4.68571C9.58508 4.64208 9.66496 4.58109 9.73061 4.50629C9.79626 4.43149 9.84636 4.34436 9.878 4.25ZM2.75 6C2.75 5.80109 2.82902 5.61032 2.96967 5.46967C3.11032 5.32902 3.30109 5.25 3.5 5.25H20.5C20.6989 5.25 20.8897 5.32902 21.0303 5.46967C21.171 5.61032 21.25 5.80109 21.25 6C21.25 6.19891 21.171 6.38968 21.0303 6.53033C20.8897 6.67098 20.6989 6.75 20.5 6.75H3.5C3.30109 6.75 3.11032 6.67098 2.96967 6.53033C2.82902 6.38968 2.75 6.19891 2.75 6ZM5.117 7.752C5.31536 7.73883 5.51084 7.80495 5.66047 7.93583C5.8101 8.06671 5.90165 8.25165 5.915 8.45L6.375 15.35C6.465 16.697 6.529 17.635 6.669 18.34C6.806 19.025 6.996 19.387 7.269 19.643C7.543 19.899 7.917 20.065 8.609 20.155C9.323 20.248 10.263 20.25 11.613 20.25H12.387C13.737 20.25 14.677 20.248 15.391 20.155C16.083 20.065 16.457 19.899 16.731 19.643C17.004 19.387 17.194 19.025 17.331 18.34C17.471 17.635 17.535 16.697 17.625 15.35L18.085 8.45C18.0916 8.35171 18.1174 8.25567 18.1611 8.16737C18.2048 8.07907 18.2654 8.00024 18.3396 7.93538C18.4137 7.87051 18.4999 7.82089 18.5933 7.78934C18.6866 7.75779 18.7852 7.74493 18.8835 7.7515C18.9818 7.75807 19.0778 7.78393 19.1661 7.82761C19.2544 7.87129 19.3333 7.93194 19.3981 8.00609C19.463 8.08023 19.5126 8.16643 19.5442 8.25976C19.5757 8.35308 19.5886 8.45171 19.582 8.55L19.118 15.502C19.033 16.784 18.964 17.82 18.802 18.634C18.633 19.479 18.347 20.185 17.755 20.738C17.164 21.292 16.44 21.531 15.585 21.642C14.763 21.75 13.725 21.75 12.44 21.75H11.56C10.275 21.75 9.237 21.75 8.415 21.642C7.56 21.531 6.836 21.292 6.245 20.738C5.653 20.185 5.367 19.478 5.198 18.634C5.036 17.82 4.968 16.784 4.882 15.502L4.418 8.55C4.41148 8.4517 4.42439 8.35308 4.456 8.25978C4.4876 8.16647 4.53728 8.0803 4.60219 8.0062C4.6671 7.93209 4.74597 7.8715 4.83431 7.82788C4.92264 7.78427 5.0187 7.75848 5.117 7.752Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="cart-products__inner d-flex align-items-center gap-3">
                                        <div class="cart-quantity d-flex align-items-center justify-content-between p-1"
                                             >
                                            <button class="cart-quantity__button bg-transparent border-0 p-0 decrement">
                                                <svg class="cart-quantity__icon" width="24" height="24">
                                                    <use href="<?php get_image('sprite.svg#icon-minus'); ?>"></use>
                                                </svg>
                                            </button>
                                            <span class="cart-quantity__value">
                                                <?= esc_html($quantity); ?>
                                            </span>
                                            <button class="cart-quantity__button bg-transparent border-0 p-0 increment">
                                                <svg class="cart-quantity__icon" width="24" height="24">
                                                    <use href="<?php get_image('sprite.svg#icon-plus'); ?>"></use>
                                                </svg>
                                            </button>
                                        </div>
                                        <span class="cart-products__price">
                                                <?= wc_price($price); ?>
                                            </span>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>

                    <p class="cart-list__price mb-0 mt-2">
                            <span>
                                <?= translate_and_output('sum'); ?>:
                            </span>
                        <span>
                                <?= wc_price($items_total); ?>
                            </span>
                    </p>
                </li>
                <?php
            }
            ?>
        </ul>

        <p class="cart-price position-relative pt-3 mb-0">
            <span>
                <?= translate_and_output('total_sum'); ?>
            </span>
            <span>
                <?= $cart->get_total(); ?>
            </span>
        </p>

        <a href="<?= $current_lang === 'uk' ? get_permalink(woocommerce_get_page_id('checkout')) : get_permalink(7276); ?>"
           class="cart-checkout button-primary d-flex align-items-center justify-content-center fs-6 w-100"
           type="button">
            <?= translate_and_output('make_order'); ?>
        </a>
    </div>
    <?php
} else {
    ?>
    <div class="cart-thumb-wrapper">
        <div class="cart-thumb">
            <img class="cart-thumb__image" src="<?= get_image("no_products.svg"); ?>" alt="empty cart">
        </div>
    </div>

    <a class="cart-link d-flex align-items-center justify-content-center fs-6 button-primary"
       href="<?= $current_lang === 'uk' ? get_permalink(woocommerce_get_page_id('shop')) : get_permalink(6386); ?>">
        <?= translate_and_output('view_products'); ?>
    </a>
    <?php
}
?>