<?php
$image_id = get_field('logo');
$links = get_field('links');
$address = get_field('address', 16);
$number = get_field('team_phone_number');
$email = get_field('team_email_adress');
?>

<div class="footer-wrapper d-md-flex justify-content-md-between align-items-md-center">
	<a class="footer-logo d-block mb-3 mb-lg-0" href="<?= get_permalink(6955); ?>">
		<?= wp_get_attachment_image($image_id, 'full', false, array('class' => 'logo')); ?>
	</a>
	<ul class="contacts d-sm-flex">
		<li class="contacts__item mb-3 mb-md-0">
			<span class="contacts__title d-block mb-3">
				Пошта
			</span>
			<a class="contacts__link fs-6" href="<?= !empty($email['url']) ? $email['url'] : ''; ?>">
				<?= !empty($email['title']) ? $email['title'] : '' ?>
			</a>
		</li>
		<li class="contacts__item mb-3 mb-md-0">
			<span class="contacts__title d-block mb-3">
				Телефон
			</span>
			<a class="contacts__link fs-6" href="<?= $number['url']; ?>">
				<?= $number['title']; ?>
			</a>
		</li>
		<li class="contacts__item mb-3 mb-md-0">
			<span class="contacts__title d-block mb-3">
				Адреса
			</span>
			<a class="contacts__link fs-6" href="<?= $address['url']; ?>" target="<?= $address['target']; ?>"
				rel="noopener noreferrer nofollow">
				<?= $address['title']; ?>
			</a>
		</li>
		<li class="contacts__item">
			<span class="contacts__title d-block mb-3">
				Соц. мережі
			</span>
			<?= get_template_part('templates/socialsList', null, array("inst" => get_field('team_intagram'), 'fb' => get_field('team_facebook'))); ?>

		</li>
	</ul>
</div>
<div class="d-flex flex-column-reverse d-sm-block">
	<p class="copyright text-center">
		<?= the_field('copyright'); ?>
	</p>
	<ul class="links-list d-sm-flex justify-content-sm-center">
		<?php
		foreach ($links as $link) {
			?>
			<li class="links-list__item">
				<?php if ($link['popup']) { ?>
					<button class="popup-open confident links-list__link p-0">
						<?= $link['text']; ?>
					</button>
					<div class="backdrop confident is-hidden">
						<div class="window">
							<?= $link['popup_text']; ?>
						</div>
					</div>
				<?php } else { ?>
					<a class="links-list__link" href="<?= $link['link']; ?>">
						<?= $link['text']; ?>
					</a>
				<?php } ?>
			</li>
			<?php
		}
		?>
	</ul>

</div>