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
?>

<?php wp_footer(); ?>

</body>

</html>