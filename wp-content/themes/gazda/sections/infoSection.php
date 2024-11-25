<?php
$current_lang = pll_current_language();
?>

<section class="info">
	<div class="container">
		<div class="section-wrapper">


            <?php if (is_shop()) : ?>
                <div class="text-content__visible">
                    <?php the_field('content_visible', 6354); ?>
                </div>
                <div class="text-content__hidden">
                    <?php the_field('content_hidden', 6354); ?>
                </div>
                <button class="text-content__button d-flex align-items-center justify-content-center gap-2 border-0">Читати більше</button>

            <?php endif; ?>
            <?php if (!is_shop()) : ?>
                <div class="text-content">
                </div>
            <?php endif; ?>

        </div>
	</div>
</section>