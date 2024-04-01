const wishlistLink = $('.wishlist-link');
const wishlistCount = $('.wishlist-link__count');

$(document.body).on('added_to_wishlist removed_from_wishlist', function() {
    $.ajax({
        type: 'GET',
        url: settings.ajax_url,
        data: { action: 'get_wishlist_count' },
        success: function(response) {
            const count = JSON.parse(response).wishlist_count;

            count === 0 ? wishlistLink.addClass('is-hidden') : wishlistLink.removeClass('is-hidden')

            wishlistCount.text(count);
        }
    });
});
