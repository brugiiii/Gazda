<button class="hamburger hamburger--collapse"
        type="button">
    <span class="hamburger-box">
        <span class="hamburger-inner"></span>
    </span>
</button>

<nav class="main-nav">
    <?php get_template_part('templates/navigation', null, array('location' => 'menu-header')); ?>
</nav>

<?php
the_custom_logo();

get_template_part('templates/toolbar');
?>

<button class="button-primary header-button border-0 ms-auto ms-sm-2 ms-xl-3">
    <?= translate_and_output('reserve'); ?>
</button>