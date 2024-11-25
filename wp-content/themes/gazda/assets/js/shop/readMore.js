const hiddenContent = $('.text-content__hidden');

$('.text-content__button').on('click', function () {
    $this = $(this);

    $this.toggleClass('is-active');
    if ($(this).text() === 'Читати більше') {
                $(this).text('Приховати');
            } else {
                $(this).text('Читати більше');
            }
    hiddenContent.slideToggle();
})