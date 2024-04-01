<?php
$text = get_field('cta_text');
$is_team_page = is_page_template('pages/team.php')
?>

<section class="cta" id="cta">
    <div class="container">
        <h2 class="cta-title title text-center <?= $is_team_page ? "" : "py-2"; ?>">
            <?= the_field('cta_title'); ?>
        </h2>
        <?php
        if($text) {
            ?>
            <p class="cta-text text-center">
                <?= $text; ?>
            </p>
        <?php
        }
        ?>
        <?= get_template_part('templates/ctaForm'); ?>
    </div>
</section>

