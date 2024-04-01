import refs from "../main/refs"
import {ordersSwiper} from "./swiper"

const {orderListButtons, orderInfoWrapper} = refs;
const {ajax_url} = settings;
const handleOrderButtonClick = (e) => {
    const $this = $(e.currentTarget);

    if($this.hasClass('is-active')) return ordersSwiper.slideTo(1);

    const previousActiveButton = $('.orders-list__button.is-active')
    const orderId = $this.data('order-id')
    const parentWrapper = $this.closest('.orders-list__item')

    if(previousActiveButton[0]) previousActiveButton.removeClass('is-active')
    $this.addClass('is-active')
    $this.attr('disabled', true)
    parentWrapper.toggleClass('loading')

    $.ajax({
        url: ajax_url,
        type: 'post',
        data: {action: 'get_order_info', order_id: orderId},
        success: (res) => {
            $this.attr('disabled', false)
            parentWrapper.toggleClass('loading')

            orderInfoWrapper.html(res);

            ordersSwiper.slideTo(1)
        },
        error: (error) => console.log("error: ", error)
    });

}

orderListButtons.on('click', handleOrderButtonClick)