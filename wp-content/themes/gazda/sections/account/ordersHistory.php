<div class="section__item" data-content="orders-history">
    <div class="swiper orders-swiper">
        <ul class="swiper-wrapper">
            <li class="swiper-slide">
                <h2 class="text-uppercase mb-3">
                    <?= translate_and_output('orders_history'); ?>
                </h2>

                <?php
                // Отримуємо ID поточного користувача
                $user_id = get_current_user_id();

                // Отримуємо історію замовлень користувача
                $customer_orders = wc_get_orders(array(
                    'customer' => $user_id,
                    'status' => array('wc-completed', 'wc-processing', 'wc-on-hold') // Фільтр за статусом замовлення
                ));


                // Перевірка наявності замовлень
                if ($customer_orders) {
                    ?>
                    <ul class="orders-list">
                        <?php foreach ($customer_orders as $order) : ?>
                            <?php
                            $order_id = $order->get_id();
                            $order_obj = wc_get_order($order_id);
                            $item_count = $order_obj->get_item_count();
                            $total_amount = $order_obj->get_total();
                            ?>
                            <li class="orders-list__item position-relative">
                                <button class="orders-list__button p-3 bg-transparent w-100"
                                        data-order-id="<?= $order_id; ?>">
                                    <div class="orders-list__wrapper d-flex flex-column-reverse flex-sm-row gap-2 gap-sm-0 align-items-start align-items-sm-center justify-content-between">
                                        <h3 class="orders-list__title mb-0">
                                            <?= translate_and_output('order') . ' №' . esc_html($order->get_order_number()); ?>
                                        </h3>
                                        <time class="orders-list__date"
                                              datetime="<?= esc_attr($order->get_date_created()->date('Y-m-d H:i:s')); ?>">
                                            <?= date_i18n('j F Y', strtotime($order->get_date_created()->date('Y-m-d H:i:s'))); ?>
                                        </time>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="orders-list__products-count fw-light">
                                            <?= $item_count === 1 ? $item_count . ' ' . translate_and_output('product') : $item_count . ' ' . translate_and_output('products'); ?>
                                        </span>
                                        <span class="orders-list__price">
                                            <?= $total_amount . '₴'; ?>
                                        </span>
                                    </div>
                                </button>
                                <?= get_template_part('templates/loader'); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php
                } else {
                    ?>
                    <p>
                        <?= translate_and_output('no_orders'); ?>
                    </p>
                    <?php
                }
                ?>
            </li>
            <li class="swiper-slide">
                <button class="swiper-button d-flex align-items-center gap-2 mb-3 text-start prev bg-transparent border-0"
                        type="button">
                    <svg width="24" height="24">
                        <use href="<?php get_image('sprite.svg#icon-caret-left'); ?>"></use>
                    </svg>
                    <?= translate_and_output('back'); ?>
                </button>
                <div class="order-info"></div>
            </li>
        </ul>
    </div>
</div>