<section class="faq">
    <div class="container">
        <div class="section-wrapper">
            <h2 class="faq-title mb-3">
                <?= is_shop() ? get_field('faq_title', 6354) : get_field('faq_title'); ?>
            </h2>
            <?= get_template_part('templates/shop/faqList'); ?>
        </div>
    </div>
</section>