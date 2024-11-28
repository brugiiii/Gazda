<footer class="footer">
    <div class="container">
        <?php
        if (is_page_template('pages/team.php')) {
            get_template_part('templates/team/footer');
        } else {
            get_template_part('templates/defaultFooter');
        }
        ?>
    </div>
</footer>
</div>

<div id="show" class="position-absolute fly-cart">
    <img class="img-fluid" src="" alt="">
</div>

<?php
if (is_shop() || is_page_template('pages/delivery.php') || is_page_template('woocommerce/archive-product.php')) {
    get_template_part('templates/shop/categoriesMenu');
}

if (!is_user_logged_in() && !is_page_template('pages/team.php')) {
    get_template_part('templates/authModal');
}

if (is_page_template('pages/team.php')) {
    get_template_part('templates/team/formModal');
}

if (!is_page_template('pages/team.php')) {
    get_template_part('templates/cart/index');
}
?>

<script>
    (function (w, d, u) {
        var s = d.createElement('script');
        s.async = true;
        s.src = u + '?' + (Date.now() / 60000 | 0);
        var h = d.getElementsByTagName('script')[0];
        h.parentNode.insertBefore(s, h);
    })(window, document, 'https://cdn.bitrix24.eu/b6947299/crm/site_button/loader_1_hu3fsk.js');
</script>

<?php wp_footer(); ?>

</body>

</html>