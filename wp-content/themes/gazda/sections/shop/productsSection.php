<section class="section products position-relative">
    <h1 class="visually-hidden">
        <?php woocommerce_page_title(); ?>
    </h1>
    <div class="container">
        <?= get_template_part('templates/shop/breadcrumbs'); ?>
        <div class="products-wrapper d-lg-flex">
            <div class="nav-wrapper position-sticky align-self-start bg-white flex-shrink-0 rounded-3 p-3">
                <h2 class="nav-wrapper__title text-uppercase fw-semibold">
                    <?= translate_and_output('categories'); ?>
                </h2>
                <?= get_template_part('templates/shop/navigation'); ?>
            </div>
            <div class="flex-grow-1">
                <?= get_template_part('templates/shop/toolbar'); ?>
                <div class="products-items">
                    <ul class="products-list d-flex flex-wrap"></ul>
                    <div class="pagination-container"></div>
                </div>
            </div>
        </div>
</section>
