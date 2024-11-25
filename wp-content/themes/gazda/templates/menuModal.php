<?php
$list = get_field('about_popup_gallery');
if (empty($list)) {
	return;
}
?>
<div class="backdrop menu">
	<div class="window">
		<?php
		foreach ($list as $item) {
			?>
			<img src="<?= $item ?>" alt="">
			<?php
		}
		?>
	</div>
</div>
<style>
	.backdrop.menu {
		opacity: 0;
		visibility: hidden;
		transition: opacity 0.3s, visibility 0.3s;

		&[show] {
			opacity: 1;
			visibility: visible;
		}

		.window {
			overflow: scroll;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: min(40rem, 80%);
			margin: 0 auto;
			display: grid;
			grid-template-rows: max-content;
			gap: 1rem;
			height: 90dvh;

			img {
				height: auto;
			}
		}
	}

	body:has(.backdrop.menu[show]) {
		overflow: hidden;

		.scroll-to-top {
			clip-path: circle(0);
		}
	}
</style>