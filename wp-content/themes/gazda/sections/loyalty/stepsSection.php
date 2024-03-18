<?php
$steps = get_field("steps");
?>

<section class="steps">
    <div class="container">
        <h2 class="visually-hidden">
            Steps
        </h2>
        <ul class="steps-list mx-auto">
            <?php
            foreach ($steps as $step){
                ?>
                <li class="steps__item bg-white rounded-4">
                    <h3 class="steps__title mb-1">
                        <?= $step["title"]; ?>
                    </h3>
                    <p class="steps__text mb-0">
                        <?= $step["text"]; ?>
                    </p>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
</section>