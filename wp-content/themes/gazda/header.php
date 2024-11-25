<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script>
        (function(w,d,u){
                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://cdn.bitrix24.eu/b6947299/crm/site_button/loader_1_hu3fsk.js');
</script>
    <?php wp_head(); ?>

    <title><?php wp_title(); ?></title>

</head>

<body style="visibility: hidden">

<div class="wrapper">
    <header class="header position-relative">
        <div class="container">
            <div class="header-wrapper d-flex align-items-center">
                <?php
                if (is_page_template('pages/team.php')) {
                    get_template_part('templates/team/header');
                } else {
                    get_template_part('templates/defaultHeader');
                }
                ?>
            </div>
        </div>
        <?php
        if (!is_page_template('pages/team.php')) {
            get_template_part('templates/searchForm');
            get_template_part('templates/burger');
        }
        ?>
    </header>
