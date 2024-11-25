const iconToggle = $('.icon--toggle');

iconToggle.on('click', function(e) {
    $(this).toggleClass('toggle--horizontal');
});

$(document).ready(function() {
	$('.faq-list__wrapper').on("click", function() {
			let faqItem = $(this).closest('.faq-list__item');
			let siblingsItem = faqItem.siblings('.faq-list__item');
			let siblingsChildren = siblingsItem.find('.faq-list__text');
			let siblingsChildrenQuestion = siblingsItem.find('.faq-list__wrapper');
			let siblingsChildrenArrow = siblingsChildrenQuestion.find('.faq-list__icon');

			siblingsChildren.slideUp();
			siblingsChildrenArrow.removeClass('rotated');

			$(this).next('.faq-list__text').slideToggle(500);
			$(this).find('.faq-list__icon').toggleClass('rotated');
	});
});
