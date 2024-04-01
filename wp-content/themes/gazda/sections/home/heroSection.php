<?php
$hero_bg = get_field('hero_bg');
?>

<div class="hero">
   <div class="container d-flex align-items-center h-100">
       <h1 class="visually-hidden">
           <?php echo get_bloginfo('name'); ?>
       </h1>
       <?php get_template_part('templates/home/heroSwiper'); ?>
   </div>
</div>

<style>
    .hero {
        background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.75) 100%), url(<?= $hero_bg; ?>);
        background-image: -webkit-linear-gradient(0deg, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.75) 100%), url(<?= $hero_bg; ?>);
        background-image: -moz-linear-gradient(0deg, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.75) 100%), url(<?= $hero_bg; ?>);
        background-image: -o-linear-gradient(0deg, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.75) 100%), url(<?= $hero_bg; ?>);
        background-image: -ms-linear-gradient(0deg, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.75) 100%), url(<?= $hero_bg; ?>);
    }
</style>