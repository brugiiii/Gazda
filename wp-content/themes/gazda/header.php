<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <?php wp_head(); ?>

    <title><?php wp_title(); ?></title>

</head>

<body style="visibility: visible">

<div class="wrapper">
    <header class="header position-relative">
        <div class="container">

            <div class="header-wrapper d-flex align-items-center">
                <button class="hamburger hamburger--collapse"
                        type="button">
                  <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                  </span>
                </button>

                <nav class="main-nav">
                    <?php get_template_part('templates/navigation', null, array('location' => 'menu-header')); ?>
                </nav>

                <?php the_custom_logo(); ?>

                <?php get_template_part('templates/toolbar'); ?>

                <button class="button-primary header-button border-0 ms-2 ms-xl-3">
                    <?= translate_and_output('reserve'); ?>
                </button>
            </div>

        </div>
        <?php get_template_part('templates/burger'); ?>
    </header>
