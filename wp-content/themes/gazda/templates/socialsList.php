<?php
$instagram = get_field('instagram-link', 16);
$facebook = get_field('facebook-link', 16);
?>

<ul class="socials-list">
    <li class="socials-list__item ">
        <a class="socials-list__link d-inline-block" href="<?php echo $facebook['url']; ?>"
           target="<?php echo $facebook['target']; ?>">
            <svg class="" width="26" height="26">
                <use href="<?php get_image('sprite.svg#icon-facebook'); ?>"></use>
            </svg>
        </a>
    </li>
    <li class="socials-list__item">
        <a class="socials-list__link d-inline-block" href="<?php echo $instagram['url']; ?>"
           target="<?php echo $instagram['target']; ?>">
            <svg class="" width="26" height="26">
                <use href="<?php get_image('sprite.svg#icon-instagram'); ?>"></use>
            </svg>
        </a>
    </li>
</ul>