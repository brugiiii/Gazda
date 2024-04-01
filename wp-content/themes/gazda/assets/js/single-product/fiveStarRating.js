const handleStarClick = (e) => {
    const $this = $(e.target);
    const siblingStars = $this.siblings();
    const previousStars = $this.prevAll('a');

    siblingStars.removeClass('is-active');
    previousStars.addClass('is-active');
}

$('.woocommerce-tabs').on('click', '.stars a', handleStarClick)