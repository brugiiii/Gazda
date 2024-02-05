<?php $product = wc_get_product(get_the_ID()); ?>

<section class="section">
    <div class="container">
        <ul class="buttons-list d-flex gap-3">
            <li class="buttons-list__item">
                <button class="buttons-list__button position-relative bg-transparent p-2 text-uppercase is-active"
                        data-info="description">
                    <?= translate_and_output('description'); ?>
                </button>
            </li>
            <li class="buttons-list__item">
                <button class="buttons-list__button position-relative bg-transparent p-2 text-uppercase"
                        data-info="reviews">
                    <?= translate_and_output('reviews'); ?>
                </button>
            </li>
            <li class="buttons-list__item">
                <button class="buttons-list__button position-relative bg-transparent p-2 text-uppercase"
                        data-info="exchange and return">
                    <?= translate_and_output('return'); ?>
                </button>
            </li>
        </ul>

        <div class="content-wrapper">
            <div class="description">
                <?= wpautop($product->get_description()); ?>
            </div>
        </div>

    </div>
</section>

