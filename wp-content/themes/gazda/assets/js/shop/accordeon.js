const iconToggle = $('.icon--toggle');


iconToggle.on('click', function(e) {
    $(this).toggleClass('toggle--horizontal');
});

$(document).ready(function() {
    $('.faq-list__wrapper').on("click", function() {
        let faqItem = $(this).parent('.faq-list__item');
        let siblingsItem = faqItem.siblings('.faq-list__item')
        let siblingsChildren = siblingsItem.children('.faq-list__text')
        let siblingsChildrenQuestion = siblingsItem.children('.faq-list__wrapper')
        let siblingsChildrenArrow = siblingsChildrenQuestion.find('.faq-list__icon')
        $(this).next().slideToggle(500);
        $(this).find('.faq-list__icon').toggleClass('rotated');
        siblingsChildren.slideUp();
        siblingsChildrenArrow.removeClass('rotated');
    });
});