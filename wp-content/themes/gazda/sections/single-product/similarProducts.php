<section class="section similar-products-section">
    <div class="container">
        <div class="similar-products-wrapper d-flex align-items-center justify-content-between">
            <h2 class="similar-products-title px-2 pt-2 mb-0">
                <?= translate_and_output('similar_products'); ?>
            </h2>
            <?php get_template_part('templates/single-product/ctrl'); ?>
        </div>
        <?php get_template_part('templates/single-product/similarProducts'); ?>
    </div>
</section>