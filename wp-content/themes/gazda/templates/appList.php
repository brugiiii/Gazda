<?php $en =  pll_current_language() == "en"?>
<ul class="app-list d-flex">
    <li class="app-list__item">
        <a href="<?php the_field('app_store_link', 16);?>" class="app-list__link">
            <img src="<?php  get_image($en ? 'appleApp.webp' : "apple.webp"); ?>"
                 alt="Apple logo and text download on the App Store">
        </a>
    </li>
    <li class="app-list__item">
        <a href="<?php the_field('play_link', 16);?>" class="app-list__link">
            <img src="<?php  get_image($en ? 'googleApp.webp' : "google.webp"); ?>"
                 alt="Google play logo and text download on the Google Play">
        </a>
    </li>
</ul>