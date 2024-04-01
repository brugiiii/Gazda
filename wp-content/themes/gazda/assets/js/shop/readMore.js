const hiddenContent = $('.text-content__hidden');

$('.text-content__button').on('click', function () {
    $this = $(this);

    $this.toggleClass('is-active');
    hiddenContent.slideToggle();
})